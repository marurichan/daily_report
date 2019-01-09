@extends('partials.outline')

@section('content')

<h1 class="brand-header">日報詳細</h1>

<div class="main-wrap">

  <div class="panel panel-success">
    <div class="panel-heading">
      {{ date("Y/m/d", strtotime($report->reporting_time)) }}&nbsp;&nbsp;の日報
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="report-column">Title</th>
            <td class="td-text">{{ $report->title }}</td>
          </tr>
          <tr>
            <th class="report-column">Content</th>
            <td class='td-text'>{!! nl2br(e($report->contents)) !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="btn-bottom-wrapper">
    <a class="btn btn-edit" href="{{ route('report.edit', $report->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
    <div class="btn-delete">
      {!! Form::open(['route' => ['report.destroy', $report->id], 'method' => 'DELETE']) !!}
        <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o"></i></button>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection
