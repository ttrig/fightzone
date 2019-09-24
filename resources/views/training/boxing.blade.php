@extends('layouts.base', ['pageTitle' => __('app.activity.boxing')])
@section('content')
@include('training._header', [
  'slug'  => 'boxing',
  'title' => __('app.activity.boxing'),
  'extraButtons' => [
    [
      'route' => route('kids_boxing'),
      'text' => __('app.activity.kids_boxing'),
    ],
  ],
])

<div class="container">
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <h3>
        @lang('app.instructor')
      </h3>
      @include('common.instructor', [
        'name' => 'Luan Morina',
        'image' => '/images/instructors/boxing_luan.jpg',
      ])
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-6 text-center">
      <p>
        <img class="img-fluid rounded" data-src="/images/boxing/1.jpg">
      </p>
      <p>
        <img class="img-fluid rounded" data-src="/images/boxing/2.jpg">
      </p>
    </div>
    <div class="col-md-6 text-center">
      <p>
        <img class="img-fluid rounded" data-src="/images/boxing/3.jpg">
      </p>
      <p>
        <img class="img-fluid rounded" data-src="/images/boxing/4.jpg">
      </p>
    </div>
  </div>
</div>
@endsection
