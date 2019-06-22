@extends('layouts.admin')
@section('content')
<div class="container mt-3">
  <div class="row">
    <div class="col-md-12">

      @include('admin.common.header', [
        'title' => 'Alerts',
        'icon' => 'comment',
        'button' => [
          'title' => 'Add',
          'route' => 'admin.alert.create',
          'icon' => 'plus',
        ],
      ])

      @include('common.success')

      @if ($alerts->count())
        <div class="table-responsive">
          <table class="table table-striped">
            <thead class="thead-light">
              <tr>
                <th>Active?</th>
                <th>Pages</th>
                <th>Color</th>
                <th>From</th>
                <th>To</th>
                <th>Text</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($alerts as $alert)
              <tr>
                <td>
                  <h5>
                  @if ($alert->isActive())
                    <span class="badge badge-success">
                      Yes
                    </span>
                  @else
                    <span class="badge badge-info">
                      No
                    </span>
                  @endif
                  </h5>
                </td>
                <td>
                  @if ($alert->routes)
                    {{ implode(', ', $alert->routes) }}
                  @else
                    All
                  @endif
                </td>
                <td>
                  <span class="badge badge-{{ $alert->class }}">
                    <i class="fa fa-tint"></i>
                  </span>
                </td>
                <td>
                  {{ $alert->from_date->toDateString() }}
                </td>
                <td>
                  {{ $alert->to_date->toDateString() }}
                </td>
                <td>
                  {{ str_limit(strip_tags($alert->content_en), 50) }}
                </td>
                <td align="right" style="white-space:nowrap;">
                  <a href="{{ route('admin.alert.edit', $alert) }}"
                    class="btn btn-sm btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <a href="#"
                    class="btn btn-sm btn-danger destroy-alert"
                    data-alert-id="{{ $alert->id }}">
                    <i class="far fa-trash-alt"></i>
                  </a>
                  <form id="destroy-alert-{{ $alert->id }}"
                      action="{{ route('admin.alert.destroy', $alert) }}"
                      method="POST"
                      style="display: none;">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="alert alert-info">
          <i class="fas fa-info-circle"></i>
          No alerts saved.
        </div>
      @endif

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
  $('.destroy-alert').click(function() {
    event.preventDefault()

    if (!confirm('Do you really want to delete this alert?')) {
      return
    }

    var id = $( this ).data('alert-id')
    $('#destroy-alert-' + id).submit()
  })
})
</script>
@endpush
