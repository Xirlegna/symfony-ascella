<?php

namespace App\Twig\Ascella\UI\TimeInput\Traits;

trait TimeInputUtilsTrait
{
    private function wrapValue(int $value, int $step, int $max): int
    {
        return ($value + $step + $max) % $max;
    }

    private function isInRange(mixed $value, int $min, int $max): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        $value = (int) $value;
        return $value >= $min && $value <= $max;
    }
}
