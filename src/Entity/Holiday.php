<?php

namespace App\Entity;

use App\Repository\HolidayRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HolidayRepository::class)]
class Holiday
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $roomaji = null;

    #[ORM\Column(length: 255)]
    private ?string $japan = null;

    #[ORM\Column(length: 255)]
    private ?string $french = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->roomaji;
    }

    public function setName(string $roomaji): static
    {
        $this->roomaji = $roomaji;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getRoomaji(): ?string
    {
        return $this->roomaji;
    }

    public function setRoomaji(?string $roomaji): void
    {
        $this->roomaji = $roomaji;
    }

    public function getJapan(): ?string
    {
        return $this->japan;
    }

    public function setJapan(?string $japan): void
    {
        $this->japan = $japan;
    }

    public function getFrench(): ?string
    {
        return $this->french;
    }

    public function setFrench(?string $french): void
    {
        $this->french = $french;
    }
}
