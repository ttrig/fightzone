@extends('layouts.base', ['pageTitle' => __('app.activity.wrestling')])
@section('content')
@include('training._header', [
  'slug'  => 'wrestling',
  'title' => __('app.activity.wrestling'),
])
<div class="container">
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <h3>@lang('app.instructor')</h3>
      @include('common.instructor', [
        'name' => 'Mohamed Ali',
        'image' => '/images/instructors/wrestling_mohamed.jpg',
      ])
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-md-8 offset-md-2 text-center">
      <img class="img-fluid rounded" data-src="/images/wrestling/1.jpg">
    </div>
  </div>
</div>
@endsection
