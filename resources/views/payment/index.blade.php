@extends('layouts.base', ['pageTitle' => __('app.payment.index.title')])
@section('content')
<div class="container mt-3 mb-3">
  <h2 class="mb-3">
    <i class="fa fa-fw fa-shopping-cart"></i>
    @lang('app.payment.index.title')
  </h2>

  @include('common.errors')

  <div class="mb-3">
    {!! $texts->info !!}
  </div>

  <a href="{{ route('prices') }}" class="btn btn-dark mb-3">
    <i class="fa fa-fw fa-arrow-left"></i>
    @lang('app.back')
  </a>

  <div class="row">
    <div class="col-md-12">
      @if ($articles->isEmpty())
        <div class="alert alert-info">
          @lang('app.payment.index.no_articles')
        </div>
      @else
        <table class="table">
          <thead>
            <tr>
              <th scope="col">@lang('app.payment.index.name')</th>
              <th scope="col">@lang('app.payment.index.price')</th>
              <th scope="col">@lang('app.payment.index.from_price')</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($articles as $article)
              <tr>
                <th scope="row">
                  <a href="{{ route('payment.checkout', $article) }}">
                    {{ $article->name }}
                  </a>
                </th>
                <td>{{ $article->price }} kr</td>
                <td>
                  <span class="monthly-cost" data-article-number="{{ $article->number }}">
                    <i class="fa fa-spin fa-spinner"></i>
                  </span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>
</div>

@push('scripts')
<script>
  $(function() {
    $.getJSON('/payment/monthly-costs', function (data) {
      $.each(data, function (articleNumber, monthlyCost) {
        $('.monthly-cost[data-article-number=' + articleNumber + ']').html(monthlyCost + ' kr')
      })
    })
    .always(function() {
      $('.monthly-cost .fa').remove()
    })
  })
</script>
@endpush

@endsection
