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
    <a class="button start-btn" href=#openModal>出社時間登録</a>
  </div>

  <ul class="button-wrap">
    <li>
      <a class="at-btn absence">欠席登録</a>
    </li>
    <li>
      <a class="at-btn modify">修正申請</a>
    </li>
    <li>
      <a class="at-btn my-list">マイページ</a>
    </li>
  </ul>

</div>


<div id="openModal" class="modalDialog">
  <div>
    <div class="register-text-wrap">
      <p>09:56 で出社時間を登録しますか?</p>
    </div>
    <div class="register-btn-wrap">
      <a href="#close" class="cancel-btn">Cancel</a>
      <a href="#close" class="yes-btn">Yes</a>
    </div>
  </div>
</div>

@endsection

