<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\KatakanaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KatakanaRepository::class)]
class Katakana extends Symbol
{

}
