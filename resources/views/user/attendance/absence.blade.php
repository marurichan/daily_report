@extends ('common.user')
@section ('content')

<h2 class="brand-header">欠席登録</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'attendance.absence.store']) !!}
      {!! Form::input('hidden', 'date', Carbon::now()->format('Y-m-d')) !!}
      {!! Form::input('hidden', 'absent_flg', 1) !!}
      {!! Form::input('hidden', 'user_id', Auth::id() ) !!}
      <div class="form-group {{ $errors->has('absent_reason')? 'has-error' : '' }}">
        {!! Form::textarea('absent_reason', null, ['class' => 'form-control', 'placeholder' => '欠席理由を入力してください。']) !!}
        <span class="help-block">{{ $errors->first('absent_reason') }}</span>
      </div>
      {!! Form::submit('register', ['name' => 'confirm', 'class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

