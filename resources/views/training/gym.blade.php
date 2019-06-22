@extends('layouts.base', ['pageTitle' => __('app.activity.gym')])
@section('content')
@include('training._header', [
  'slug' => 'gym',
  'title' => __('app.activity.gym'),
  'buttons' => false,
])

<div class="container">
  <div class="row mb-4">
    <div class="col-md-4 offset-md-2">
      <img class="img-fluid img-thumbnail" data-src="/images/gym/3.jpg">
    </div>
    <div class="col-md-4">
      <img class="img-fluid img-thumbnail" data-src="/images/gym/2.jpg">
    </div>
  </div>
</div>
@endsection
