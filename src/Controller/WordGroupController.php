<?php

namespace App\Controller;

use App\Entity\WordGroup;
use App\Form\WordGroupType;
use App\Repository\WordGroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/word/group')]
class WordGroupController extends AbstractController
{
    #[Route('/', name: 'app_word_group_index', methods: ['GET'])]
    public function index(WordGroupRepository $wordGroupRepository): Response
    {
        return $this->render('word_group/index.html.twig', [
            'word_groups' => $wordGroupRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_word_group_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $wordGroup = new WordGroup();
        $form = $this->createForm(WordGroupType::class, $wordGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($wordGroup);
            $entityManager->flush();

            return $this->redirectToRoute('app_word_group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('word_group/new.html.twig', [
            'word_group' => $wordGroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_word_group_show', methods: ['GET'])]
    public function show(WordGroup $wordGroup): Response
    {
        return $this->render('word_group/show.html.twig', [
            'word_group' => $wordGroup,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_word_group_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WordGroup $wordGroup, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WordGroupType::class, $wordGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_word_group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('word_group/edit.html.twig', [
            'word_group' => $wordGroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_word_group_delete', methods: ['POST'])]
    public function delete(Request $request, WordGroup $wordGroup, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wordGroup->getId(), $request->request->get('_token'))) {
            $entityManager->remove($wordGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_word_group_index', [], Response::HTTP_SEE_OTHER);
    }
}
