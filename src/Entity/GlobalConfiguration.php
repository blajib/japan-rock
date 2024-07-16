<?php

namespace App\Entity;

use App\Repository\GlobalConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlobalConfigurationRepository::class)]
class GlobalConfiguration
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $background = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $weatherApiId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): static
    {
        $this->background = $background;

        return $this;
    }

    public function getWeatherApiId()
    {
        return $this->weatherApiId;
    }

    public function setWeatherApiId($weatherApiId)
    {
        $this->weatherApiId = $weatherApiId;

        return $this;
    }
}
