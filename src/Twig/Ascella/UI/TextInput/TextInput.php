<?php

namespace App\Twig\Ascella\UI\TextInput;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'Ascella:TextInput',
    template: '@Ascella/UI/TextInput/Templates/TextInput.html.twig'
)]
class TextInput
{
    public string $id;
    public string $type;
    public string $label;
    public string $placeholder;
    public string $model;

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

        $resolver->setDefaults(['model' => '']);
        $resolver->setAllowedTypes('model', 'string');

        return $resolver->resolve($data);
    }
}