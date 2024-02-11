<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

// #[ORM\Entity(repositoryClass: SymbolRepository::class)]
#[ORM\MappedSuperclass]
abstract class Symbol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $romaji = null;

    #[ORM\Column(length: 255)]
    private ?string $japanese = null;

    #[ORM\Column]
    private ?int $level = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRomaji(): ?string
    {
        return $this->romaji;
    }

    public function setRomaji(?string $romaji): static
    {
        $this->romaji = $romaji;

        return $this;
    }

    public function getJapanese(): ?string
    {
        return $this->japanese;
    }

    public function setJapanese(string $japanese): static
    {
        $this->japanese = $japanese;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }
}
