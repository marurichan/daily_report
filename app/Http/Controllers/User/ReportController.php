<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    private $dailyreport;

    public function __construct(DailyReport $dbDailyReport)
    {
        $this->middleware('auth');
        $this->daily = $dbDailyReport;
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
        $dailys = $this->daily->where('reporting_time', 'LIKE', $searchMonth . '%')
                                ->where('user_id', '=', $user)
                                ->orderBy('reporting_time', 'desc')
                                ->paginate(10);
        return view('user.daily_report.index',compact('dailys'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $path = parse_url($_SERVER['HTTP_REFERER']);
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $validation = $this->validates($input);
        switch($path['path']) {
            case '/report/create':
                $this->daily->fill($input)->save();
                return redirect()->route('report.index');
            break;
            case "/report/{$input['id']}/edit":
                return $this->update($request, $input);
            break;
        }
    }

    /**
     * 日報詳細表示
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $report = $this->daily->find($id);
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
        $report = $this->daily->find($id);
        return view('user.daily_report.edit', compact('report'));
    }

    /**
     * 日報編集保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  obj  $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $input)
    {
        $this->daily->find($input['id'])->fill($input)->save();
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
        $this->daily->find($id)->delete();
        return redirect()->route('report.index');
    }

    /**
     * バリデーション
     *
     * @param  obj $input
     * @return \Illuminate\Support\Facades\Validator
     */
    public function validates($input)
    {
        $valid = new DailyReportRequest();
        $validation = Validator::make(
            $input,
            $valid->rules(),
            $valid->messages()
        )->validate();
    }
}
