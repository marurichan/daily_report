@extends ('common.admin')
@section ('content')

<h2 class="brand-header">個別勤怠作成</h2>
<div class="main-wrap">
  <div class="user-info-box clearfix">
    <div class="left-info">
      <img src="{{ $userInfo->avatar }}"><p class="user-name">{{ $userInfo->name }}</p>
      <i class="fa fa-envelope-o" aria-hidden="true"><p class="user-email">{{ $userInfo->email }}</p></i>
    </div>
    <div class="right-info">
      <div class="my-info">
        <p>研修開始日</p>
        <div class="study-hour-box clearfix">
          <p class="study-hour study-date"><span>{{ $userInfo->created_at->format('Y/m/d') }}</span></p>
        </div>
      </div>
    </div>
  </div>

  <div class="attendance-modify-box">
    {!! Form::open(['route' => ['admin.attendance.user.update', $userInfo->id], 'method' => 'post']) !!}
      {!! Form::input('hidden', 'user_id', $userInfo->id) !!}
      <div class="form-group date-form">
        {!! Form::input('date', 'date', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::input('time', 'start_time', null, ['class' => 'form-control']) !!}
      </div>
      <p class="to-time">to</p>
      <div class="form-group">
        {!! Form::input('time', 'end_time', null, ['class' => 'form-control']) !!}
      </div>
      {!! Form::button('作成', ['class' => 'btn btn-modify', 'type' => 'submit']) !!}
    {!! Form::close() !!}
    {!! Form::open(['route' => ['admin.attendance.user.update', $userInfo->id], 'method' => 'post']) !!}
      {!! Form::input('hidden', 'user_id', $userInfo->id) !!}
      {!! Form::input('hidden', 'start_time', null) !!}
      {!! Form::input('hidden', 'end_time', null) !!}
      {!! Form::input('hidden', 'absent_flg', 1) !!}
      {!! Form::input('hidden', 'absent_reason', '管理画面から登録') !!}
      {!! Form::input('hidden', 'date', null, ['id' => 'date-target']) !!}
      {!! Form::button('欠席', ['class' => 'btn btn-danger', 'type' => 'submit']) !!}
    {!! Form::close() !!}
  </div>

</div>

@endsection



