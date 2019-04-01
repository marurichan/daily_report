<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyReport;
use App\Models\User;
use App\Services\CalcDate;

class DailyReportController extends Controller
{
    protected $user;
    protected $report;

    public function __construct(User $user, DailyReport $report, CalcDate $calc)
    {
        $this->middleware('auth:admin');
        $this->user = $user;
        $this->report = $report;
        $this->calc = $calc;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->user->all();
        return view('admin.daily_report.index', compact('users'));
    }

    /**
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($userId)
    {
        $reports = $this->report->fetchAllPersonalReports($userId);
        return view('admin.daily_report.show', compact('reports'));
    }
}

