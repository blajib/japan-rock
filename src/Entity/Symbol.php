<?php

namespace App\Entity;

use App\Repository\SymbolRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SymbolRepository::class)]
class Symbol
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

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getRomaji(): ?string
    {
        return $this->romaji;
    }

    public function setRomaji(?string $romaji): void
    {
        $this->romaji = $romaji;
    }

    public function getJapanese(): ?string
    {
        return $this->japanese;
    }

    public function setJapanese(?string $japanese): void
    {
        $this->japanese = $japanese;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }
}
