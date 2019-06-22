@extends('layouts.base', ['pageTitle' => __('app.about.title')])
@section('content')
@include('common.top_button')
<div class="container mt-3">
  <h2>
    @lang('app.about.title')
  </h2>

  <div class="row mb-3">
    <div class="col-md-9 mb-3">
      {!! $texts->info !!}
    </div>
    <div class="col-md-3 mb-3">
      <p>
        <img class="img-fluid rounded" data-src="/images/about/viera.jpg">
      </p>
      <p>
        <img class="img-fluid rounded" data-src="/images/about/belt.jpg">
      </p>
    </div>
  </div>

  <h4>
    <i class="fa fa-home"></i>
    @lang('app.about.facility')
  </h4>

  <div class="row mb-3">
    <div class="col-md-9 mb-3">
      {!! $texts->facility !!}
    </div>
    <div class="col-md-3 mb-3">
      <img class="img-fluid rounded" data-src="/images/about/about.jpg">
    </div>
  </div>
</div>
@endsection
