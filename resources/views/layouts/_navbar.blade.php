<?php

$lang_link = app()->isLocale('sv') ? 'en' : 'sv';

?><header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="/images/logo_text.png" alt="Fightzone">
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarCollapse"
        aria-controls="navbarCollapse"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">
              @lang('app.nav.home')
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('schedule') }}">
              @lang('app.nav.schedule')
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('prices') }}">
              @lang('app.nav.prices')
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('join') }}">
              @lang('app.nav.join')
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle"
              href="#"
              id="training-dropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              @lang('app.nav.training')
            </a>
            <div class="dropdown-menu" aria-labelledby="training-dropdown">
              <a class="dropdown-item" href="{{ route('bjj') }}">
                @lang('app.activity.bjj')
              </a>
              <a class="dropdown-item" href="{{ route('kids_bjj') }}">
                @lang('app.activity.kids_bjj')
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('boxing') }}">
                @lang('app.activity.boxing')
              </a>
              <a class="dropdown-item" href="{{ route('youth_boxing') }}">
                @lang('app.activity.youth_boxing')
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('kickboxing') }}">
                @lang('app.activity.kickboxing')
              </a>
              <a class="dropdown-item" href="{{ route('youth_kickboxing') }}">
                @lang('app.activity.youth_kickboxing')
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('wrestling') }}">
                @lang('app.activity.wrestling')
              </a>
              <a class="dropdown-item" href="{{ route('nogi') }}">
                @lang('app.activity.nogi')
              </a>
              <a class="dropdown-item" href="{{ route('sac') }}">
                @lang('app.activity.sac')
              </a>
              <a class="dropdown-item" href="{{ route('gym') }}">
                @lang('app.activity.gym')
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle"
              href="#"
              id="about-dropdown"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              @lang('app.nav.about')
            </a>
            <div class="dropdown-menu" aria-labelledby="about-dropdown">
              <a class="dropdown-item" href="{{ route('history') }}">
                @lang('app.nav.history')
              </a>
              <a class="dropdown-item" href="{{ route('facility') }}">
                @lang('app.nav.facility')
              </a>
              <a class="dropdown-item" href="{{ route('partners') }}">
                @lang('app.nav.partners')
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">
              @lang('app.nav.contact')
            </a>
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              href="{{ route('lang', $lang_link) }}"
              title="{{ __('app.nav.lang') }}"
            >
              <img src="/images/lang_{{ $lang_link }}.png">
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="https://www.facebook.com/FightzoneMalmo/">
              <i class="fab fa-facebook"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="https://www.instagram.com/fightzone_malmo/">
              <i class="fab fa-instagram"></i>
            </a>
          </li>
        </ul>
        @auth
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link text-warning" href="{{ route('admin.index') }}">
                <i class="fas fa-key"></i>
                Admin
              </a>
            </li>
          </ul>
        @endauth
      </div>
    </div>
  </nav>
</header>
