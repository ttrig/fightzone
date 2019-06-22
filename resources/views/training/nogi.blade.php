@extends('layouts.base', ['pageTitle' => __('app.activity.nogi')])
@section('content')
@include('training._header', [
  'slug'  => 'nogi',
  'title' => __('app.activity.nogi'),
])

<div class="container">
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <h3>
        @lang('app.instructor')
      </h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 offset-md-4">
      @include('common.instructor', [
        'name' => 'Felipe Machado',
        'image' => '/images/instructors/nogi_machado.jpg',
      ])
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-md-8 offset-md-2 text-center">
      <img class="img-fluid img-thumbnail" data-src="/images/nogi/1.jpg">
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-md-8 offset-md-2 text-center">
      <img class="img-fluid img-thumbnail" data-src="/images/nogi/2.jpg">
    </div>
  </div>
</div>
@endsection
