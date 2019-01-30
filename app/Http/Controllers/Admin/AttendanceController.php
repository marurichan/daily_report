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

    public function __construct(User $user, Attendance $attendance)
    {
        $this->middleware('auth:admin');
        $this->user = $user;
        $this->attendance = $attendance;
    }

    public function index()
    {
        $userInfos = $this->user->all();
        return view('admin.attendance.index', compact('userInfos'));
    }
}

