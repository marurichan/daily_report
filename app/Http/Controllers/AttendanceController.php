<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

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
        return view('attendance.index');
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
        return view('attendance.mypage');
    }

    public function createAbsence(Request $request)
    {
        $inputs = $request->all();
        $absenceRecord = $this->attendance->where('date', $inputs['date'])->where('user_id', $inputs['user_id']);

        $absent_flg = $absenceRecord->exists();

        if ($absent_flg) {
            $absenceRecord->first()->fill($inputs)->save();
            return view('attendance.index');
        }

        $this->attendance->fill($inputs)->save();
        return view('attendance.index');
    }

}

