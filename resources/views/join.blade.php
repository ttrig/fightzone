@extends('layouts.base', ['pageTitle' => __('app.join.title')])
@section('content')
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">
      @lang('app.join.title')
    </h1>
    <p class="lead text-muted">
      @lang('app.join.text')
    </p>
    <p class="my-2">
      <a href="{{ route('schedule') }}" class="btn btn-secondary">
        @lang('app.join.schedule')
      </a>
      <a href="{{ route('prices') }}" class="btn btn-secondary">
        @lang('app.join.prices')
      </a>
      <a
        href="https://register.sportadmin.se/pop/ko.asp?ID=562190877"
        target="_blank"
        class="btn btn-secondary"
      >
        @lang('app.home.register')
        <i class="fa fa-external-link-alt"></i>
      </a>
    </p>
  </div>
</section>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      {!! $texts->info !!}
    </div>
  </div>
</div>
@endsection
