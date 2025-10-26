<?php

namespace App\Twig\Ascella\UI\TimeInput;

use App\Twig\Ascella\UI\TimeInput\Traits\TimeInputClassTrait;
use App\Twig\Ascella\UI\TimeInput\Traits\TimeInputUtilsTrait;
use App\Utils\ClassName;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent(
    name: 'Ascella:TimeInput',
    template: '@Ascella/UI/TimeInput/Templates/TimeInput.html.twig'
)]
class TimeInput
{
    use DefaultActionTrait;
    use TimeInputClassTrait;
    use TimeInputUtilsTrait;

    const HOURS_IN_DAY = 24;
    const MINUTES_IN_HOUR = 60;

    #[LiveProp(writable: true)]
    public int $hour;

    #[LiveProp(writable: true)]
    public int $minute;

    #[LiveProp(writable: true)]
    public bool $hourError = false;

    #[LiveProp(writable: true)]
    public bool $minuteError = false;

    #[PreMount]
    public function preMount(array $data): array
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'hour' => 0,
            'minute' => 0,
        ]);

        $resolver->setAllowedTypes('hour', 'int');
        $resolver->setAllowedTypes('minute', 'int');

        return $resolver->resolve($data);
    }

    /** CSS CLASS GETTERS */
    public function getBtnPlusClass(): string
    {
        return ClassName::build($this->classes['btn']['base'], ['rounded-t-sm']);
    }

    public function getBtnMinusClass(): string
    {
        return ClassName::build($this->classes['btn']['base'], ['rounded-b-sm']);
    }

    public function getHourInputClass(): string
    {
        return ClassName::build(
            $this->classes['input']['base'],
            $this->hourError ? $this->classes['input']['error'] : $this->classes['input']['primary']
        );
    }

    public function getMinuteInputClass(): string
    {
        return ClassName::build(
            $this->classes['input']['base'],
            $this->minuteError ? $this->classes['input']['error'] : $this->classes['input']['primary']
        );
    }

    /** LIVE ACTIONS */
    #[LiveAction]
    public function onIncrementHour()
    {
        $this->hour = $this->wrapValue($this->hour, 1, self::HOURS_IN_DAY);
        $this->hourError = false;
    }

    #[LiveAction]
    public function onDecrementHour()
    {
        $this->hour = $this->wrapValue($this->hour, -1, self::HOURS_IN_DAY);
        $this->hourError = false;
    }

    #[LiveAction]
    public function onValidateHour(): void
    {
        $this->hourError = !$this->isInRange($this->hour, 0, self::HOURS_IN_DAY - 1);
    }

    #[LiveAction]
    public function onIncrementMinute()
    {
        $this->minute = $this->wrapValue($this->minute, 5, self::MINUTES_IN_HOUR);
        $this->minuteError = false;
    }

    #[LiveAction]
    public function onDecrementMinute()
    {
        $this->minute = $this->wrapValue($this->minute, -5, self::MINUTES_IN_HOUR);
        $this->minuteError = false;
    }

    #[LiveAction]
    public function onValidateMinute(): void
    {
        $this->minuteError = !$this->isInRange($this->minute, 0, self::MINUTES_IN_HOUR - 1);
    }
}
