<?php

$asterisk = '<span class="text-primary">*</span>';

# SEK helper
$price = function(string $discipline, string $category) use ($prices): string {
  $sek = $prices->firstWhere('activity.slug', $discipline)->$category ?? null;
  return is_numeric($sek) ? $sek : '';
};
?>
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
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th>@lang('app.prices.adults') (18+)</th>
            <th>1 @lang('app.prices.year')</th>
            <th>@choice('app.prices.months', 6)</th>
            <th>@choice('app.prices.months', 1)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>@lang('app.prices.bjj') {!! $asterisk !!}</th>
            <td>{{ $price('bjj', 'adult_1_y') }}</td>
            <td>{{ $price('bjj', 'adult_6_m') }}</td>
            <td>{{ $price('bjj', 'adult_1_m') }}</td>
          </tr>
          <tr>
            <th>@lang('app.activity.boxing')</th>
            <td>{{ $price('boxing', 'adult_1_y') }}</td>
            <td>{{ $price('boxing', 'adult_6_m') }}</td>
            <td>{{ $price('boxing', 'adult_1_m') }}</td>
          </tr>
          <tr>
            <th>@lang('app.activity.kickboxing')</th>
            <td>{{ $price('kickboxing', 'adult_1_y') }}</td>
            <td>{{ $price('kickboxing', 'adult_6_m') }}</td>
            <td>{{ $price('kickboxing', 'adult_1_m') }}</td>
          </tr>
          <tr>
            <th>@lang('app.activity.wrestling')</th>
            <td colspan="4">Combo {!! $asterisk !!}</td>
          </tr>
          <tr>
            <th>@lang('app.activity.nogi')</th>
            <td colspan="4">Combo {!! $asterisk !!}</td>
          </tr>
        </tbody>
      </table>

      <table class="table">
        <thead class="thead-light">
          <tr>
            <th>@lang('app.prices.youths') (18-)</th>
            <th>1 @lang('app.prices.year')</th>
            <th>@choice('app.prices.months', 6)</th>
            <th>@choice('app.prices.months', 1)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>@lang('app.prices.bjj') {!! $asterisk !!}</th>
            <td>{{ $price('bjj', 'youth_1_y') }}</td>
            <td>{{ $price('bjj', 'youth_6_m') }}</td>
            <td>{{ $price('bjj', 'youth_1_m') }}</td>
          </tr>
          <tr>
            <th>@lang('app.activity.boxing')</th>
            <td>{{ $price('boxing', 'youth_1_y') }}</td>
            <td>{{ $price('boxing', 'youth_6_m') }}</td>
            <td>{{ $price('boxing', 'youth_1_m') }}</td>
          </tr>
          <tr>
            <th>@lang('app.activity.kickboxing')</th>
            <td>{{ $price('kickboxing', 'youth_1_y') }}</td>
            <td>{{ $price('kickboxing', 'youth_6_m') }}</td>
            <td>{{ $price('kickboxing', 'youth_1_m') }}</td>
          </tr>
          <tr>
            <th>@lang('app.activity.wrestling')</th>
            <td colspan="4">Combo {!! $asterisk !!}</td>
          </tr>
          <tr>
            <th>@lang('app.activity.nogi')</th>
            <td colspan="4">Combo {!! $asterisk !!}</td>
          </tr>
        </tbody>
      </table>

      <div class="alert alert-info">
        <i class="fas fa-question-circle"></i>
        <strong>*</strong>
        {!! $texts->combo !!}
      </div>

    </div>
  </div>
</div>
@endsection
