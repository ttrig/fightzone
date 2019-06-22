@extends('layouts.admin')
@section('content')
<div class="container mt-3">
  <div class="row">
    <div class="col-md-12">

      @include('admin.common.header', [
        'title' => 'Texts',
        'icon' => 'paragraph',
      ])

      @include('common.success')

      @if ($texts->count())
        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <thead class="thead-light">
              <tr>
                <th>Page</th>
                <th>Name</th>
                <th>Text</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($texts as $text)
              <tr @empty($text->content) class="table-warning" @endempty>
                <td>
                  <span class="badge badge-primary">
                    {{ $text->route }}
                  </span>
                </td>
                <td>
                  <span class="badge badge-success">
                    {{ $text->name }}
                  </span>
                </td>
                <td>
                  {{ str_limit(strip_tags($text->content_en), 60) }}
                </td>
                <td align="right">
                  <a href="{{ route('admin.text.edit', $text) }}"
                  class="btn btn-sm btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="alert alert-danger">
          <i class="fas fa-fw fa-exclamation-triangle"></i>
          No texts found.
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
