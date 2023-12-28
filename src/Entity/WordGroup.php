<?php

namespace App\Entity;

use App\Repository\WordGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WordGroupRepository::class)]
class WordGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'wordGroup', targetEntity: Word::class, cascade: ['persist'])]
    private Collection $words;

    public function __construct()
    {
        $this->words = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWords(): Collection
    {
        return $this->words;
    }

    /**
     * @param Word[] $words
     *
     * @return void
     */
    public function setWords(array $words): void
    {
        foreach ($words as $word) {
            $word->setWordGroup($this);
            $this->words->add($word);
        }
    }
}
