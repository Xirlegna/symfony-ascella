<?php

namespace App\Twig\Ascella\Layout\DashboardHeader;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'Ascella:DashboardHeader',
    template: '@Ascella/Layout/DashboardHeader/Templates/DashboardHeader.html.twig'
)]
class DashboardHeader {}
