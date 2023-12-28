<?php

declare(strict_types=1);

namespace App\Helper;

class WordHelper
{
    public function formatWordLine(string $line): array
    {
        $result = [];
        $token = "/";
        $result['japan'] = trim(strtok($line, $token));

        $index = strpos($line, $token);

        if ($index !== false) {
            $france = substr($line, $index + \strlen($token));
            $france = preg_replace('/[0-9]+/', '', $france);
            $result['france'] = substr($france, 0, -2);
        }

        return $result;
    }
}