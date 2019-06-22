@extends('layouts.base', ['pageTitle' => __('app.schedule.title')])
@section('content')
<script id="calendar-events" type="text/template">{!! json_encode($calendarEvents) !!}</script>

<div class="container mt-3">
  <h2>
    <i class="fa fa-calendar-alt"></i>
    @lang('app.schedule.title')
  </h2>

  @include('common.alert')

  @isset($texts->info)
    <div class="row d-none d-md-block mb-3">
      {!! $texts->info !!}
    </div>
  @endif

  {{-- calendar --}}
  <div id="calendar-container" class="d-none d-md-block mb-3">
    <div id="calendar-spinner" class="text-center">
      <i class="fa fa-lg fa-spinner fa-spin"></i>
    </div>

    <div id="calendar-filter" class="row d-none">
      <div class="col-md-4">
        <select class="custom-select custom-select mb-3">
          <option selected value="">@lang('app.schedule.all_activities')</option>
          @foreach ($filterOptions as $activitySlug => $activityName)
            <option value="{{ $activitySlug }}">{{ $activityName }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row">
      <div id="calendar"></div>
    </div>
  </div>

  <div class="row d-md-none">
    <div class="col-md-12">

      {{-- todays schedule --}}
      <div class="card bg-light mb-4">
        <h5 class="card-header">
          @lang('app.home.schedule.title')
        </h5>
        <div class="table-responsive">
        @if ($today->count())
          <table class="table table-striped w-100 mb-0 text-center">
          @foreach ($today as $schedule)
            <tr @if ($schedule->has_started) class="text-muted" @endif>
              <td>
                {{ $schedule->from_time }} - {{ $schedule->to_time }}
              </td>
              <td>
                <strong>
                  {{ $schedule->activity->name }}
                </strong>
                {{ $schedule->content }}
              </td>
            </tr>
          @endforeach
          </table>
        @else
          <div class="alert alert-warning">
            <i class="fas fa-info-circle"></i>
            @lang('app.home.schedule.no_training')
          </div>
        @endif
        </div>
      </div>

    {{-- list events --}}
    @foreach ($listItems as $listItem)
      <div class="card bg-light mb-4">
        <h5 class="card-header">
          <a href="{{ route($listItem['route']) }}" id="{{ $listItem['slug'] }}">
            {{ $listItem['title'] }}
          </a>
        </h5>
        <div class="card-body">
          <p class="card-text">
          @forelse ($listItem['classes'] as $dow => $schedules)
            <strong>
              @lang('app.schedule.day.' . $dow)
            </strong>
            <br>
            @foreach ($schedules as $schedule)
              {{ $schedule->from_time }} - {{ $schedule->to_time }}
              @if ($schedule->is_open_mat)
                &middot;
                Open mat <i class="fas fa-question-circle"></i>
              @elseif ($schedule->content)
                &middot;
                {{ $schedule->content }}
              @endif
              @if (!$loop->last)
                <br>
              @elseif (!$loop->parent->last)
                <br>
              @endif
            @endforeach
          @empty
            @lang('app.schedule.no_classes')
          @endforelse
          </p>
        </div>
      </div>
    @endforeach
    </div>
  </div>
</div>

@include('common.top_button')

@push('head')
  <link href="{{ mix('css/schedule.css') }}" rel="stylesheet">
@endpush

@push('scripts')
  <script src="{{ mix('js/schedule.js') }}"></script>
@endpush

@endsection
