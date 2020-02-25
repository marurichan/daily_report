@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'report.store']) !!}
      {!! Form::input('hidden', 'user_id', '1', ['class' => 'form-control']) !!}
      {!! Form::input('hidden', 'id', $report->id, ['class' => 'form-control']) !!}
      <div class="form-group form-size-small">
        {!! Form::input('date', 'reporting_time', $report->reporting_time->format('Y-m-d'), ['class' => 'form-control']) !!}
        <span class="help-block">{{ $errors->first('reporting_time') }}</span>
      </div>
      <div class="form-group">
        {!! Form::input('text', 'title', $report->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', $report->content, ['class' => 'form-control', 'placeholder' => '本文', 'cols' => '50', 'rows' => '10']) !!}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {!! Form::submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

