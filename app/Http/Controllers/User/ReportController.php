<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    private $dailyReport;
    const paginateCount = 10;

    public function __construct(DailyReport $dailyReport)
    {
        $this->middleware('auth');
        $this->dailyReport = $dailyReport;
    }

    /**
     * 日報の一覧表示
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $searchMonth = $request->input('search-month');
        $user = Auth::id();
        $dailyReports = $this->dailyReport->where('reporting_time', 'LIKE', $searchMonth . '%')
                                          ->where('user_id', $user)
                                          ->orderBy('reporting_time', 'desc')
                                          ->paginate(self::paginateCount);
        return view('user.daily_report.index', compact('dailyReports', 'searchMonth'));
    }

    /**
     *新規作成画面の表示
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.daily_report.create');
    }

    /**
     * バリデーションとデータの保存
     *
     * @param  \App\Http\Requests\User\DailyReportRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DailyReportRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->dailyReport->fill($input)->save();
        return redirect()->route('report.index');
    }

    /**
     * 日報詳細表示
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $report = $this->dailyReport->find($id);
        return view('user.daily_report.show', compact('report'));
    }

    /**
     * 日報編集画面表示
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $report = $this->dailyReport->find($id);
        return view('user.daily_report.edit', compact('report'));
    }

    /**
     * 日報編集保存
     *
     * @param  \App\Http\Requests\User\DailyReportRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DailyReportRequest $request, $id)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->dailyReport->find($id)->fill($input)->save();
        return redirect()->route('report.index');
    }

    /**
     * 日報削除
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->dailyReport->find($id)->delete();
        return redirect()->route('report.index');
    }

}
