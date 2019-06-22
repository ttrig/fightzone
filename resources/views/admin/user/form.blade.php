@extends('layouts.admin')
@section('content')
<div class="container mt-3 mb-3">
  <div class="row">
    <div class="col-md-6 offset-md-3">

      <div class="card">
        <div class="card-header">
        @if ($user->exists)
          <i class="fa fa-fw fa-pencil-alt"></i>
          Edit user
        @else
          <i class="fa fa-fw fa-plus"></i>
          Add user
        @endif
        </div>

        <div class="card-body">

          @include('common.errors')

          @if ($user->exists)
            <form
              class="form-horizontal"
              role="form"
              method="POST"
              action="{{ route('admin.user.update', $user) }}"
            >
              {{ method_field('PUT') }}
              <input type="hidden" name="id" value="{{ $user->id }}">
          @else
            <form
              class="form-horizontal"
              role="form"
              method="POST"
              action="{{ route('admin.user.store') }}"
            >
          @endif

            {!! csrf_field() !!}

            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="control-label">E-mail</label>
                  <input
                    type="email"
                    class="form-control"
                    name="email"
                    autocomplete="off"
                    value="{{ $user->exists ? $user->email : '' }}"
                  >
                </div>

                <div class="form-group">
                  <label class="control-label">Name</label>
                  <input
                    type="text"
                    class="form-control"
                    name="name"
                    autocomplete="off"
                    value="{{ $user->exists ? $user->name : '' }}"
                  >
                </div>

                <div class="form-group">
                  <label class="control-label">Password</label>
                  <input
                    type="password"
                    class="form-control"
                    name="password"
                    autocomplete="new-password"
                    value=""
                  >
                </div>
              </div>

              <div class="col-lg-12">

                <div class="form-group">
                  <a href="{{ route('admin.user.index') }}"
                     type="btn"
                     class="btn btn-secondary">
                    <i class="fa fa-btn fa-arrow-left"></i>
                    back
                  </a>
                  <button type="submit" class="btn btn-primary">
                  @if ($user->exists)
                    <i class="fas fa-pencil-alt"></i>
                    Update
                  @else
                    <i class="fa fa-plus"></i>
                    Add
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
