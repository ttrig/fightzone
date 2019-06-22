<h3 class="mb-3">
  <i class="fas fa-fw fa-{{ $icon ?? help }}"></i>
  {{ $title }}
  @isset($button)
  <a
    href="{{ route($button['route']) }}"
    class="btn btn-{{ $button['class'] ?? 'success' }} float-right"
  >
    <i class="fa fa-btn fa-{{ $button['icon'] }}"></i>
    {{ $button['title'] }}
  </a>
  @endif
</h3>
