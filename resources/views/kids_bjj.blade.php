@extends('layouts.base', ['pageTitle' => __('app.kids_bjj.title')])
@section('content')

@include('common.top_button')

<div class="container mt-3">

  <h2>
    <i class="fa fa-child"></i>
    @lang('app.kids_bjj.title')
  </h2>

  @include('common.alert')

  <button
    type="button"
    class="btn btn-dark d-md-none mb-3"
    data-toggle="modal"
    data-target="#schedule-modal"
  >
    <i class="fa fa-fw fa-calendar-alt"></i>
    @lang('app.kids_bjj.modal_schedule_show')
  </button>

  <div class="row mb-3">
    <div class="col-md-8 mb-3">
      {{-- info --}}
      {!! $texts['info'] !!}
      <a href="{{ route('bjj') }}" class="btn btn-dark" role="button">
        @lang('app.kids_bjj.more')
      </a>
      <a href="{{ route('schedule') }}" class="btn btn-dark" role="button">
        <i class="fa fa-calendar-alt"></i>
        @lang('app.schedule.title')
      </a>
    </div>
    <div class="col-md-4 mb-3">
      {{-- images --}}
      @foreach([1, 2, 3] as $i)
        <p>
          <img class="img-fluid rounded" data-src="/images/kids-bjj/{{ $i }}.jpg">
        </p>
      @endforeach
    </div>
  </div>

</div>

{{-- schedule modal --}}
<div class="modal fade" id="schedule-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fa fa-calendar-alt"></i>
          @lang('app.kids_bjj.modal_schedule_title')
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @forelse ($eventList as $dow => $schedules)
          <strong>
            @lang('app.schedule.day.' . $dow)
          </strong>
          <br>
          @foreach ($schedules as $schedule)
            {{ $schedule->from_time }} - {{ $schedule->to_time }}
            @if ($schedule->is_open_mat)
              &middot;
              Open mat
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          @lang('app.close')
        </button>
      </div>
    </div>
  </div>
</div>
@endsection
