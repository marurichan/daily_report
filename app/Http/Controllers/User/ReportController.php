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

    public function create()
    {
        return view('user.daily_report.create');
    }

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

    public function show($id)
    {
        $report = $this->daily->find($id);
        return view('user.daily_report.show', compact('report'));
    }

    public function edit($id)
    {
        $report = $this->daily->find($id);
        return view('user.daily_report.edit', compact('report'));
    }

    public function update(Request $request, $input)
    {
        $this->daily->find($input['id'])->fill($input)->save();
        return redirect()->route('report.index');
    }

    public function destroy($id)
    {
        $this->daily->find($id)->delete();
        return redirect()->route('report.index');
    }

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
