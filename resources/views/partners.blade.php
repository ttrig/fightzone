@extends('layouts.base', ['pageTitle' => __('app.partners.title')])
@section('content')
<div class="container mt-3">

  <h2>
    <i class="fa fa-users"></i>
    @lang('app.partners.title')
  </h2>

  <div class="row my-3 text-center">
    <div class="col-md-2 offset-md-1 partner">
      <a target="_blank" href="https://träningsmat.se/">
        <img class="img-fluid rounded" data-src="/images/partners/traningsmatse.png">
      </a>
      <br>
      <a class="text-secondary" target="_blank" href="https://träningsmat.se/">
        Träningsmat
      </a>
    </div>

    <div class="col-md-2 partner">
      <a target="_blank" href="https://checkmateurope.com/">
        <img class="img-fluid rounded" data-src="/images/partners/checkmat.png">
      </a>
      <br>
      <a class="text-secondary" target="_blank" href="https://checkmateurope.com/">
        Checkmat Europe
      </a>
    </div>

    <div class="col-md-2 partner">
      <a target="_blank" href="https://www.fightzone-berlin.de/">
        <img class="img-fluid rounded" data-src="/images/partners/fightzone.png">
      </a>
      <br>
      <a class="text-secondary" target="_blank" href="https://www.fightzone-berlin.de/">
        Fightzone Berlin
      </a>
    </div>

    <div class="col-md-2 partner">
      <a target="_blank" href="https://www.fightzonelondon.co.uk/">
        <img class="img-fluid rounded" data-src="/images/partners/fightzone.png">
      </a>
      <br>
      <a class="text-secondary" target="_blank" href="https://www.fightzonelondon.co.uk/">
        Fightzone London
      </a>
    </div>

    <div class="col-md-2 partner">
      <a target="_blank" href="http://www.fsfsv.de">
        <img class="img-fluid rounded" data-src="/images/partners/fsfsv.png">
      </a>
      <br>
      <a class="text-secondary" target="_blank" href="http://www.fsfsv.de">
        FSFSV Remagen
      </a>
    </div>
  </div>

</div>

@include('common.top_button')

@push('head')
  <link href="{{ mix('css/partners.css') }}" rel="stylesheet">
@endpush

@endsection
