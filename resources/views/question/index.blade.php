@extends('partials.outline')

@section('content')
<h2 class="brand-header">質問一覧</h2>

<div class="main-wrap">
  <div class="btn-wrapper">
    <a class="btn" href="{{ route('question.create') }}"><i class="fa fa-plus" aria-hidden="true"></i></a>
    <a class="btn" href="{{ route('question.mypage') }}"><i class="fa fa-user" aria-hidden="true"></i></a>
    <a class="btn" href="#openModal"><i class="fa fa-search" aria-hidden="true"></i></a>
  </div>
  <div class="category-wrap">
    {!! Form::open(['route' => 'question.index', 'method' => 'GET']) !!}
      {!! Form::input('hidden', 'tag_category_id', '0') !!}
      {!! Form::input('submit', 'category_name', 'ALL', ['class' => 'btn all']) !!}
      @foreach ($categories as $category)
        {!! Form::input('hidden', 'tag_category_id', $category->id) !!}
        {!! Form::input('submit', 'category_name', $category->name, ['class' => 'btn '.$category->name]) !!}
      @endforeach
    {!! Form::close() !!}
  </div>
  
  <div id="openModal" class="modalDialog">
    <div>
      {!! Form::open(['route' => 'question.index', 'method' => 'GET']) !!}
        <a href="#close" title="Close" class="close">X</a>
        <table class="search-table">
          <thead class="search-thead">
          </thead>
          <div class="modal-header">質問検索</div>
          <tbody class="search-tbody">
            <tr>
              <td class="search-td">
                <label>
                  キーワード
                </label>
              </td>
              <td class="search-td">
                {!! Form::text('search', null, ['class' => 'form-control']) !!}
              </td>
            </tr>
            <tr>
            <td class="search-td">
              <label>
                カテゴリ
              </label>
            </td>
            <td class="search-td">
              <div class="form-group @if(!empty($errors->first('tag_category_id'))) has-error @endif">
                <select name='tag_category_id' class="form-control" id="pref_id">
                  <option value="">カテゴリ</option>
                  @foreach($categories as $category)
                  <option value= "{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
                <span class="help-block">{{$errors->first('tag_category_id')}}</span>
              </div>
            </td>
            </tr>
          </tbody>
          <tfoot class="search-tfoot">
            <tr class="search-tr">
              <td colspan="5" class="search-td">
                <div class="bottom-btn-wrapper">
                {!! Form::input('submit', '', '検索', ['class' => 'btn btn-success btn-sm']) !!}
              </td>
            </tr>
          </tfoot>
        </table>
      {!! Form::close() !!}
    </div>
  </div>
  
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-1">user</th>
          <th class="col-xs-2">category</th>
          <th class="col-xs-6">title</th>
          <th class="col-xs-1">comments</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($questions as $question)
          <tr class="row">
            <td class="col-xs-1"><img src="{{ Auth::user()->avatar }}" style="width: 30px; border-radius: 50%;"></td>
            <td class="col-xs-2">{{ $question->category->name }}</td>
            <td class="col-xs-6">{{ $question->title }}</td>
            @if(!empty($question->answer))
              <td class="col-xs-1">済</td>
            @else
              <td class="col-xs-1"><span class="point_color">未</span></td>
            @endif
            <td class="col-xs-2">
              <a class="btn btn-success" href="question/{{ $question->id }}">
                <i class="fa fa-comments-o" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

