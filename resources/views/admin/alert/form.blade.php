@extends('layouts.admin')

@push('scripts')
<script src="{{ mix('js/admin-text-edit.js') }}"></script>
<script>
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: moment().format('YYYY-MM-DD'),
    todayHighlight: true,
    weekStart: 1,
    orientation: 'bottom'
  })
</script>
@endpush

@section('content')
<div class="container mt-3">
  <div class="row">
    <div class="col-md-12">

      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-comment"></i>
          @if ($alert->exists)
            Update alert
          @else
            Create alert
          @endif
        </div>

        <div class="card-body">

          @include('common.errors')

          @if ($alert->exists)
            <form
              class="form-horizontal"
              role="form"
              method="POST"
              action="{{ route('admin.alert.update', $alert) }}"
            >
              {{ method_field('PUT') }}
              <input type="hidden" name="id" value="{{ $alert->id }}">
          @else
            <form
              class="form-horizontal"
              role="form"
              method="POST"
              action="{{ route('admin.alert.store') }}"
            >
          @endif

            {!! csrf_field() !!}

            <div class="row">
              <div class="col-md-4">

                <div class="form-group">
                  <label class="control-label">Color</label>
                  <select
                    class="form-control"
                    name="class"
                  >
                    @foreach ($colors as $color => $class)
                      <option
                        value="{{ $class }}"
                        @if ($alert->class === $class || old('class') === $class)
                        selected="selected"
                        @endif
                      >
                        {{ ucfirst($color) }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label class="control-label">From</label>
                  <input
                    type="text"
                    class="form-control datepicker"
                    name="from_date"
                    placeholder="YYYY-MM-DD"
                    autocomplete="off"
                    value="{{ $alert->exists ? $alert->from_date->toDateString() :  old('from_date') }}"
                  >
                  <small class="form-text text-muted">
                    The alert will appear on this date.
                  </small>
                </div>

                <div class="form-group">
                  <label class="control-label">To</label>
                  <input
                    type="text"
                    class="form-control datepicker"
                    name="to_date"
                    placeholder="YYYY-MM-DD"
                    autocomplete="off"
                    value="{{ $alert->exists ? $alert->to_date->toDateString() :  old('to_date') }}"
                  >
                  <small class="form-text text-muted">
                    The alert will disappear after this date.
                  </small>
                </div>

                <div class="form-group">
                  <label class="control-label">Pages</label>
                  <input type="hidden" name="routes" value="">
                  @foreach ($routes as $routeName => $relativeUrl)
                    <div class="custom-control custom-checkbox">
                      <input
                        type="checkbox"
                        id="i-route-{{ $loop->index }}"
                        class="custom-control-input"
                        name="routes[]"
                        @if(
                             ($alert->exists && in_array($routeName, $alert->routes ?? []))
                          || (! $alert->exists && old('routes') && in_array($routeName, old('routes')))
                        )
                          checked="checked"
                        @endif
                      value="{{ $routeName }}"
                      >
                      <label class="custom-control-label" for="i-route-{{ $loop->index }}">
                        {{ $relativeUrl }}
                      </label>
                    </div>
                  @endforeach
                  <small class="form-text text-muted">
                    Select pages where the alert should be visible.
                    Leave empty to show on all available pages.
                  </small>
                </div>

                <div class="form-group">
                  <label class="control-label">Priority</label>
                  <input
                    type="number"
                    min="1"
                    max="9"
                    class="form-control"
                    name="priority"
                    placeholder="1-9"
                    autocomplete="off"
                    value="{{ $alert->exists ? $alert->priority : old('priority', 1) }}"
                  >
                  <small class="form-text text-muted">
                    Alerts will be ordered (ascending) by their priority value.
                  </small>
                </div>

              </div>

              <div class="col-md-8">
                <div class="form-group">
                  <label class="control-label">English text</label>
                  <textarea
                    class="form-control invisible"
                    rows="6"
                    name="content_en"
                  >{{ $alert->exists ? $alert->content_en : old('content_en') }}</textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Swedish text</label>
                  <textarea
                    class="form-control invisible"
                    rows="6"
                    name="content_sv"
                  >{{ $alert->exists ? $alert->content_sv : old('content_sv') }}</textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <a
                    href="{{ route('admin.alert.index') }}"
                    type="btn"
                    class="btn btn-secondary"
                  >
                    <i class="fa fa-btn fa-arrow-left"></i>
                    back
                  </a>
                  <button type="submit" class="btn btn-primary">
                  @if ($alert->exists)
                    <i class="fas fa-pencil-alt"></i>
                    Update
                  @else
                    <i class="fa fa-plus"></i>
                    Create
                  @endif
                  </button>
                </div>
              </div>

            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
