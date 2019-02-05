@extends ('partials.admin_outline')
@section ('content')

<h2 class="brand-header">個別勤怠管理</h2>
<div class="main-wrap">
  <div class="user-info-box clearfix">
    <div class="left-info">
      <img src="{{ $userInfo->avatar }}"><p class="user-name">{{ $userInfo->name }}</p>
      <i class="fa fa-envelope-o" aria-hidden="true"><p class="user-email">{{ $userInfo->email }}</p></i>
    </div>
    <div class="right-info">
      <div class="my-info absence-info">
        <p>欠席回数</p>
        <div class="study-hour-box clearfix">
          <div class="userinfo-box"><i class="fa fa-ban fa-2x" aria-hidden="true"></i></div>
          <p class="study-hour"><span>{{ $absentLateCount['absentCount'] }}</span>回</p>
        </div>
      </div>
      <div class="my-info day-info">
        <p>遅刻回数</p>
        <div class="study-hour-box clearfix">
          <div class="userinfo-box"><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></div>
          <p class="study-hour"><span>{{ $absentLateCount['lateCount'] }}</span>回</p>
        </div>
      </div>
      <div class="my-info">
        <p>研修開始日</p>
        <div class="study-hour-box clearfix">
          <p class="study-hour start-date"><span>{{ $userInfo->created_at->format('Y/m/d') }}</span></p>
        </div>
      </div>
    </div>
  </div>

  <div class="content-wrapper table-responsive">
    <table class="table">
      <thead>
        <tr class="row">
          <th class="col-xs-1">日付</th>
          <th class="col-xs-1">曜日</th>
          <th class="col-xs-2">状態</th>
          <th class="col-xs-2">出社時間</th>
          <th class="col-xs-2">退社時間</th>
          <th class="col-xs-2">修正申請</th>
          <th class="col-xs-2">修正</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($userInfo->allAttendance as $attendance)
          @if (!empty($attendance))
            <tr class="row {{ $attendance->absent_flg ? 'absent-row' : '' }}">
              <td class="col-xs-1">{{ $attendance->date->format('m/d') }}</td>
              <td class="col-xs-1">{{ $attendance->date->format('D') }}</td>
              @if ($attendance->absent_flg)
                <td class="col-xs-2">欠席</span></td>
              @elseif ($attendance->date == Carbon::today() && empty($attendance->end_time))
                <td class="col-xs-2">研修中</td>
              @else
                <td class="col-xs-2">出社</td>
              @endif
              @if (empty($attendance->start_time))
                <td class="col-xs-2">-</td>
              @else
                <td class="col-xs-2">{{ $attendance->start_time->format('H:i') }}</td>
              @endif
              @if (empty($attendance->end_time))
                <td class="col-xs-2">-</td>
              @else
                <td class="col-xs-2">{{ $attendance->end_time->format('H:i') }}</td>
              @endif
              @if (empty($attendance->request_content))
                <td class="col-xs-2">-</td>
              @else
                <td class="col-xs-2"><span class="attention">あり</span></td>
              @endif
              <td class="col-xs-2">
                <a href="{{ route('admin.attendance.user.edit', [$userInfo->id, $attendance->date->format('Y-m-d')]) }}" class="btn btn-sucssess btn-small">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>


</div>

@endsection

