@extends ('partials.outline')
@section ('content')

<h2 class="brand-header">勤怠登録</h2>

<div class="main-wrap">

  <div id="clock" class="light">
    <div class="display">
      <div class="weekdays"></div>
      <div class="today"></i></div>
      <div class="digits"></div>
    </div>
  </div>
  <div class="button-holder">
    @if (empty($attendance))
      <a class="button start-btn" id="register-attendance" href=#openModal>出社時間登録</a>
    @elseif ($attendance['absent_flg'] === 1)
      <a class="button absent-label" id="register-attendance" href="">欠席</a>
    @else
      <a class="button end-btn" id="register-attendance" href=#openModal>退社時間登録</a>
    @endif
  </div>
  <ul class="button-wrap">
    <li>
      <a class="at-btn absence" href="{{ route('attendance.absence') }}">欠席登録</a>
    </li>
    <li>
      <a class="at-btn modify" href="{{ route('attendance.modify') }}">修正申請</a>
    </li>
    <li>
      <a class="at-btn my-list" href="{{ route('attendance.mypage') }}">マイページ</a>
    </li>
  </ul>
</div>

<div id="openModal" class="modalDialog">
  <div>
    <div class="register-text-wrap">
      <p>Cancelを押して再度登録してください</p>
    </div>
    <div class="register-btn-wrap">
      {!! Form::open(['route' => 'attendance.register']) !!}
        {!! Form::input('hidden', 'date', date('Y-m-d')) !!}
        {!! Form::input('hidden', 'start_time', null, ['id' => 'date-time-target']) !!}
        {!! Form::input('hidden', 'user_id', Auth::id() ) !!}
        <a href="#close" class="cancel-btn">Cancel</a>
        {!! Form::submit('Yes', ['class' => 'yes-btn']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection

