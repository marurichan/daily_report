<?php

namespace App\Services;

class CalcDate
{

    public function calcDatetimeSum($attendanceInfos)
    {
        $diffSum = 0;
        $daySum = 0;
        foreach ($attendanceInfos as $dailyInfo) {
            if (!$dailyInfo->absent_flg && !empty($dailyInfo->end_time)) {
                $timeDiff = $this->calcTimeDiff($dailyInfo->start_time, $dailyInfo->end_time);
                $diffSum = $diffSum + $timeDiff;
                $daySum++;
            }
        }
        return [
            'timeSum' => round($diffSum / 3600),
            'daySum'  => $daySum,
        ];
    }

    public function calcTimeDiff($startTime, $endTime)
    {
        $startTime = strtotime($startTime);
        $endTime = strtotime($endTime);
        return $endTime - $startTime;
    }

}


