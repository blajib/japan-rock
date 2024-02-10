<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\HiraganaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HiraganaRepository::class)]
class Hiragana extends Symbol
{

}
