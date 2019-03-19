@extends ('common.admin')
@section ('content')

<h2 class="brand-header">個別日報一覧</h2>
<div class="main-wrap admin-report">

  @foreach ($reports as $report)
    <div class="panel panel-success">
      <div class="panel-heading">
        <img src="{{ $report->user->avatar }}" class="avatar-img">
        <p>{{ $report->reporting_time->format('Y/m/d (D)') }} の日報</p>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <tbody>
            <tr>
              <th class="table-column">Title</th>
              <td class="td-text">{{ $report->title }}</td>
            </tr>
            <tr>
              <th class="table-column">Content</th>
              <td class='td-text'>{!! nl2br(e($report->contents)) !!}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  @endforeach

</div>

@endsection

