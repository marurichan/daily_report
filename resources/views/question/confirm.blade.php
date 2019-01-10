@extends('partials.outline')
@section('content')

<h2 class="brand-header">投稿内容確認</h2>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      {{ $category }}&nbsp;&nbsp;の質問
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $inputs['title'] }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{!! $question !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="btn-bottom-wrapper">
    {!! Form::open(isset($inputs['create']) ? ['route' => 'question.store', 'method' => 'post'] : ['route' => ['question.update', $inputs['id']], 'method' => 'put']) !!}
      {!! Form::hidden('tag_category_id', $inputs['tag_category_id'], ['class' => 'form-control']) !!}
      {!! Form::hidden('title', $inputs['title'], ['class' => 'form-control']) !!}
      {!! Form::hidden('content', $inputs['content'], ['class' => 'form-control']) !!}
      <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button>
    {!! Form::close() !!}
  </div>
</div>

@endsection

