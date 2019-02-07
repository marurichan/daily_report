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

    public function create($userId)
    {
        $userInfo = $this->user->find($userId);
        return view('admin.attendance.create', compact('userInfo'));
    }

    public function store(Request $request)
    {
        
    }

    public function edit($userId, $date)
    {
        $date = $this->calc->convertStrToCarbon($date);
        $attendance = $this->attendance->fetchSpecificDay($userId, $date);
        return view('admin.attendance.edit', compact('userInfo', 'attendance'));
    }

    public function update(Request $request, $userId)
    {
        $inputs = $request->all();
        $inputs = $this->calc->makeDatetimeCarbon($inputs);
        $this->attendance->find($inputs['id'])->fill($inputs)->save();
        return redirect()->route('admin.attendance.user', $userId);
    }

}

