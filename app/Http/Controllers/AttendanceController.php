<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Http\Requests\AttendanceRequest;
use Auth;

class AttendanceController extends Controller
{
    protected $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->middleware('auth');
        $this->attendance = $attendance;
    }

    public function index()
    {
        $userId = Auth::id();
        $attendance = $this->attendance->getTodaysRecord($userId);
        return view('attendance.index', compact('attendance'));
    }

    public function showAbsenceForm()
    {
        return view('attendance.absence');
    }

    public function showModifyForm()
    {
        return view('attendance.modify');
    }

    public function showMypage()
    {
        $userId = Auth::id();
        $attendanceInfos = $this->attendance->getPersonalRecords($userId);
        $dateSum = $this->culcDatetimeSum($attendanceInfos);
        return view('attendance.mypage', compact('attendanceInfos', 'dateSum'));
    }

    public function setStartTime(AttendanceRequest $request)
    {
        $inputs = $request->all();
        $this->attendance->registerStartTime($inputs);
        return redirect()->route('attendance.index');
    }

    public function setEndTime(AttendanceRequest $request, $recordId)
    {
        $inputs = $request->all();
        $this->attendance->find($recordId)->fill($inputs)->save();
        return redirect()->route('attendance.index');
    }

    public function registerAbsence(AttendanceRequest $request)
    {
        $inputs = $request->all();
        $this->attendance->registerAbsence($inputs);
        return redirect()->route('attendance.index');
    }

    public function storeModifyRequest(AttendanceRequest $request)
    {
        $inputs = $request->all();
        $this->attendance->registerModifyRequest($inputs);
        return redirect()->route('attendance.index');
    }

    public function culcDatetimeSum($attendanceInfos)
    {
        $diffSum = 0;
        $daySum = 0;
        foreach ($attendanceInfos as $dailyInfo) {
            if (!$dailyInfo->absent_flg && !empty($dailyInfo->end_time)) {
                $timeDiff = $this->culcTimeDiff($dailyInfo->start_time, $dailyInfo->end_time);
                $diffSum = $diffSum + $timeDiff;
                $daySum++;
            }
        }
        return [
            'timeSum' => round($diffSum / 3600),
            'daySum'  => $daySum,
        ];
    }

    public function culcTimeDiff($startTime, $endTime)
    {
        $startTime = strtotime($startTime);
        $endTime = strtotime($endTime);
        $timeDiff = $endTime - $startTime;
        return $timeDiff;
    }

}

