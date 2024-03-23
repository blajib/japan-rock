<?php

namespace App\Entity;

use App\Repository\KanjiRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KanjiRepository::class)]
class Kanji
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ideogram = null;

    #[ORM\Column(length: 255)]
    private ?string $hiragana = null;

    #[ORM\Column(length: 255)]
    private ?string $meaning = null;

    #[ORM\Column(nullable: true)]
    private ?int $level = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdeogram(): ?string
    {
        return $this->ideogram;
    }

    public function setIdeogram(string $ideogram): static
    {
        $this->ideogram = $ideogram;

        return $this;
    }

    public function getHiragana(): ?string
    {
        return $this->hiragana;
    }

    public function setHiragana(string $hiragana): static
    {
        $this->hiragana = $hiragana;

        return $this;
    }

    public function getMeaning(): ?string
    {
        return $this->meaning;
    }

    public function setMeaning(string $meaning): static
    {
        $this->meaning = $meaning;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): static
    {
        $this->level = $level;

        return $this;
    }
}
