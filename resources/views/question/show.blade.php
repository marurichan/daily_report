@extends('partials.outline')
@section('content')

<h1 class="brand-header">質問詳細</h1>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      {{ $questions->category->name }}&nbsp;&nbsp;の質問
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $questions->title }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{!! $questions->mark_content !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="btn-bottom-wrapper left-side">
    <a href="{{ route('question.index') }}" class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
  </div>
</div>

@endsection

