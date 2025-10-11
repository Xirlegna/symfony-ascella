<?php

namespace App\Service;

class BookingSystemDate
{
    const DAYS_IN_WEEK = 7;

    private $now;
    private $selectedDay;
    private $selectedMonth;
    private $selectedMonthName;
    private $selectedYear;
    private $selectedDate;

    public function __construct()
    {
        $now = time();
        $this->now = $now;
        $this->selectedDay = (int) date('d', $now);
        $this->selectedMonth = (int) date('n', $now);
        $this->selectedMonthName = date('F', $now);
        $this->selectedYear = (int) date('Y', $now);
        $this->selectedDate = date('Y-m-d', $now);

        $this->getCalendar();
    }

    public function getNow()
    {
        return $this->now;
    }

    public function getDay()
    {
        return $this->selectedDay;
    }

    public function getMonth()
    {
        return $this->selectedMonth;
    }

    public function getMonthName()
    {
        return $this->selectedMonthName;
    }

    public function getYear()
    {
        return $this->selectedYear;
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

    public function prevMonth()
    {
        $date = date('Y-m-d', date(strtotime($this->selectedYear . '-' . sprintf('%02d', $this->selectedMonth - 1) . '-01')));

        dd(date('Y-m-d', strtotime($date)));

        $this->selectedDay = (int) date('d', strtotime($date));
        $this->selectedMonth = (int) date('n', strtotime($date));
        $this->selectedMonthName = date('F', strtotime($date));
        $this->selectedYear = (int) date('Y', strtotime($date));
        $this->selectedDate = date('Y-m-d', strtotime($date));
    }
}
