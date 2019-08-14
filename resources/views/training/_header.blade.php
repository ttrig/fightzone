<section class="jumbotron text-center">
  <div class="container">

    <h1 class="jumbotron-heading">
      {{ $title }}
    </h1>

    <p class="lead text-muted">
      {!! $texts->info !!}
    </p>

    @if ($buttons ?? true)
      <p>
        <a href="{{ route('schedule') }}" class="btn btn-secondary my-2">
          @lang('app.join.schedule')
        </a>
        <a href="{{ route('join') }}" class="btn btn-secondary my-2">
          @lang('app.join.join')
        </a>
        @isset($extraButtons)
          @foreach($extraButtons as $btn)
            <a
              href="{{ $btn['route'] }}"
              class="btn btn-secondary my-2"
            >
              {{ $btn['text'] }}
            </a>
          @endforeach
        @endif
      </p>
    @endif

  </div>
</section>
