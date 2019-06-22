@extends('layouts.base', ['pageTitle' => __('app.activity.sac')])
@section('content')
@include('training._header', [
  'slug'  => 'sac',
  'title' => __('app.activity.sac'),
])

<div class="container">
  <div class="row mb-4">
    <div class="col-md-6 text-center">
      <p>
        <img class="img-fluid rounded" data-src="/images/sac/1.jpg">
      </p>
      <p>
        <img class="img-fluid rounded" data-src="/images/sac/2.jpg">
      </p>
      <p>
        <img class="img-fluid rounded" data-src="/images/sac/4.jpg">
      </p>
    </div>
    <div class="col-md-6 text-center">
      <p>
        <img class="img-fluid rounded" data-src="/images/sac/3.jpg">
      </p>
      <p>
        <img class="img-fluid rounded" data-src="/images/sac/5.jpg">
      </p>
      <p>
        <img class="img-fluid rounded" data-src="/images/sac/6.jpg">
      </p>
    </div>
  </div>
</div>
@endsection
