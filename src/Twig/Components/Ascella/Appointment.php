<?php

namespace App\Twig\Components\Ascella;

use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'ascella/components/Appointment.html.twig')]
class Appointment
{
    public string $from;
    public string $to;
    public string $type = 'empty';
    public string $title = '';
    public string $name = '';
    public string $class = 'as-w-1 as-h-100 rounded-2';

    #[PostMount]
    public function postMount(array $data): array
    {
        if ($this->type === 'booked') {
            $this->class .= ' as-bg-warning';
        } else {
            $this->class .= ' as-bg-success';
            $this->title = '';
            $this->name = '';
        }

        return $data;
    }
}
