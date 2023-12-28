<?php

namespace App\Controller;

use App\Entity\Word;
use App\Form\WordType;
use App\Repository\WordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/word')]
class WordController extends AbstractController
{
    #[Route('/', name: 'app_word_index', methods: ['GET'])]
    public function index(WordRepository $wordRepository): Response
    {
        return $this->render('word/index.html.twig', [
            'words' => $wordRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_word_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $word = new Word();
        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($word);
            $entityManager->flush();

            return $this->redirectToRoute('app_word_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('word/new.html.twig', [
            'word' => $word,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_word_show', methods: ['GET'])]
    public function show(Word $word): Response
    {
        return $this->render('word/show.html.twig', [
            'word' => $word,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_word_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Word $word, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_word_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('word/edit.html.twig', [
            'word' => $word,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_word_delete', methods: ['POST'])]
    public function delete(Request $request, Word $word, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$word->getId(), $request->request->get('_token'))) {
            $entityManager->remove($word);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_word_index', [], Response::HTTP_SEE_OTHER);
    }
}
