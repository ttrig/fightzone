@extends('layouts.base', ['pageTitle' => __('app.facility.title')])
@section('content')
<div class="container mt-3">

  <h2>
    <i class="fa fa-home"></i>
    @lang('app.facility.title')
  </h2>

  <div class="row mb-3">
    <div class="col-md-8 mb-3">
      {!! $texts->info !!}
    </div>
    <div class="col-md-4 mb-3">
      <img class="img-fluid rounded" data-src="/images/facility/1.jpg">
    </div>
  </div>

</div>
@endsection
