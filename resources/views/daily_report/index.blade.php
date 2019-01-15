@extends('partials.outline')

@section('content')

<h2 class="brand-header">日報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper">
    <a class="btn btn-icon" href="#openModal"><i class="fa fa-search"></i></a>
    <a class="btn btn-icon" href="{{ route('report.create') }}"><i class="fa fa-plus"></i></a>
  </div>

  <!-- modal -->
  <div id="openModal" class="modalDialog">
    <div>
      {!! Form::open(['route' => 'report.index', 'method' => 'GET']) !!}
        <a href="#close" title="Close" class="close">X</a>
        <table class="search-table">
          <thead class="search-thead"></thead>
          <h3 class="modal-header">日報検索</h3>
          <tbody class="search-tbody">
            <td class="search-td">
              <label>始め</label>
            </td>
            <td class="search-td"></td>
            <td class="search-td">
              {!! Form::input('date', 'from-date', null, ['class' => 'form-control']) !!}
            </td>
            <td class="search-td">
              <label>終わり</label>
            </td>
            <td class="search-td">
              {!! Form::input('date', 'to-date', null, ['class' => 'form-control']) !!}
            </td>
          </tbody>
          <tfoot class="search-tfoot">
            <tr class="search-tr">
              <td colspan="5" class="search-td">
                <div class="bottom-btn-wrapper">
                  {!! Form::input('submit', '', '検索', ['class' => 'btn btn-success']) !!}
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      {!! Form::close() !!}
    </div>
  </div><!-- modal closing tag -->

  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">Date</th>
          <th class="col-xs-3">Title</th>
          <th class="col-xs-5">Content</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($reports as $report)
          <tr class="row">
            <td class="col-xs-2">{{ date("Y/m/d", strtotime($report->reporting_time)) }}</td>
            <td class="col-xs-3">{{ $report->title }}</td>
            <td class="col-xs-5">{{ mb_strimwidth($report->contents, 0, 50, '...', 'UTF-8') }}</td>
            <td class="col-xs-2"><a class="btn" href="report/{{ $report->id }}"><i class="fa fa-book"></i></a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</div>

@endsection

