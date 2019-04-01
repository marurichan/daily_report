<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{
    protected $report;

    public function __construct(DailyReport $report)
    {
        $this->middleware('auth');
        $this->report = $report;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $inputs = $request->all();

        if (empty($inputs)) {
            $reports = $this->report->fetchAllPersonalReports($userId);
        } else {
            $reports = $this->report->fetchSearchingPersonalReports($userId, $inputs);
        }
        return view('user.daily_report.index', compact('reports', 'inputs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user.daily_report.create');
    }

    /**
     * @param DailyReportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DailyReportRequest $request)
    {
        $inputs = $request->all();
        $this->report->create($inputs);
        return redirect()->to('report');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.show', compact('report'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $report = $this->report->find($id);
        return view('user.daily_report.edit', compact('report'));
    }

    /**
     * @param DailyReportRequest $request
     * @param $reportId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DailyReportRequest $request, $reportId)
    {
        $inputs = $request->all();
        $this->report->find($reportId)->fill($inputs)->save();
        return redirect()->to('report');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->report->find($id)->delete();
        return redirect()->to('report');
    }

}

