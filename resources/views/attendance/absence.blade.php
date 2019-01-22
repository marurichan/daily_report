@extends ('partials.outline')
@section ('content')

<h2 class="brand-header">欠席登録</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'attendance.createAbsence', 'method' => 'post']) !!}
      {!! Form::input('hidden', 'date', date("Y/m/d")) !!}
      {!! Form::input('hidden', 'absent_flg', 1) !!}
      {!! Form::input('hidden', 'user_id', Auth::id() ) !!}
      <div class="form-group {{ $errors->has('content')? 'has-error' : '' }}">
        {!! Form::textarea('absent_reason', null, ['class' => 'form-control', 'placeholder' => 'Please write down the reason for your absence...']) !!}
      </div>
      {!! Form::submit('register', ['name' => 'confirm', 'class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

