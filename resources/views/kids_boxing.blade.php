@extends('layouts.base', ['pageTitle' => __('app.kids_boxing.title')])
@section('content')

@include('common.top_button')

<div class="container mt-3">

  <h2>
    <i class="fa fa-child"></i>
    @lang('app.kids_boxing.title')
  </h2>

  @include('common.alert')

  <div class="row mb-3">
    <div class="col-md-12 mb-3">
      {!! $texts['info'] !!}
      <a href="{{ route('boxing') }}" class="btn btn-dark" role="button">
        @lang('app.kids_boxing.more')
      </a>
      <a href="{{ route('schedule') }}" class="btn btn-dark" role="button">
        @lang('app.nav.schedule')
      </a>
    </div>
  </div>

</div>
@endsection
