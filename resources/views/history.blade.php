@extends('layouts.base', ['pageTitle' => __('app.history.title')])
@section('content')
<div class="container mt-3">

  <h2>
    @lang('app.history.title')
  </h2>

  <div class="row mb-3">
    <div class="col-md-9 mb-3">
      {!! $texts->info !!}
    </div>
    <div class="col-md-3 mb-3">
      <p>
        <img class="img-fluid rounded" data-src="/images/history/viera.jpg">
      </p>
      <p>
        <img class="img-fluid rounded" data-src="/images/history/belt.jpg">
      </p>
    </div>
  </div>

</div>
@endsection
