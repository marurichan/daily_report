<?php

namespace App\Http\Controllers;

use App\Models\DailyReports;
use Illuminate\Http\Request;
use App\Http\Requests\DailyReportRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\CalcDate;

class DailyReportController extends Controller
{
    protected $report;
    protected $calc;

    public function __construct(DailyReports $report, CalcDate $calc)
    {
        $this->middleware('auth');
        $this->report = $report;
        $this->calc = $calc;
    }

    /**
      * 日報一覧表示
      * 検索条件($inputs)がないときは全件取得、あるときは条件に当てはまる日報を取得
      */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $inputs = $request->all();

        if (empty($inputs)) {
            $reports = $this->report->getAllPersonalReports($userId);
        } else {
            $reports = $this->report->getSearchingPersonalReports($userId, $inputs);
        }
        $reports = $this->calc->convertReportingTime($reports);
        return view('daily_report.index', compact('reports'));
    }

    public function create()
    {
        return view('daily_report.create');
    }

    public function store(DailyReportRequest $request)
    {
        $inputs = $request->all();
        $this->report->create($inputs);
        return redirect()->to('report');
    }

    public function show($id)
    {
        $report = $this->report->find($id);
        $report->reporting_time = $this->calc->convertStrToCarbon($report->reporting_time);
        return view('daily_report.show', compact('report'));
    }

    public function edit($id)
    {
        $report = $this->report->find($id);
        $report->reporting_time = $this->calc->convertStrToCarbon($report->reporting_time);
        return view('daily_report.edit', compact('report'));
    }

    public function update(DailyReportRequest $request, $reportId)
    {
        $inputs = $request->all();
        $this->report->find($reportId)->fill($inputs)->save();
        return redirect()->to('report');
    }

    public function destroy($id)
    {
        $this->report->find($id)->delete();
        return redirect()->to('report');
    }

}

