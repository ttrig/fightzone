@extends('layouts.base', ['pageTitle' => __('app.prices.title')])
@section('content')
<div class="container mt-3">
  <h2>
    <i class="far fa-fw fa-money-bill-alt"></i>
    @lang('app.prices.title')
  </h2>

  @include('common.alert')

  <div class="row mb-3">
    <div class="col-md-12 mb-3">
      {!! $texts->info !!}
    </div>
  </div>

  <a href="{{ route('payment.index') }}" class="btn btn-dark mb-3">
    <i class="fa fa-fw fa-shopping-cart"></i>
    @lang('app.prices.payment_button')
  </a>

  <div class="row">
    <div class="col-md-12">
      {!! $texts->tables !!}
    </div>
  </div>
</div>
@endsection
