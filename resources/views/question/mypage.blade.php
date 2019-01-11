@extends('partials.outline')
@section('content')

<h2 class="brand-header">
  <img src="{{ Auth::user()->avatar }}" style="width: 25px; border-radius: 50%;">&nbsp;&nbsp;My page
</h2>
<div class="main-wrap">
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">category</th>
          <th class="col-xs-6">title</th>
          <th class="col-xs-2">comments</th>
          <th class="col-xs-1"></th>
          <th class="col-xs-1"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($questions as $question)
          <tr class="row">
            <td class="col-xs-2">{{ $question->category->name }}</td>
            <td class="col-xs-6">{{ $question->title }}</td>
            <td class="col-xs-2"><span class="point_color">0 comments</span></td>
            <td class="col-xs-1">
              <a class="btn btn-success" href="{{ route('question.edit', $question->id) }}">
                <i class="fa fa-pencil" aria-hidden="true"></i>
              </a>
            </td>
            <td class="col-xs-1">
              {!! Form::open(['route' => ['question.destroy', $question->id], 'method' => 'DELETE']) !!}
                <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
              {!! Form::close() !!}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="btn-bottom-wrapper left-side">
      <a href="{{ route('question.index') }}" class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    </div>
  </div>
</div>

@endsection

