@extends('partials.outline')

@section('content')
<h2 class="brand-header">質問一覧</h2>

<div class="main-wrap">
  <div class="btn-wrapper">
    <a class="btn" href="{{ route('question.create') }}">質問投稿</a>
    <a class="btn" href="{{ route('question.mypage') }}">マイページ</a>
    <a class="btn" href="#openModal">質問を検索</a>
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
  
  <div class="content-wrap">
    <table class="table table-hover todo-table">
      <thead>
        <tr>
          <th>タイトル</th>
          <th>カテゴリ</th>
          <th>解答</th>
        </tr>
      </thead>
      <tbody>
        @foreach($questions as $question)
          <tr>
            <td>{{ $question->title }}</td>
            <td>{{ $question->category->name }}</td>
            @if(!empty($question->answer))
            <td>済</td>
            @else
            <td><span class="point_color">未</span></td>
            @endif
            <td><a class="btn btn-success" href="question/{{ $question->id }}">確認する</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

