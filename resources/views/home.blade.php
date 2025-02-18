@extends('layouts.base')
@push('scripts')
<script>
$(function() {
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/sv_SE/sdk.js#xfbml=1&version=v3.2&appId=1744698235581139';
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
});
</script>
@endpush
@section('content')
<div
  id="home-carousel"
  class="carousel slide"
  data-ride="carousel"
>
  <ol class="carousel-indicators">
    @foreach ($carousel as $c)
      <li
        data-target="#home-carousel"
        data-slide-to="{{ $loop->index }}"
        @if ($loop->first) class="active" @endif
      ></li>
    @endforeach
  </ol>
  <div class="carousel-inner">
    @foreach ($carousel as $carousel)
    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
      <img
        class="d-block w-100"
        data-src="{{ $carousel['image'] }}"
        @isset ($carousel['imageStyles']) style="{{ $carousel['imageStyles'] }}" @endif
      >
      @isset($carousel['title'])
        <div class="carousel-caption text-left">
          <h1>
            {{ $carousel['title'] }}
          </h1>
          <p>
            {!! $texts->{$carousel['text']} !!}
          </p>
          <p>
            <a class="btn btn-dark"
              href="{{ route($carousel['route']) }}"
              role="button"
            >
              @lang('app.home.more')
            </a>
          </p>
        </div>
      @endif
    </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#home-carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">@lang('app.home.previous')</span>
  </a>
  <a class="carousel-control-next" href="#home-carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">@lang('app.home.next')</span>
  </a>
</div>

<div class="container">

  @include('common.alert')

  <div class="row">
    <div class="col-md-7">
      <h2 class="heading">
        @lang('app.home.welcome')
        <br>
        <span class="text-muted">
          @lang('app.home.welcome2')
        </span>
      </h2>
      {!! $texts->fightzone !!}
      <p class="text-center">
        <a href="{{ route('history') }}" class="btn btn-dark mt-2" role="button">
          @lang('app.home.more_about_fightzone')
        </a>
        <a
          href="https://entry.sportadmin.se/groupsOverview?uid=SyMrod"
          class="btn btn-info mt-2"
          role="button"
          target="_blank"
        >
          @lang('app.home.register')
          <i class="fa fa-external-link-alt"></i>
        </a>
      </p>
    </div>
    <div class="col-md-5 d-none d-md-block">
      <img
        class="img-fluid mx-auto lazy"
        data-src="/images/logo_gray.png"
        alt="Fightzone"
      >
    </div>
  </div>

  <hr>

  <div class="row">
    <div class="col-md-7">
      <h2>
        @lang('app.home.schedule.title')
      </h2>
      @if ($today->count())
        <div class="table-responsive">
          <table class="table table-striped w-100 text-center">
          @foreach ($today as $schedule)
            @if ($schedule->has_started)
              <tr class="text-muted">
            @else
              <tr>
            @endif
              <td>
                {{ $schedule->from_time }} - {{ $schedule->to_time }}
              </td>
              <td>
                {{ $schedule->activity->name }} {{ $schedule->content }}
              </td>
            </tr>
          @endforeach
          </table>
        </div>
      @else
        <div class="alert alert-warning">
          @lang('app.home.schedule.no_training')
        </div>
      @endif
      <p class="text-center">
        <a href="{{ route('schedule') }}" class="btn btn-dark" role="button">
          @lang('app.home.schedule.link')
        </a>
      </p>
    </div>
    <div class="col-md-5 text-center mb-3">
      <div
        class="fb-page"
        data-href="https://www.facebook.com/FightzoneMalmo/"
        data-small-header="false"
        data-tabs=""
        data-adapt-container-width="true"
        data-hide-cover="false"
        data-show-facepile="true"
      >
        <blockquote
          cite="https://www.facebook.com/FightzoneMalmo/"
          class="fb-xfbml-parse-ignore"
        >
          <a href="https://www.facebook.com/FightzoneMalmo/">Fightzone Malmö</a>
        </blockquote>
      </div>
    </div>
  </div>
</div>
@endsection
