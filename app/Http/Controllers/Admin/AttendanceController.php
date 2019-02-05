<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use App\Http\Requests\AttendanceRequest;
use Auth;
use App\Services\CalcDate;

class AttendanceController extends Controller
{
    protected $user;
    protected $attendance;
    protected $calc;

    public function __construct(User $user, Attendance $attendance, CalcDate $calc)
    {
        $this->middleware('auth:admin');
        $this->user = $user;
        $this->attendance = $attendance;
        $this->calc = $calc;
    }

    public function index()
    {
        $userInfos = $this->user->all();
        return view('admin.attendance.index', compact('userInfos'));
    }

    public function user($userId)
    {
        $userInfo = $this->user->find($userId);
        $absentLateCount = $this->calc->calcAbsentLate($userInfo);
        return view('admin.attendance.user', compact('userInfo', 'absentLateCount'));
    }

    public function edit($userId, $date)
    {
        $userInfo = $this->user->find($userId);
        $date = $this->calc->convertStrToCarbon($date);
        $attendance = $this->attendance->getSpecificDay($userId, $date);
        return view('admin.attendance.edit', compact('userInfo', 'attendance'));
    }

}

