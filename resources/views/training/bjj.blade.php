<?php
$instructors = [
  ['Stephan Seidl', 'app.3rd', 'bjj_stephan.jpg'],
  ['Felipe Machado', 'app.1st', 'bjj_machado.jpg'],
];
?>
@extends('layouts.base', ['pageTitle' => __('app.activity.bjj')])
@section('content')
@include('training._header', [
  'slug'  => 'bjj',
  'title' => __('app.activity.bjj'),
  'extraButtons' => [
    [
      'route' => route('kids_bjj'),
      'text' => __('app.kids_bjj.title'),
    ],
  ],
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
    @foreach ($instructors as $i)
      <div class="col-md-4 {{ $loop->first ? 'offset-md-2' : '' }}">
        @include('common.instructor', [
          'name' => $i[0],
          'description' => trans_choice('app.black_belt', $i[1], ['degree' => __($i[1])]),
          'image' => '/images/instructors/' . $i[2],
        ])
      </div>
    @endforeach
  </div>

  <div class="row mb-4">
    <div class="col-md-6 text-center">
      @foreach ([4, 6, 3] as $img_id)
        <p>
          <img class="img-fluid rounded" data-src="/images/bjj/{{ $img_id }}.jpg">
        </p>
      @endforeach
    </div>
    <div class="col-md-6 text-center">
      @foreach ([1, 5, 2] as $img_id)
        <p>
          <img class="img-fluid rounded" data-src="/images/bjj/{{ $img_id }}.jpg">
        </p>
      @endforeach
    </div>
  </div>
</div>
@endsection
