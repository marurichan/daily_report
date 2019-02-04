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
        $userInfos = $this->calc->convertAdminAttendance($userInfos);
        return view('admin.attendance.index', compact('userInfos'));
    }

    public function user($userId)
    {
        $userInfo = $this->user->find($userId);
        $userInfo = $this->calc->convertAdminPersonalAttendance($userInfo);
        $absentLateCount = $this->calc->calcAbsentLate($userInfo);
        return view('admin.attendance.user', compact('userInfo', 'absentLateCount'));
    }

}

