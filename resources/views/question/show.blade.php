@extends('partials.outline')
@section('content')

<h1 class="brand-header">質問詳細</h1>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      <img src="{{ $question->user->avatar }}" class="avatar-img">&nbsp;&nbsp;
      {{ $question->user->name }}&nbsp;&nbsp;さんの質問
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Category</th>
            <td class="td-text">{{ $question->category->name }}</td>
          </tr>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $question->title }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{!! nl2br(e($question->content)) !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  @if (!empty($question->comment))
    <div class="comment-list">
      @foreach ($question->comment as $comment)
        <div class="comment-wrap">
          <div class="comment-title">
            <img src="{{ $comment->user->avatar }}" class="avatar-img"><p>{{ $comment->user->name }}</p>
          </div>
          <div class="comment-body">
            {!! nl2br(e($comment->comment)) !!}
          </div>
        </div>
      @endforeach
    </div>
  @endif




  <div class="comment-box">
    <div class="comment-title">
      <img src="{{ Auth::user()->avatar }}" class="avatar-img"><p>コメントを投稿する</p>
    </div>
    <div class="comment-body">
      {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Add your comment...']) !!}
    </div>
    <div class="comment-bottom">
      <button type="submit" class="btn btn-success pull-right"><i class="fa fa-reply" aria-hidden="true"></i></i></button>
    </div>
  </div>

</div>

@endsection

