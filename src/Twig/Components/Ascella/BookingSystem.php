<?php

namespace App\Twig\Components\Ascella;

use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent(template: 'ascella/components/BookingSystem/BookingSystem.html.twig')]
class BookingSystem
{
    use DefaultActionTrait;

    const DAYS_IN_WEEK = 7;

    #[LiveProp(writable: true)]
    public int $now;

    #[LiveProp(writable: true)]
    public int $selectedDay;

    #[LiveProp(writable: true)]
    public int $selectedMonth;

    #[LiveProp(writable: true)]
    public string $selectedMonthName;

    #[LiveProp(writable: true)]
    public int $selectedYear;

    #[LiveProp(writable: true)]
    public string $selectedDate;

    public function __construct()
    {
        $now = time();

        $this->now = $now;
        $this->selectDate($now);
    }

    public function getHeader()
    {
        return $this->selectedYear . '. ' . $this->selectedMonthName;
    }

    public function getCalendar()
    {
        $lastDay = (int) date('t', strtotime($this->selectedDate));
        $startDayPosition = (int) date('N', strtotime($this->selectedYear . '-' . sprintf('%02d', $this->selectedMonth) . '-01'));

        $grid = [];
        $counter = 1;

        for ($w = 0; $w < ceil(($lastDay + $startDayPosition - 1) / self::DAYS_IN_WEEK); $w++) {
            $weeks = [];

            for ($d = 1; $d <= self::DAYS_IN_WEEK; $d++) {
                if ($counter <= $startDayPosition - 1) {
                    array_push($weeks, ['type' => 'empty', 'value' => '']);
                } else if ($counter > $lastDay + $startDayPosition - 1) {
                    array_push($weeks, ['type' => 'empty', 'value' => '']);
                } else {
                    $value = $counter - $startDayPosition + 1;
                    $type = $value === $this->selectedDay ? 'active' : 'default';

                    array_push($weeks, ['type' => $type, 'value' => (string) ($value)]);
                }

                $counter++;
            }

            array_push($grid, $weeks);
        }

        return $grid;
    }

    #[LiveAction]
    public function prevMonth()
    {
        $month = $this->selectedMonth;
        $year = $this->selectedYear;

        $month--;
        if ($month < 1) {
            $month = 12;
            $year--;
        }

        $date = date('Y-m-d', date(strtotime($year . '-' . sprintf('%02d', $month) . '-01')));

        $this->selectDate(strtotime($date));
    }

    #[LiveAction]
    public function nextMonth()
    {
        $month = $this->selectedMonth;
        $year = $this->selectedYear;

        $month++;
        if ($month > 12) {
            $month = 1;
            $year++;
        }
        $date = date('Y-m-d', date(strtotime($year . '-' . sprintf('%02d', $month) . '-01')));

        $this->selectDate(strtotime($date));
    }

    #[LiveAction]
    public function selectDay(#[LiveArg] int $day)
    {
        $date = date('Y-m-d', date(strtotime($this->selectedYear . '-' . $this->selectedMonth . '-' . sprintf('%02d', $day))));

        $this->selectDate(strtotime($date));
    }

    private function selectDate($date) {
        $this->selectedDay = (int) date('d', $date);
        $this->selectedMonth = (int) date('n', $date);
        $this->selectedMonthName = date('F', $date);
        $this->selectedYear = (int) date('Y', $date);
        $this->selectedDate = date('Y-m-d', $date);
    }
}
