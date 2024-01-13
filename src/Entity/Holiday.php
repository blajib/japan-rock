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
    private ?string $japanTranslate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $frenchTranslate = null;

    #[ORM\Column(length: 255)]
    private ?string $englishTranslate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJapanTranslate(): ?string
    {
        return $this->japanTranslate;
    }

    public function setJapanTranslate(?string $japanTranslate): void
    {
        $this->japanTranslate = $japanTranslate;
    }

    public function getFrenchTranslate(): ?string
    {
        return $this->frenchTranslate;
    }

    public function setFrenchTranslate(?string $frenchTranslate): void
    {
        $this->frenchTranslate = $frenchTranslate;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): void
    {
        $this->date = $date;
    }

    public function getEnglishTranslate(): ?string
    {
        return $this->englishTranslate;
    }

    public function setEnglishTranslate(?string $englishTranslate): void
    {
        $this->englishTranslate = $englishTranslate;
    }
}
