@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'report.store']) !!}
      <div class="form-group form-size-small">
        {!! Form::date('reporting_time', Carbon::now()->format('Y-m-d'), ['class' =>'form-control']) !!}
      <span class="help-block">{{ $errors->first('reporting_time') }}</span>
      </div>
      <div class="form-group">
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
      <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
      <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {!! Form::button('Add', ['type' => 'submit', 'class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

