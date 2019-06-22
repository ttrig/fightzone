@extends('layouts.base', ['pageTitle' => __('app.activity.kickboxing')])
@section('content')
@include('training._header', [
  'slug'  => 'kickboxing',
  'title' => __('app.activity.kickboxing'),
])
<div class="container">
  <div class="row">
    <div class="col-md-4 offset-md-2">
      <h3>
        @lang('app.instructors')
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 offset-md-2">
      @include('common.instructor', [
        'name' => 'Florin Mican',
        'image' => '/images/instructors/kick_florin.jpg',
      ])
    </div>
    <div class="col-md-4">
      @include('common.instructor', [
        'name' => 'Jonas Åmno',
        'image' => '/images/instructors/kick_jonas.jpg',
      ])
    </div>
  </div>

  <div class="row mb-4">
      <div class="col-md-6 text-center">
        @foreach ([1, 2] as $img_id)
          <p>
            <img class="img-fluid rounded" data-src="/images/kickboxing/{{ $img_id }}.jpg">
          </p>
        @endforeach
      </div>
      <div class="col-md-6 text-center">
        @foreach ([3, 4] as $img_id)
          <p>
            <img class="img-fluid rounded" data-src="/images/kickboxing/{{ $img_id }}.jpg">
          </p>
        @endforeach
      </div>
    </div>
</div>
@endsection
