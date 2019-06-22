<?php

$activities = $prices->pluck('activity');

$attributes = [
  'adult_1_y',
  'adult_6_m',
  'adult_1_m',
  'youth_1_y',
  'youth_6_m',
  'youth_1_m',
];

$input = function($slug, $attr) use ($prices) {
  $activity = $prices->firstWhere('activity.slug', $slug);
  return sprintf('<input type="number" '
    .'name="%d[%s]"'
    .'value="%s" '
    .'class="form-control form-control-sm" '
    . '">'
    ,$activity->id
    ,$attr
    ,$activity->$attr
  );
};
?>
@extends('layouts.admin')
@section('content')

<div class="container mt-3 mb-3">
  <h2>Prices</h2>
  <div class="row">
    <div class="col-md-12">
      @include('common.success')
      @include('common.errors')
      <form role="form"
          method="POST"
          action="{{ route('admin.price.update') }}">
        {!! csrf_field() !!}
        <div class="table-responsive">
          <table class="table table-striped">
            <thead class="thead-light">
              <tr class="text-center">
                <th>&nbsp;</th>
                <th colspan="3">Adult</th>
                <th colspan="3">Youth</th>
              </tr>
              <tr class="text-center">
                <th>&nbsp;</th>
                <th>1 year</th>
                <th>6 months</th>
                <th>1 month</th>
                <th>1 year</th>
                <th>6 months</th>
                <th>1 month</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($activities as $activity)
              <tr>
                <th scope="row">{{ $activity->name }}</th>
                @foreach ($attributes as $attribute)
                  <td>
                    {!! $input($activity->slug, $attribute) !!}
                  </td>
                @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-fw fa-check"></i>
          Save
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
