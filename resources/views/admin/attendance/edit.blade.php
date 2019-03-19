@extends ('common.admin')
@section ('content')

<h2 class="brand-header">個別勤怠編集</h2>
<div class="main-wrap">
  <div class="user-info-box clearfix">
    <div class="left-info">
      <img src="{{ $attendance->user->avatar }}"><p class="user-name">{{ $attendance->user->name }}</p>
      <i class="fa fa-envelope-o" aria-hidden="true"><p class="user-email">{{ $attendance->user->email }}</p></i>
    </div>
    <div class="right-info">
      <div class="my-info day-info">
        <p>編集日</p>
        <div class="study-hour-box clearfix">
          <div class="userinfo-box"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></div>
          <p class="study-hour study-date"><span>{{ $attendance->date->format('m/d') }}</span></p>
        </div>
      </div>
      <div class="my-info">
        <p>研修開始日</p>
        <div class="study-hour-box clearfix">
          <p class="study-hour study-date"><span>{{ $attendance->user->created_at->format('Y/m/d') }}</span></p>
        </div>
      </div>
    </div>
  </div>
  @if ($attendance->absent_flg)
    <div class="request-box">
      <div class="request-title">
        <img src="{{ $attendance->user->avatar }}" class="avatar-img">
        <p class="absent">欠席理由</p>
      </div>
      <div class="request-content">{{ $attendance->absent_reason }}</div>
    </div>
  @endif
  @if (!empty($attendance->request_content))
    <div class="request-box">
      <div class="request-title">
        <img src="{{ $attendance->user->avatar }}" class="avatar-img">
        <p>修正申請内容</p>
      </div>
      <div class="request-content">{{ $attendance->request_content }}</div>
    </div>
  @endif

  <div class="attendance-modify-box">
    {!! Form::open(['route' => ['admin.attendance.user.update', $attendance->user->id], 'method' => 'put']) !!}
      {!! Form::input('hidden', 'id', $attendance->id) !!}
      {!! Form::input('hidden', 'date', $attendance->date->format('Y-m-d')) !!}
      {!! Form::input('hidden', 'request_content', null) !!}
      {!! Form::input('hidden', 'absent_flg', 0) !!}
      {!! Form::input('hidden', 'absent_reason', null) !!}
      <div class="form-group {{ $errors->has('start_time') ? 'has-error' : '' }}">
        @if (empty($attendance->start_time))
          {!! Form::input('time', 'start_time', null, ['class' => 'form-control']) !!}
        @else
          {!! Form::input('time', 'start_time', $attendance->start_time->format('H:i'), ['class' => 'form-control']) !!}
        @endif
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      <p class="to-time">to</p>
      <div class="form-group {{ $errors->has('end_time') ? 'has-error' : '' }}">
        @if (empty($attendance->end_time))
          {!! Form::input('time', 'end_time', null, ['class' => 'form-control']) !!}
        @else
          {!! Form::input('time', 'end_time', $attendance->end_time->format('H:i'), ['class' => 'form-control']) !!}
        @endif
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      <button type="submit" class="btn btn-modify">修正</button>
    {!! Form::close() !!}
    {!! Form::open(['route' => ['admin.attendance.user.update', $attendance->user->id], 'method' => 'put']) !!}
      {!! Form::input('hidden', 'id', $attendance->id) !!}
      {!! Form::input('hidden', 'start_time', null) !!}
      {!! Form::input('hidden', 'end_time', null) !!}
      {!! Form::input('hidden', 'request_content', null) !!}
      {!! Form::input('hidden', 'absent_flg', 1) !!}
      {!! Form::input('hidden', 'absent_reason', '管理画面から登録') !!}
      {!! Form::input('hidden', 'date', $attendance->date->format('Y-m-d')) !!}
      <button type="submit" class="btn btn-danger">欠席</button>
    {!! Form::close() !!}
  </div>

</div>

@endsection


