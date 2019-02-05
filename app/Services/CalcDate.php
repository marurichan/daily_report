<?php

namespace App\Services;

use Carbon;

const START_TIME = '10:00';

class CalcDate
{
    public $today;

    public function __construct()
    {
        $this->today = Carbon::today();
    }

    public function convertStrToCarbon($strTime)
    {
        if (!empty($strTime)) {
            return new Carbon($strTime);
        }
        return $strTime;
    }

    public function calcDatetimeSum($attendanceInfos)
    {
        $diffSum = 0;
        $daySum = 0;
        foreach ($attendanceInfos as $dailyInfo) {
            if (!$dailyInfo->absent_flg && !empty($dailyInfo->end_time)) {
                $timeDiff = $dailyInfo->start_time->diffInSeconds($dailyInfo->end_time);
                $diffSum = $diffSum + $timeDiff;
                $daySum++;
            }
        }
        return [
            'timeSum' => round($diffSum / 3600) - $daySum,
            'daySum'  => $daySum,
        ];
    }

    public function calcAbsentLate($userInfo)
    {
        $absentCount = 0;
        $lateCount = 0;
        foreach ($userInfo->allAttendance as $attendance) {
            if (!empty($attendance) && $attendance->absent_flg) {
                $absentCount++;
            } elseif (!empty($attendance) && $attendance->start_time->format('H:i') > START_TIME) {
                $lateCount++;
            }
        }
        return [
            'absentCount' => $absentCount,
            'lateCount'   => $lateCount,
        ];
    }

}

