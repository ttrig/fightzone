<div class="card mb-4">
  <img class="card-img-top d-block w-100" data-src="{{ $image }}">
  <div class="card-body">
    <p class="card-text">
      <strong>{{ $name }}</strong>
      @if (isset($description))
        -
        {{ $description }}
      @endif
    </p>
  </div>
</div>
