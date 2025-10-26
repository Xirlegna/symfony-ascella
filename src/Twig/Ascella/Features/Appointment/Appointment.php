<?php

namespace App\Twig\Ascella\Features\Appointment;

use App\Utils\ClassName;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'Ascella:Appointment',
    template: '@Ascella/Features/Appointment/Templates/Appointment.html.twig'
)]
class Appointment
{
    public string $id;
    public string $from;
    public string $to;
    public string $type = 'empty';

    public string $title = 'Coaching';
    public string $name = '';

    private array $classes = [
        'marker' => [
            'base' => [
                'as-w-1',
                'as-h-100',
                'rounded-2'
            ]
        ]
    ];

    #[PostMount]
    public function postMount(array $data): array
    {
        if ($this->type === 'empty') {
            $this->title = '';
            $this->name = '';
        }

        return $data;
    }

    /** CSS CLASS GETTERS */
    public function getMarkerClass(): string
    {
        return ClassName::build(
            $this->classes['marker']['base'],
            $this->type === 'booked' ? ['as-bg-warning'] : ['as-bg-success']
        );
    }
}
