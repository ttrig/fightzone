@extends('layouts.admin')
@section('content')
<div class="container mt-3">
  <div class="row">
    <div class="col-md-12">

      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-fw fa-shopping-cart"></i>
          @if ($article->exists)
            Update article
          @else
            Create article
          @endif
        </div>

        <div class="card-body">

          @include('common.errors')

          @if ($article->exists)
            <form
              class="form-horizontal"
              role="form"
              method="POST"
              action="{{ route('admin.payment_article.update', $article) }}"
            >
              {{ method_field('PUT') }}
              <input type="hidden" name="id" value="{{ $article->id }}">
          @else
            <form
              class="form-horizontal"
              role="form"
              method="POST"
              action="{{ route('admin.payment_article.store') }}"
            >
          @endif

            {!! csrf_field() !!}

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">English name</label>
                  <input
                    type="text"
                    class="form-control"
                    name="name_en"
                    autocomplete="off"
                    value="{{ $article->exists ? $article->name_en : old('name_en') }}"
                  >
                </div>
                <div class="form-group">
                  <label class="control-label">Swedish name</label>
                  <input
                    type="text"
                    class="form-control"
                    name="name_sv"
                    autocomplete="off"
                    value="{{ $article->exists ? $article->name_sv : old('name_sv') }}"
                  >
                </div>
                <div class="form-group">
                  <label class="control-label">Price (SEK)</label>
                  <input
                    type="number"
                    class="form-control"
                    name="price"
                    autocomplete="off"
                    value="{{ $article->exists ? $article->price : old('price') }}"
                  >
                </div>
                <div class="form-group">
                  <label class="control-label">Billmate article number</label>
                  <input
                    type="number"
                    class="form-control"
                    name="number"
                    autocomplete="off"
                    value="{{ $article->exists ? $article->number : old('number') }}"
                  >
                </div>
                <div class="form-group">
                  <input type="hidden" name="active" value="0">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      class="custom-control-input"
                      name="active"
                      value="1"
                      id="i-active"
                      @if (!$article->exists || $article->active || old('active'))
                        checked="checked"
                      @endif
                    >
                    <label class="custom-control-label" for="i-active">
                      Active?
                    </label>
                  </div>
                </div>
              </div>

              <div class="col-md-8">
                <div class="form-group">
                  <label class="control-label">English description</label>
                  <textarea
                    class="form-control invisible"
                    rows="6"
                    name="content_en"
                  >{{ $article->exists ? $article->content_en : old('content_en') }}</textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Swedish description</label>
                  <textarea
                    class="form-control invisible"
                    rows="6"
                    name="content_sv"
                  >{{ $article->exists ? $article->content_sv : old('content_sv') }}</textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <a
                    href="{{ route('admin.payment_article.index') }}"
                    type="btn"
                    class="btn btn-secondary"
                  >
                    <i class="fa fa-btn fa-arrow-left"></i>
                    back
                  </a>
                  <button type="submit" class="btn btn-primary">
                  @if ($article->exists)
                    <i class="fas fa-pencil-alt"></i>
                    Update
                  @else
                    <i class="fa fa-plus"></i>
                    Create
                  @endif
                  </button>
                </div>
              </div>

            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="{{ mix('js/admin-text-edit.js') }}"></script>
@endpush
