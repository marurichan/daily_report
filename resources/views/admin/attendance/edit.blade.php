@extends ('partials.admin_outline')
@section ('content')

<h2 class="brand-header">個別勤怠編集</h2>
<div class="main-wrap">
  <div class="user-info-box clearfix">
    <div class="left-info">
      <img src="{{ $attendance->user->avatar }}"><p class="user-name">{{ $attendance->user->name }}</p>
      <i class="fa fa-envelope-o" aria-hidden="true"><p class="user-email">{{ $attendance->user->email }}</p></i>
    </div>
    <div class="right-info">
      <div class="my-info">
        <p>研修開始日</p>
        <div class="study-hour-box clearfix">
          <p class="study-hour start-date"><span>{{ $attendance->user->created_at->format('Y-m-d') }}</span></p>
        </div>
      </div>
    </div>
  </div>
  @if (!empty($attendance->request_content))
    <div class="request-box">
      <div class="request-content">{{ $attendance->request_content }}</div>
    </div>
  @endif

</div>

@endsection


