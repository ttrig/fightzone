@extends('layouts.base', ['pageTitle' => __('app.contact.title')])
@section('content')
<div class="container mt-3">
  <h2>
    <i class="fas fa-envelope"></i>
    @lang('app.contact.title')
  </h2>
  <div class="row mb-3">
    <div class="col-md-12">
      <p>
        {!! __('app.contact.text', [
          'email' => '<a href="mailto:info@fightzone.se">info@fightzone.se</a>',
          'facebook' => '<a target="_blank" href="https://www.facebook.com/FightzoneMalmo/">Facebook</a>'
        ]) !!}.
      </p>

      <div class="embed-responsive embed-responsive-16by9">
        <div id="map_canvas" class="embed-responsive-item">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2254.8464726101947!2d13.018315215924082!3d55.58728048050937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4653a168ef0ae967%3A0x6f93521499dbd9b7!2sKopparbergsgatan+2B%2C+214+44+Malm%C3%B6!5e0!3m2!1sen!2sse!4v1550359668295"  frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
