<?php

namespace App\Services;

use Carbon;

const START_TIME = '10:00';

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

    public function convertAdminPersonalAttendance($userInfo)
    {
        $userInfo->created_at = $this->convertStrToCarbon($userInfo->created_at);
        if (!empty($userInfo->allAttendance)) {
            foreach ($userInfo->allAttendance as $attendance) {
                $attendance->start_time = $this->convertStrToCarbon($attendance->start_time);
                $attendance->end_time   = $this->convertStrToCarbon($attendance->end_time);
                $attendance->date       = $this->convertStrToCarbon($attendance->date);
            }
        }
        return $userInfo;
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

