<?php

namespace App\Twig\Components\Ascella;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'ascella/components/Button.html.twig')]
class Button
{
    public array $class;
    public string $btnClass;
    public string $type;
    public string $variant;
    public string $action;
    public string $actionParam;
    public string $liveAction;

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

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults(['class' => []]);
        $resolver->setAllowedTypes('class', 'array');

        $resolver->setDefaults(['type' => 'submit']);
        $resolver->setAllowedValues('type', ['submit', 'button']);

        $resolver->setDefaults(['variant' => 'primary']);
        $resolver->setAllowedValues('variant', ['primary', 'primary-outline', 'error']);

        $resolver->setDefaults(['action' => '']);
        $resolver->setAllowedTypes('action', 'string');

        $resolver->setDefaults(['actionParam' => '']);
        $resolver->setAllowedTypes('actionParam', 'string');

        $resolver->setDefaults(['liveAction' => '']);
        $resolver->setAllowedTypes('liveAction', 'string');

        return $resolver->resolve($data) + $data;
    }

    #[PostMount]
    public function postMount(array $data): array
    {
        $classes = array_merge($this->classes['base'], $this->classes[$this->variant], $this->class);

        $this->btnClass = implode(' ', $classes);

        return $data;
    }
}
