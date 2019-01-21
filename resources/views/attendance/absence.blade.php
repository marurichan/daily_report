@extends ('partials.outline')
@section ('content')

<h2 class="brand-header">欠席登録</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.confirm', 'method' => 'post']) !!}
      <div class="form-group {{ $errors->has('title')? 'has-error' : '' }}">
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
      </div>
      <div class="form-group {{ $errors->has('content')? 'has-error' : '' }}">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Please write down the reason for your absence...']) !!}
      </div>
      {!! Form::submit('register', ['name' => 'confirm', 'class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

