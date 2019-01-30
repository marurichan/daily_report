@extends ('partials.admin_outline')
@section ('content')

<h2 class="brand-header">勤怠情報</h2>
<div class="main-wrap">
  <div class="btn-wrapper">
    <div class="my-info day-info">
      <p>想定出席人数</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><img src=""></div>
        <p class="study-hour"><span>12</span>人</p>
      </div>
    </div>
    <div class="my-info">
      <p>ユーザー別出席状況</p>
      <div class="study-hour-box clearfix">
        <div class="userinfo-box"><img src=""></div>
        <p class="study-hour"><span></span>時間</p>
      </div>
    </div>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table">
      <caption>出社済み</caption>
      <thead>
        <tr class="row">
          <th class="col-xs-1"></th>
          <th class="col-xs-2">名前</th>
          <th class="col-xs-2">研修開始日</th>
          <th class="col-xs-3">出社時間</th>
          <th class="col-xs-2">修正申請</th>
          <th class="col-xs-2">詳細</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($userInfos as $userInfo)
          @if (!empty($userInfo->attendance) && !$userInfo->attendance->absent_flg)
            <tr class="row">
              <td class="col-xs-1"><img src="https://avatars.slack-edge.com/2019-01-11/521652138498_a80d324258d73c87ad2e_192.jpg" class="avatar-img"></td>
              <td class="col-xs-2">{{ $userInfo->name }}</td>
              <td class="col-xs-2">{{ $userInfo->created_at }}</td>
              <td class="col-xs-3">{{ $userInfo->attendance->start_time }}</td>
              <td class="col-xs-2">-</td>
              <td class="col-xs-2"><a class="btn btn-sucssess"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="content-wrapper table-responsive attendance-table">
    <table class="table">
      <caption>出社未登録</caption>
      <thead>
        <tr class="row">
          <th class="col-xs-1"></th>
          <th class="col-xs-4">名前</th>
          <th class="col-xs-4">研修開始日</th>
          <th class="col-xs-3">詳細</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($userInfos as $userInfo)
          @if (empty($userInfo->attendance))
            <tr class="row">
              <td class="col-xs-1"><img src="https://avatars.slack-edge.com/2019-01-11/521652138498_a80d324258d73c87ad2e_192.jpg" class="avatar-img"></td>
              <td class="col-xs-4">{{ $userInfo->name }}</td>
              <td class="col-xs-4">{{ $userInfo->created_at }}</td>
              <td class="col-xs-3"><a class="btn btn-sucssess"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="content-wrapper table-responsive attendance-table">
    <table class="table">
      <caption>欠席</caption>
      <thead>
        <tr class="row">
          <th class="col-xs-1"></th>
          <th class="col-xs-4">名前</th>
          <th class="col-xs-4">研修開始日</th>
          <th class="col-xs-3">詳細</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($userInfos as $userInfo)
          @if (!empty($userInfo->attendance) && $userInfo->attendance->absent_flg)
            <tr class="row">
              <td class="col-xs-1"><img src="https://avatars.slack-edge.com/2019-01-11/521652138498_a80d324258d73c87ad2e_192.jpg" class="avatar-img"></td>
              <td class="col-xs-4">{{ $userInfo->name }}</td>
              <td class="col-xs-4">{{ $userInfo->created_at }}</td>
              <td class="col-xs-3"><a class="btn btn-sucssess"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>

</div>

@endsection


