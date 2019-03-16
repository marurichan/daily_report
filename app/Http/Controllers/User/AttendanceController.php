<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AttendanceRequest;
use App\Models\Attendance;
use App\Services\CalcDate;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    protected $attendance;
    protected $calc;

    public function __construct(Attendance $attendance, CalcDate $calc)
    {
        $this->middleware('auth');
        $this->attendance = $attendance;
        $this->calc = $calc;
    }

    public function index()
    {
        $userId = Auth::id();
        $attendance = $this->attendance->fetchSpecificDay($userId, $this->calc->today);
        return view('user.attendance.index', compact('attendance'));
    }

    public function showAbsenceForm()
    {
        return view('user.attendance.absence');
    }

    public function showModifyForm()
    {
        return view('user.attendance.modify');
    }

    public function showMypage(CalcDate $calcDate)
    {
        $userId = Auth::id();
        $workInfos = $this->attendance->fetchPersonalRecords($userId);
        $dateSum = $calcDate->calcDatetimeSum($workInfos);
        return view('user.attendance.mypage', compact('workInfos', 'dateSum'));
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

}
