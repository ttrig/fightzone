@extends('layouts.base', ['pageTitle' => __('app.activity.armwrestling')])
@section('content')
@include('training._header', [
  'slug'  => 'armwrestling',
  'title' => __('app.activity.armwrestling'),
])
@endsection
