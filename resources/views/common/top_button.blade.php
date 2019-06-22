<button id="top-button" class="btn btn-primary" title="Go to top">
  Top
  <i class="fas fa-arrow-up"></i>
</button>

@push('scripts')
<script>
$(function() {
  {{-- show "top-button" when scrolling down --}}
  $( window ).scroll(function() {
    var $el = $('#top-button');
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      $el.fadeIn();
    } else {
      $el.fadeOut();
    }
  });

  {{-- smooth scroll to top of page when clicking on "top-button" --}}
  $('#top-button').on('click', function (e) {
    e.preventDefault();
    $('html, body').animate({
      scrollTop: 0
    }, 300, 'linear');
  });
});
</script>
@endpush
