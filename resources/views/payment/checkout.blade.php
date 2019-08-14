@extends('layouts.base', ['pageTitle' => __('app.payment.checkout.title')])
@section('content')
<section class="container mt-3 mb-3">

  <h2 class="mb-3">
    <i class="fa fa-fw fa-shopping-cart"></i>
    @lang('app.payment.checkout.title')
  </h2>

  <div class="row">

    <div class="col-md-6">
      <div class="bg-white p-3">
        <h4>
          @lang('app.payment.checkout.your_order')
        </h4>

        <small class="text-muted">
          @lang('app.payment.checkout.name')
        </small>
        <h5>
          {{ $article->name }}
        </h5>

        <small class="text-muted">
          @lang('app.payment.checkout.price')
        </small>
        <h5>
          {{ $article->formatted_price }} kr
        </h5>

        <small class="text-muted">
          @lang('app.payment.checkout.description')
        </small>
        <h5>
          {!! $article->content !!}
        </h5>

        <a href="{{ route('payment.index') }}" class="btn btn-dark mt-1">
          <i class="fa fa-fw fa-arrow-left"></i>
          @lang('app.payment.checkout.back')
        </a>
      </div>
    </div>

    <div class="col-md-6">
      @isset($checkout)
        <div id="checkoutdiv">
          {!! $checkout->iframe() !!}
        </div>
      @else
        <div class="alert alert-info">
          @lang('app.payment.checkout.not_loaded')
        </div>
      @endif
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
    window.addEventListener('message', function (event) {
        if (event.origin !== 'https://checkout.billmate.se') {
            return
        }

        try {
            var json = JSON.parse(event.data)
        } catch (e) {
            return
        }

        switch (json.event) {
          case 'content_height':
            $('#checkout').height(json.data + 100)
            break
        }
    })
</script>
@endpush
