@extends ('common.user')
@section ('content')

<h2 class="brand-header">マイページ</h2>

<div class="main-wrap">
  <div class="btn-wrapper">
    <div class="my-info day-info">
      <p>学習経過日数</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><img src="{{ Auth::user()->avatar }}"></div>
        <p class="study-hour"><span>{{ $dateSum['daySum'] }}</span>日</p>
      </div>
    </div>
    <div class="my-info">
      <p>累計学習時間</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><img src="{{ Auth::user()->avatar }}"></div>
        <p class="study-hour"><span>{{ $dateSum['timeSum'] }}</span>時間</p>
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
        @foreach ($workInfos as $workInfo)
          <tr class="row {{ $workInfo->absent_flg ? 'absent-row' : '' }}">
            <td class="col-xs-2">{{ $workInfo->date->format('m/d (D)') }}</td>
            @if (empty($workInfo->start_time))
              <td class="col-xs-3">-</td>
            @else
              <td class="col-xs-3">{{ $workInfo->start_time->format('H:i') }}</td>
            @endif
            @if (empty($workInfo->end_time))
              <td class="col-xs-3">-</td>
            @else
              <td class="col-xs-3">{{ $workInfo->end_time->format('H:i') }}</td>
            @endif
            @if ($workInfo->absent_flg)
              <td class="col-xs-2">欠席</td>
            @elseif (!empty($workInfo->start_time) && empty($workInfo->end_time))
              <td class="col-xs-2">研修中</td>
            @else
              <td class="col-xs-2">出社</td>
            @endif
            <td class="col-xs-2">{{ empty($workInfo->request_content) ? '-' : '申請中' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

