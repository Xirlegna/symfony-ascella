<?php

namespace App\Twig\Ascella\UI\Button;

use App\Twig\Ascella\UI\Button\Traits\ButtonClassTrait;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(
    name: 'Ascella:Button',
    template: '@Ascella/UI/Button/Templates/Button.html.twig'
)]
class Button
{
    use ButtonClassTrait;

    public array $class;
    public string $btnClass;
    public string $type;
    public string $variant;
    public string $action;
    public string $actionParam;
    public string $liveAction;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'class' => [],
            'type' => 'submit',
            'variant' => 'primary',
            'action' => '',
            'actionParam' => '',
            'liveAction' => '',
        ]);

        $resolver->setAllowedTypes('class', 'array');
        $resolver->setAllowedValues('type', ['submit', 'button']);
        $resolver->setAllowedValues('variant', ['primary', 'primary-outline', 'error']);
        $resolver->setAllowedTypes('action', 'string');
        $resolver->setAllowedTypes('actionParam', 'string');
        $resolver->setAllowedTypes('liveAction', 'string');

        return $resolver->resolve($data);
    }

    /** CSS CLASS GETTERS */
    public function getBtnClass(): string
    {
        return implode(' ', array_merge($this->classes['base'], $this->classes[$this->variant], $this->class));
    }
}
