@extends('layouts.base', ['pageTitle' => 'Login'])
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3 mt-4 mb-3">
      <div class="card">
        <div class="card-header">
          Login
        </div>
        <div class="card-body">
          <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group">
              <label for="email" class="col-md-12 control-label">
                E-Mail address
              </label>

              <div class="col-md-12">
                <input id="email"
                     type="email"
                     class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                     name="email"
                     value="{{ old('email') }}"
                     required
                     autofocus>
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="col-md-12 control-label">
                Password
              </label>

              <div class="col-md-12">
                <input id="password"
                     type="password"
                     class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                     name="password"
                     required>
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <div class="checkbox">
                  <label>
                    <input type="checkbox"
                         name="remember"
                         {{ old('remember') ? 'checked' : '' }}> Remember Me
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                  Login
                </button>
                {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                  Forgot Your Password?
                </a> --}}
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
