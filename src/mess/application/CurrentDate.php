<?php
namespace Mess\Application;

use DateTime;

class CurrentDate
{
    private DateTime $today;

    public function __construct()
    {
        $this->today = date_create(date("Y-m-d"));
    }

    public function isLaterThanYears(string $date, int $years): bool
    {
        return $this->differenceBiggerThanYears(date_create($date), $years);
    }

    private function differenceBiggerThanYears(DateTime $dateTime, int $years): bool
    {
        return $this->differenceFromTodayInYears($dateTime) >= $years;
    }

    private function differenceFromTodayInYears(DateTime $dateTime): int
    {
        return \date_diff($dateTime, $this->today)->y;
    }
}
