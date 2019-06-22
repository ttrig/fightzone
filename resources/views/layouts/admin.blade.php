@extends('layouts.base', ['pageTitle' => 'Admin'])

@section('breadcrumbs')
  <div class="container mt-2">
    {{ Breadcrumbs::render() }}
  </div>
@endsection

@prepend('head')
  <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
  <input id="tinymce-content-css" type="hidden" value="{{ mix('css/admin-tinymce.css') }}">
@endprepend

@prepend('scripts')
  <script src="{{ mix('js/admin.js') }}"></script>
@endprepend
