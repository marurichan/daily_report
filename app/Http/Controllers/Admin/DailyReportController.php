<?php

namespace App\Http\Controllers\Admin;

use App\Models\DailyReport;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DailyReportsRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
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

    public function index()
    {
        $users = $this->user->all();
        return view('admin.daily_report.index', compact('users'));
    }

    public function show($userId)
    {
        $reports = $this->report->fetchAllPersonalReports($userId);
        return view('admin.daily_report.show', compact('reports'));
    }
}

