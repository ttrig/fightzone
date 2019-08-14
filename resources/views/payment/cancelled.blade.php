@extends('layouts.base', ['pageTitle' => __('app.payment.title')])
@section('content')
<div class="container mt-5 mb-3 text-center">

  <h3 class="mb-3">
    <i class="fa fa-fw fa-info-circle"></i>
    @lang('app.payment.cancelled.text')
  </h3>

  <a href="{{ route('payment.index') }}" class="btn btn-dark" role="button">
    <i class="fa fa-shopping-cart"></i>
    @lang('app.payment.checkout.back')
  </a>

</div>
@endsection
