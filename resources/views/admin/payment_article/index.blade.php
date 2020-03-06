@extends('layouts.admin')
@section('content')
<div class="container mt-3">
  <div class="row">
    <div class="col-md-12">

      @include('admin.common.header', [
        'title' => 'Payment articles',
        'icon' => 'shopping-cart',
        'button' => [
          'title' => 'Add',
          'route' => 'admin.payment_article.create',
          'icon' => 'plus',
        ],
      ])

      @include('common.success')

      @if ($articles->count())
        <div class="table-responsive">
          <table class="table table-striped">
            <thead class="thead-light">
              <tr>
                <th>Active?</th>
                <th>Number</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($articles as $article)
              <tr>
                <td>
                  <h5>
                    @if ($article->active)
                      <span class="badge badge-success">
                        Yes
                      </span>
                    @else
                      <span class="badge badge-warning">
                        No
                      </span>
                    @endif
                  </h5>
                </td>
                <td>
                  {{ $article->number }}
                </td>
                <td>
                  {{ $article->name }}
                </td>
                <td>
                  {{ $article->price }}
                </td>
                <td>
                  {{ Str::limit(strip_tags($article->content), 50) }}
                </td>
                <td align="right" style="white-space:nowrap;">
                  <a href="{{ route('admin.payment_article.edit', $article) }}"
                    class="btn btn-sm btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <a href="#"
                    class="btn btn-sm btn-danger destroy-article"
                    data-article-id="{{ $article->id }}">
                    <i class="far fa-trash-alt"></i>
                  </a>
                  <form id="destroy-article-{{ $article->id }}"
                      action="{{ route('admin.payment_article.destroy', $article) }}"
                      method="POST"
                      style="display: none;">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="alert alert-info">
          <i class="fas fa-info-circle"></i>
          No articles found.
        </div>
      @endif

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
  $('.destroy-article').click(function() {
    event.preventDefault()

    if (!confirm('Do you really want to delete this article?')) {
      return
    }

    var id = $( this ).data('article-id')
    $('#destroy-article-' + id).submit()
  })
})
</script>
@endpush
