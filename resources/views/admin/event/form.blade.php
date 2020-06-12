@extends('layouts.admin')
@section('content')
<div class="container mt-3">
  <div class="row">
    <div class="col-md-8 offset-md-2">

      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-calendar-alt"></i>
          @if ($event->exists)
            Edit scheduled class
          @else
            Create scheduled class
          @endif
        </div>

        <div class="card-body">

          @include('common.errors')

          @if ($event->exists)
            <form
              class="form-horizontal"
              role="form"
              method="POST"
              action="{{ route('admin.event.update', $event) }}"
            >
              {{ method_field('PUT') }}
              <input type="hidden" name="id" value="{{ $event->id }}">
          @else
            <form
              class="form-horizontal"
              role="form"
              method="POST"
              action="{{ route('admin.event.store') }}"
            >
          @endif

            {!! csrf_field() !!}

            <div class="row">
              <div class="col-md-6">
                @if (! $event->exists)
                <div class="form-group">
                  <label class="control-label">Activity</label>
                  <select class="form-control" name="activity_id">
                    @foreach ($activities as $activity)
                      <option value="{{ $activity->id }}">
                        {{ $activity->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
                @endif

                <div class="form-group">
                  <label class="control-label">English text</label>
                  <input
                    class="form-control"
                    type="text"
                    name="content_en"
                    value="{{ $event->exists ? $event->content_en :  old('content_en') }}"
                  >
                </div>
                <div class="form-group">
                  <label class="control-label">Swedish text</label>
                  <input
                    class="form-control"
                    type="text"
                    name="content_sv"
                    value="{{ $event->exists ? $event->content_sv :  old('content_sv') }}"
                  >
                </div>
                <div class="form-check">
                  <input type="hidden" name="is_enabled" value="0">
                  <input
                    type="checkbox"
                    class="form-check-input"
                    name="is_enabled"
                    id="i-isEnabled"
                    {{ data_get($event, 'is_enabled') ? 'checked="checked"' : ''}}
                    value="1"
                  >
                  <label class="form-check-label" for="i-isEnabled">
                    Enabled?
                  </label>
                </div>
                <div class="form-check">
                  <input type="hidden" name="is_open_mat" value="0">
                  <input
                    type="checkbox"
                    class="form-check-input"
                    name="is_open_mat"
                    id="i-isOpenMat"
                    {{ data_get($event, 'is_open_mat') ? 'checked="checked"' : ''}}
                    value="1"
                  >
                  <label class="form-check-label" for="i-isOpenMat">
                    Open mat?
                  </label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Day</label>
                  <select class="form-control" name="dow">
                  @for ($i = 1; $i <= 7; ++$i)
                    <option
                      value="{{ $i }}"
                      @if(old('dow') == $i || ($event->exists && $event->dow == $i))
                      selected="selected"
                      @endif
                    >
                      {{ __('app.schedule.day.' . $i) }}
                    </option>
                  @endfor
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">From</label>
                  <input
                    type="text"
                    class="form-control datepicker"
                    name="from_time"
                    placeholder="HH:MM"
                    autocomplete="off"
                    maxlength="5"
                    value="{{ $event->exists ? $event->from_time : old('from_time') }}"
                  >
                </div>
                <div class="form-group">
                  <label class="control-label">To</label>
                  <input
                    type="text"
                    class="form-control datepicker"
                    name="to_time"
                    placeholder="HH:MM"
                    autocomplete="off"
                    maxlength="5"
                    value="{{ $event->exists ? $event->to_time : old('to_time') }}"
                  >
                </div>
              </div>

              <div class="col-md-12 mt-3">
                <div class="form-group">
                  <a
                    href="{{ route('admin.event.index') }}"
                    type="btn"
                    class="btn btn-secondary"
                  >
                    <i class="fa fa-btn fa-arrow-left"></i>
                    back
                  </a>
                  <button type="submit" class="btn btn-primary">
                  @if ($event->exists)
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
