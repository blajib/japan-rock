<?php

namespace App\Entity;

use App\Repository\WordRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WordRepository::class)]
class Word
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $japanTranslate = null;

    #[ORM\Column(length: 255)]
    private ?string $frenchTranslate = null;

    #[ORM\ManyToOne(targetEntity: Word::class, inversedBy: 'words')]
    private WordGroup $wordGroup;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJapanTranslate(): ?string
    {
        return $this->japanTranslate;
    }

    public function setJapanTranslate(string $japanTranslate): static
    {
        $this->japanTranslate = $japanTranslate;

        return $this;
    }

    public function getFrenchTranslate(): ?string
    {
        return $this->frenchTranslate;
    }

    public function setFrenchTranslate(string $frenchTranslate): static
    {
        $this->frenchTranslate = $frenchTranslate;

        return $this;
    }
}
