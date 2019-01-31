<?php

namespace App\Services;

use Carbon;

class CalcDate
{

    public function convertAttendanceTime($attendanceInfos)
    {
        foreach ($attendanceInfos as $info) {
            $info->start_time = $this->convertStrToCarbon($info->start_time);
            $info->end_time   = $this->convertStrToCarbon($info->end_time);
            $info->date       = $this->convertStrToCarbon($info->date);
        }
        return $attendanceInfos;
    }

    public function convertReportingTime($reports)
    {
        foreach ($reports as $report) {
            $report->reporting_time = $this->convertStrToCarbon($report->reporting_time);
        }
        return $reports;
    }

    public function convertQuestionTime($questions)
    {
        foreach ($questions as $question) {
            $question->created_at = $this->convertStrToCarbon($question->created_at);
        }
        return $questions;
    }

    public function convertQuestionCommentTime($question)
    {
        $question->created_at = $this->convertStrToCarbon($question->created_at);
        if (!empty($question->comment)) {
            foreach ($question->comment as $comment) {
                $comment->created_at = $this->convertStrToCarbon($comment->created_at);
            }
        }
        return $question;
    }

    public function convertAdminAttendance($userInfos)
    {
        foreach ($userInfos as $info) {
            $info->created_at = $this->convertStrToCarbon($info->created_at);
            if (!empty($info->attendance)) {
                $info->attendance->start_time = $this->convertStrToCarbon($info->attendance->start_time);
                $info->attendance->end_time   = $this->convertStrToCarbon($info->attendance->end_time);
                $info->attendance->date       = $this->convertStrToCarbon($info->attendance->date);
            }
        }
        return $userInfos;
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

}

