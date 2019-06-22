@extends('layouts.admin')

@section('content')
<div id="text-edit-container" class="container mt-3">
  <div class="row">
    <div class="col-md-12">

      @include('common.success')
      @include('common.errors')

      <div class="alert alert-info d-block d-sm-none">
        <i class="fa fa-info-circle"></i>
        Editing texts on the phone is <strong>not recommended</strong> as it lacks some features.
      </div>

      <div class="card">
        <div class="card-header">
          <i class="fa fa-fw fa-pencil-alt"></i>
          Edit text <strong>{{ $text->name }}</strong>
          on page <strong>{{ $text->page }}</strong>
          <a id="side-by-side" href="#" class="float-right">
            <i class="fa fa-columns" title="Toggle side-by-side"></i>
          </a>
        </div>

        <div class="card-body">
          <form
            id="form-text-edit"
            class="form-horizontal"
            role="form"
            method="POST"
            action="{{ route('admin.text.update', $text) }}"
          >
            @method('PUT')
            @csrf

            <input type="hidden" name="id" value="{{ $text->id }}">
            <input type="hidden" name="redirect" value="1">

            <div class="row">
              <div id="col-en" class="col-lg-12">
                <div class="form-group">
                  <label class="control-label font-weight-bold">English text</label>
                  <textarea
                    class="form-control invisible"
                    rows="4"
                    name="content_en">{!! $text->content_en !!}</textarea>
                </div>
              </div>

              <div id="col-sv" class="col-lg-12">
                <div class="form-group">
                  <label class="control-label font-weight-bold">Swedish text</label>
                  <textarea
                    class="form-control invisible"
                    rows="4"
                    name="content_sv">{!! $text->content_sv !!}</textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group text-center">
                  <a
                    href="{{ route('admin.text.index') }}"
                    class="btn btn-secondary mt-1"
                  >
                    <i class="fa fa-btn fa-arrow-left"></i>
                    back
                  </a>
                  <a
                    href="javascript:;"
                    class="btn btn-primary submit mt-1"
                    data-redirect="1"
                  >
                    <i class="fa fa-btn fa-arrow-left"></i>
                    update and go back
                  </a>
                  <a
                    href="javascript:;"
                    class="btn btn-primary submit mt-1"
                    data-redirect="0"
                  >
                    update and continue
                    <i class="fa fa-btn fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
            @if ($text->updated_at)
            <div class="row">
              <div class="col-md-12">
                <i>Last edited {{ $text->updated_at }}</i>
              </div>
            </div>
            @endif
          </form>
        </div>
      </div>

      <div class="card my-3">
        <div class="card-header">
          <i class="fa fa-fw fa-history"></i>
          History
        </div>

        <div class="card-body">
          @forelse ($text->audits as $audit)
            <div>
              <script class="modified" type="text/template">{!! $audit->getModified(true) !!}</script>
              <a href="#"
                class="open-audit"
                data-title="{{ $audit->created_at }}"
              >{{ $audit->created_at }}</a>
              by {{ $audit->user->name }}
            </div>
          @empty
            <p>This text has no history.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="audit-modal" tabindex="-1" role="dialog" aria-labelledby="audit-modal-title" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="audit-modal-title"></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body"></div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-warning" disabled>Revert</button>
    </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="{{ mix('js/admin-text-edit.js') }}"></script>
<script>
$(function () {

  // form

  $('.submit').click(function (e) {
    // continue or redirect?
    $('input[name=redirect]').val($(e.currentTarget).data('redirect'))
    $('#form-text-edit').submit()
  })

  // side-by-side

  $('#side-by-side').click(function () {
    $('#text-edit-container').toggleClass('container-fluid').toggleClass('container')
    $('#col-en').toggleClass('col-lg-12').toggleClass('col-lg-6')
    $('#col-sv').toggleClass('col-lg-12').toggleClass('col-lg-6')
  })

  // modal

  var $modal = $('#audit-modal')

  $('.open-audit').click(function (e) {
    e.preventDefault()

    var $src = $(this)
    var modified = JSON.parse($src.parent().find('script').text())
    var html = ''

    $.each([['content_en', 'English'], ['content_sv', 'Swedish']], function (i, content) {
      if (modified[content[0]]) {
        html += '<h4>' + content[1] + '</h4>'
        html += '<span class="badge badge-success">new</span><br>'
        html += modified[content[0]].new
        html += '<br><span class="badge badge-danger">old</span><br>'
        html += modified[content[0]].old + '<p></p>'
      }
    })

    $modal.find('.modal-title').text($src.data('title'))
    $modal.find('.modal-body').html(html)
    $modal.modal()
  })
})
</script>
@endpush

@endsection
