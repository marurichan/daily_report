@extends ('partials.outline')
@section ('content')

<h2 class="brand-header">マイページ</h2>

<div class="main-wrap">
  <div class="btn-wrapper">
    <div class="my-info">
      <p>累計学習時間</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><img src="{{ Auth::user()->avatar }}"></div>
        <p class="study-hour">{{ $dateSum['daySum'] }}&nbsp;日<span>{{ $dateSum['timeSum'] }}</span>時間</p>
      </div>
    </div>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table">
      <thead>
        <tr class="row">
          <th class="col-xs-2">date</th>
          <th class="col-xs-3">start time</th>
          <th class="col-xs-3">end time</th>
          <th class="col-xs-2">state</th>
          <th class="col-xs-2">request</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($attendanceInfos as $attendanceInfo)
          <tr class="row {{ $attendanceInfo->absent_flg ? 'absent-row' : '' }}">
            <td class="col-xs-2">{{ $attendanceInfo->date }}</td>
            @if (empty($attendanceInfo->start_time))
              <td class="col-xs-3">-</td>
            @else
              <td class="col-xs-3">{{ date_format(date_create($attendanceInfo->start_time), 'H:i') }}</td>
            @endif
            @if (empty($attendanceInfo->end_time))
              <td class="col-xs-3">-</td>
            @else
              <td class="col-xs-3">{{ date_format(date_create($attendanceInfo->end_time), 'H:i') }}</td>
            @endif
            <td class="col-xs-2">{{ $attendanceInfo->absent_flg ? '欠席' : '-' }}</td>
            <td class="col-xs-2">{{ empty($attendanceInfo->request_content) ? '-' : '申請中' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

