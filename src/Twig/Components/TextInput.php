<?php

namespace App\Twig\Components;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class TextInput
{
    public string $id;
    public string $type;
    public string $label;
    public string $placeholder;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver->setRequired('id');
        $resolver->setAllowedTypes('id', 'string');

        $resolver->setDefaults(['type' => 'text']);
        $resolver->setAllowedValues('type', ['text', 'password']);

        $resolver->setRequired('label');
        $resolver->setAllowedTypes('label', 'string');

        $resolver->setDefaults(['placeholder' => '']);
        $resolver->setAllowedTypes('placeholder', 'string');

        return $resolver->resolve($data) + $data;
    }
}