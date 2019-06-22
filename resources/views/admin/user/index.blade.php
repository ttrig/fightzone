@extends('layouts.admin')
@section('content')
<div class="container mt-3">
  <div class="row">

    <div class="col-md-12">

      @include('admin.common.header', [
        'title' => 'Users',
        'icon' => 'users',
        'button' => [
          'title' => 'Add',
          'route' => 'admin.user.create',
          'icon' => 'plus',
        ],
      ])

      @include('common.success')

      <div class="alert alert-warning">
        <i class="fas fa-info-circle"></i>
        Remember to <strong>delete</strong> users to prevent them from logging in.
        Changing e-mail is <strong>not enough</strong>.
      </div>

      <div class="table-responsive">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th>E-mail</th>
              <th>Name</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{ $user->email }}</td>
              <td>{{ $user->name ?? '' }}</td>
              <td align="right" style="white-space:nowrap;">
                <a href="{{ route('admin.user.edit', $user) }}"
                   class="btn btn-sm btn-primary"
                   title="Edit"
                >
                  <i class="fas fa-pencil-alt"></i>
                </a>
                @unless ($user->id == Auth::user()->id)
                  <a href="#disable"
                    class="btn btn-sm btn-warning sign-out-user"
                    data-user-id="{{ $user->id }}"
                    title="Sign out"
                  >
                    <i class="fas fa-sign-out-alt"></i>
                  </a>
                  <a href="#"
                    class="btn btn-sm btn-danger destroy-user"
                    data-user-id="{{ $user->id }}"
                    title="Delete"
                  >
                    <i class="far fa-trash-alt"></i>
                  </a>
                  <form id="destroy-user-{{ $user->id }}"
                      action="{{ route('admin.user.destroy', $user) }}"
                      method="POST"
                      style="display: none;">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                  </form>
                @endunless
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
  $('.destroy-user').click(function() {
    event.preventDefault();

    if (!confirm('Do you really want to delete this user?')) {
      return
    }

    var id = $( this ).data('user-id');
    $('#destroy-user-' + id).submit();
  });
})
</script>
@endpush
