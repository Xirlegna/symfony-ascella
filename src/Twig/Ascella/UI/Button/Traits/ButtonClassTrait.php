<?php

namespace App\Twig\Ascella\UI\Button\Traits;

trait ButtonClassTrait
{
    private array $classes = [
        'base' => [
            'as-h-9',
            'rounded-4',
            'as-border-none',
            'as-cursor-pointer'
        ],
        'primary' => [
            'as-bg-ascella-blue',
            'as-text-white',
            'hover:as-bg-accent-cyan'
        ],
        'primary-outline' => [
            'as-bg-white',
            'as-text-ascella-blue',
            'as-border-2',
            'as-border-solid',
            'as-border-ascella-blue',
            'hover:as-bg-grey-200'
        ],
        'error' => [
            'as-bg-error',
            'as-text-white',
            'hover:as-bg-error'
        ]
    ];
}
