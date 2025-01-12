<?php

namespace App\Helpers;

use Carbon\Carbon;

class Date
{
    /**
     * @return array
     */
    public static function getWeekDays(): array
    {
        $weekDays = [];
        foreach (range(1, 7) as $wd) {
            $weekDays[$wd] = Carbon::create()->weekday($wd)->format('D');
        }

        return $weekDays;
    }

    /**
     * @return array
     */
    public static function getMonths(): array
    {
        $months = [];
        foreach (range(1, 12) as $m) {
            $months[$m] = Carbon::create()->month($m)->format('F');
        }

        return $months;
    }

    /**
     * @param int $fromYear
     * @param int $toYear
     * @return array
     */
    public static function getYears(int $fromYear, int $toYear): array
    {
        $years = [];
        foreach (range($fromYear, $toYear) as $y) {
            $years[$y] = $y;
        }

        return $years;
    }
}
