<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title>{{ trim(($pageTitle ?? '') . ' | Fightzone', ' | ') }}</title>

    @include('layouts._analytics')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="theme-color" content="#343a40" />
    <meta name="msapplication-navbutton-color" content="#343a40">
    <meta name="apple-mobile-web-app-status-bar-style" content="#343a40">

    <meta property="og:url" content="https://fightzone.se" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Fightzone" />
    <meta property="og:description" content="Fightzone is an academy with very sociable members who all promote a mutual respect environment, regardless of your background, age and gender. Our aim is for every person to become an integral part of the academy family as we all help each other achieve our personal goals through our training." />
    <meta property="og:image" content="{{ config('app.url') }}/images/logo_gray.png" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon-precomposed" href="/favicon-152.png">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @stack('head')
  </head>
  <body>
    <div class="container-fluid d-flex flex-column pr-0 pl-0 h-100">
      @include('layouts._navbar')
      <main class="flex-grow-1">
        @hasSection('breadcrumbs')
          @yield('breadcrumbs')
        @endif
        @yield('content')
      </main>
      <footer class="d-flex flex-column flex-grow-0 w-100">
        @include('layouts._footer_sponsors')
        @include('layouts._footer_info')
      </footer>
    </div>

    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
  </body>
</html>
