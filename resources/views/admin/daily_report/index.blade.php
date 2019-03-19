@extends ('common.admin')
@section ('content')

<h2 class="brand-header">日報一覧</h2>
<div class="main-wrap clearfix">


  <div class="left-box">
    <div class="content-wrapper table-responsive">
      <table class="table">
        <caption><p>本日の日報</p></caption>
        <thead>
          <tr class="row">
            <th class="col-xs-1"></th>
            <th class="col-xs-4">名前</th>
            <th class="col-xs-5">タイトル</th>
            <th class="col-xs-2">詳細</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            @if (!empty($user->attendance) && !empty($user->attendance->report))
              <tr class="row">
                <td class="col-xs-1"><img src="{{ $user->avatar }}" class="avatar-img"></td>
                <td class="col-xs-4">{{ $user->name }}</td>
                <td class="col-xs-5">{{ $user->attendance->report->title }}</td>
                <td class="col-xs-2">
                  <a href="{{ route('admin.report.show', $user->id) }}" class="btn btn-sucssess">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
            @else
              <tr class="row">
                <td class="col-xs-1"><img src="{{ $user->avatar }}" class="avatar-img"></td>
                <td class="col-xs-4">{{ $user->name }}</td>
                <td class="col-xs-5">未提出</td>
                <td class="col-xs-2"><i class="fa fa-times" aria-hidden="true"></i></td>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="right-box">
    <div class="right-parts table-responsive">
      <table class="table">
        <caption>日報未提出者</caption>
        <tbody>
          @foreach ($users as $user)
            @if (!empty($user->attendance) && empty($user->attendance->report) && !$user->attendance->absent_flg)
              <tr class="row">
                <td class="col-xs-2"><img src="{{ $user->avatar }}" class="avatar-img"></td>
                <td class="col-xs-5">
                  <a href="{{ route('admin.report.show', $user->id) }}">{{ $user->name }}</a>
                </td>
                <td class="col-xs-3">{{ $user->created_at->format('m/d') }}&nbsp;~</td>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="right-parts absent table-responsive">
      <table class="table">
        <caption>欠席者</caption>
        <tbody>
          @foreach ($users as $user)
            @if (!empty($user->attendance) && $user->attendance->absent_flg)
              <tr class="row">
                <td class="col-xs-2"><img src="{{ $user->avatar }}" class="avatar-img"></td>
                <td class="col-xs-5">
                  <a class="{{ route('admin.report.show', $user->id) }}">{{ $user->name }}</a>
                </td>
                <td class="col-xs-3">{{ $user->created_at->format('m/d') }}&nbsp;~</td>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>


</div>

@endsection
