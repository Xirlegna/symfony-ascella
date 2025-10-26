<?php

namespace App\Twig\Ascella\UI\TimeInput\Traits;

trait TimeInputClassTrait
{
    private array $classes = [
        'btn' => [
            'base' => [
                'as-cursor-pointer',
                'as-d-flex',
                'as-align-items-center',
                'as-justify-content-center',
                'as-border-none',
                'as-w-9',
                'as-h-7',
                'as-bg-ascella-blue',
                'hover:as-bg-accent-cyan',
            ],
        ],
        'input' => [
            'base' => [
                'as-outline-none',
                'as-w-9',
                'as-h-9',
                'rounded-none',
                'as-border-solid',
                'as-border-1',
                'as-text-center',
            ],
            'primary' => [
                'as-border-grey-300',
            ],
            'error' => [
                'as-border-error',
            ],
        ],
    ];
}
