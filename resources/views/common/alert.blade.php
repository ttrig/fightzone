@if ($alerts && is_object($alerts))
  @foreach ($alerts as $alert)
    <div class="alert alert-{{ $alert->class }}">
      {!! $alert->content !!}
    </div>
    {{--
    @auth
      <i>
        <a class="" href="{{ route('admin.alert.edit', $alert) }}">
          edit this alert
        </a>
      </i>
    @endauth
    --}}
  @endforeach
@endif
