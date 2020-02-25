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
     * リソースのリスト表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchMonth = $request->input('search-month');
        $dailys = $this->daily->where('reporting_time', 'LIKE', $searchMonth . '%')
                                    ->orderBy('reporting_time', 'desc')
                                    ->paginate(10);
        $user = Auth::user();
        return view('user.daily_report.index',compact('dailys','user'));
    }

    /**
     * 新しいリソースを作成するためのフォームを表示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.daily_report.create');
    }

    /**
     * 新しく作成したリソースをストレージに保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * 指定されたリソースを表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = $this->daily->find($id);
        return view('user.daily_report.show', compact('report'));
    }

    /**
     *指定したリソースを編集するためのフォームを表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = $this->daily->find($id);
        return view('user.daily_report.edit', compact('report'));
    }

    /**
     * ストレージ内の指定されたリソースを更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $input)
    {
        $this->daily->find($input['id'])->fill($input)->save();
        return redirect()->route('report.index');
    }

    /**
     * 指定されたリソースをストレージから削除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->daily->find($id)->delete();
        return redirect()->route('report.index');
    }

    /**
     * バリデーション
     */
    public function validates($request)
    {
        $validation = Validator::make($request, DailyReportRequest::rules()[0], DailyReportRequest::rules()[1])->validate();
    }
}
