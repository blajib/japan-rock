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
    private ?string $roomaji = null;

    #[ORM\Column(length: 255)]
    private ?string $japanese = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomaji(): ?string
    {
        return $this->roomaji;
    }

    public function setRoomaji(?string $roomaji): static
    {
        $this->roomaji = $roomaji;

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
}
