@extends('layouts.admin')

@section('breadcrumbs', '')

@section('content')
<div class="container mt-3">

  <div class="d-flex justify-content-between mb-2">
    <h3>
      <i class="fas fa-key"></i>
      Administration
    </h3>

    <form action="{{ route('logout') }}" method="POST">
      {!! csrf_field() !!}
      <button type="submit" class="btn btn-primary">
        <i class="fa fa-sign-out-alt"></i>
        Sign out
      </button>
    </form>
  </div>

  <div class="list-group mb-4">
    <a href="{{ route('admin.text.index') }}" class="list-group-item list-group-item-action">
      <i class="mr-2 fas fa-fw fa-paragraph"></i>
      <strong>Texts</strong>
      <span class="d-none d-md-inline"> - Edit text used throughout the site.</span>
    </a>
    <a href="{{ route('admin.event.index') }}" class="list-group-item list-group-item-action">
      <i class="mr-2 fas fa-fw fa-calendar-alt"></i>
      <strong>Schedule</strong>
      <span class="d-none d-md-inline"> - Update schedule.</span>
    </a>
    <a href="{{ route('admin.price.index') }}" class="list-group-item list-group-item-action">
      <i class="mr-2 fas fa-fw fa-dollar-sign"></i>
      <strong>Prices</strong>
      <span class="d-none d-md-inline"> - Update prices.</span>
    </a>
    <a href="{{ route('admin.alert.index') }}" class="list-group-item list-group-item-action">
      <i class="mr-2 fas fa-fw fa-comment"></i>
      <strong>Alerts</strong>
      <span class="d-none d-md-inline"> - Create alert messages that should appear at given dates.</span>
      @if ($alerts->isNotEmpty())
        <span class="badge badge-success badge-pill">{{ $alerts->count() }} active</span>
      @endif
    </a>
    <a href="{{ route('admin.user.index') }}" class="list-group-item list-group-item-action">
      <i class="mr-2 fas fa-fw fa-users"></i>
      <strong>Users</strong>
      <span class="d-none d-md-inline"> - Manage users that should be able to login and moderate this site.</span>
    </a>
    <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">
      <i class="mr-2 fas fa-fw fa-newspaper"></i>
      <strong>Articles</strong>
      <span class="d-none d-md-inline"> - Create and update articles on the "news" page.</span>
    </a>
  </div>

  @if ($alerts->isNotEmpty())
    <div class="mb-4">
      <h4>
        <i class="fas fa-comment"></i>
        Active alerts
      </h4>
      <div class="list-group">
        @foreach ($alerts as $alert)
          <a
            href="{{ route('admin.alert.edit', $alert) }}"
            class="list-group-item list-group-item-action"
          >
            <span class="badge badge-{{ $alert->class }} mr-2" title="Color">
              <i class="fa fa-tint"></i>
            </span>
            On {{ $alert->page ? '"' . $alert->page . '" page' : 'all pages' }}
            from
            {{ $alert->from_date->toDateString() }}
            to
            {{ $alert->to_date->toDateString() }}.
          </a>
        @endforeach
      </div>
    </div>
  @endif

  <div class="row">
    <div class="col-md-6 mb-4">
      <h4>
        <i class="fas fa-history"></i>
        Your latest changes
      </h4>
      <ul class="list-group">
        @forelse ($userAudits as $audit)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <i class="{{ $audit->icon }} fa-fw"></i>
              {{ ucfirst($audit->event) }}
              @if ($audit->route)
                <a href="{{ $audit->route }}">{{ $audit->name }}</a>
              @else
                {{ $audit->name }}
              @endif
              @isset ($audit->context)
                {{ $audit->context }}
              @endif
            </div>
            <span
              title="{{ $audit->created_at->toDateTimeString() }}"
              class="text-muted"
            >
              {{ $audit->created_at->diffForHumans() }}
            </span>
          </li>
        @empty
          <li class="list-group-item d-flex">
            No changes, yet.
          </li>
        @endforelse
      </ul>
    </div>

    <div class="col-md-6 mb-4">
      <h4>
        <i class="fas fa-history"></i>
        Latest changes
      </h4>
      <ul class="list-group">
        @forelse ($allAudits as $audit)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <i class="{{ $audit->icon }} fa-fw"></i>
              {{ $audit->user ? $audit->user->name : 'Someone' }}
              {{ $audit->event }}
              @if ($audit->route)
                <a href="{{ $audit->route }}">{{ $audit->name }}</a>
              @else
                {{ $audit->name }}
              @endif
              @isset ($audit->context)
                {{ $audit->context }}
              @endif
            </div>
            <span
              title="{{ $audit->created_at->toDateTimeString() }}"
              class="text-muted"
            >
              {{ $audit->created_at->diffForHumans() }}
            </span>
          </li>
        @empty
          <li class="list-group-item d-flex">
            No changes, yet.
          </li>
        @endforelse
      </ul>
    </div>
  </div>{{-- /row --}}

</div>
@endsection
