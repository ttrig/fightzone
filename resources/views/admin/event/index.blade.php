@extends('layouts.admin')
@section('content')

<div class="container mt-3 mb-3">
  @include('admin.common.header', [
    'title' => 'Schedule',
    'icon' => 'calendar-alt',
    'button' => [
      'icon' => 'plus',
      'title' => 'Add',
      'route' => 'admin.event.create'
    ]
  ])

  @include('common.success')
  @include('common.errors')

  @foreach ($activities as $activity)
  <h4>
    {{ $activity->name }}
  </h4>
  @if ($activity->events->isEmpty())
    <div class="alert alert-warning">
      <p>
        <i class="fa fa-exclamation-circle"></i>
        No scheduled classes.
      </p>
      <a href="{{ route('admin.event.create') }}" class="btn btn-sm btn-success">
        <i class="fa fa-plus"></i>
        add
      </a>
    </div>
    @continue
  @endif
  <table class="table table-striped table-hover table-sm">
    <thead class="thead-light">
      <tr>
        <th>Day</th>
        <th>From</th>
        <th>To</th>
        <th style="white-space:nowrap;">Open mat?</th>
        <th>English text</th>
        <th>Swedish text</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($activity->events as $event)
      <tr data-id="{{ $event->id }}" class="{{ $event->is_enabled ? '' : 'text-muted-light' }}">
        <td>
          {{ __('app.schedule.day.' . $event->dow) }}
        </td>
        <td>
          {{ $event->from_time }}
        </td>
        <td>
          {{ $event->to_time }}
        </td>
        <td>
          {{ $event->is_open_mat ? 'Yes' : 'No' }}
        </td>
        <td>
          {{ $event->content_en }}
        </td>
        <td>
          {{ $event->content_sv }}
        </td>
        <td align="right" style="white-space:nowrap;">
          @if ($event->is_enabled)
            <button class="btn btn-sm btn-warning disable-button"
              type="button"
              title="Disable event to hide it from the public schedule."
              data-url="{{ route('admin.event.disable', $event) }}"
            >
              <i class="fa fa-toggle-off"></i>
            </button>
          @else
            <button class="btn btn-sm btn-success enable-button"
              type="button"
              title="Enable event to show it on the public schedule."
              data-url="{{ route('admin.event.enable', $event) }}"
            >
              <i class="fa fa-toggle-on"></i>
            </button>
          @endif
          <a class="btn btn-sm btn-primary" href="{{ route('admin.event.edit', $event) }}">
            <i class="fa fa-pen"></i>
          </a>
          <button class="btn btn-sm btn-danger delete-button"
            type="button"
            title="Delete"
            data-url="{{ route('admin.event.destroy', $event) }}"
          >
            <i class="fa fa-trash-alt"></i>
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endforeach
</div>

<form id="put-form" role="form" method="POST" action="#">
  {{ method_field('PUT') }}
  {!! csrf_field() !!}
</form>

<form id="delete-form" role="form" method="POST" action="#">
  {{ method_field('DELETE') }}
  {!! csrf_field() !!}
</form>

@endsection

@push('scripts')
<script>
$(function() {
  $('.disable-button').click(function() {
    if (confirm('Do you want to disable this event?')) {
      $('form#put-form').prop('action', $( this ).data('url')).submit()
    }
  })

  $('.enable-button').click(function() {
    if (confirm('Do you want to enable this event?')) {
      $('form#put-form').prop('action', $( this ).data('url')).submit()
    }
  })

  $('.delete-button').click(function() {
    if (confirm('Are you sure?')) {
      $('form#delete-form').prop('action', $( this ).data('url')).submit()
    }
  })
})
</script>
@endpush
