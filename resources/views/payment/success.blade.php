@extends('layouts.base', ['pageTitle' => __('app.payment.index.title')])
@section('content')
<div class="container mt-5 mb-3 text-center">

  <h2 class="mb-3">
    <i class="fa fa-fw fa-check"></i>
    @lang('app.payment.success.text')!
  </h2>

  <a href="{{ route('schedule') }}" class="btn btn-secondary my-2">
    <i class="fa fa-calendar-alt"></i>
    @lang('app.join.schedule')
  </a>

  <a href="{{ route('join') }}" class="btn btn-secondary my-2">
    <i class="fa fa-info-circle"></i>
    @lang('app.join.join')
  </a>

</div>
@endsection
