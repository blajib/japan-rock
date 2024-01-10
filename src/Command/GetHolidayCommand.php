<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(
    name: 'import:holiday',
    description: 'Importer les jours fèriés',
)]
class GetHolidayCommand extends Command
{

}