<!doctype html>
<html>
  <head>
    <title>Fightzone TV</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mt-3 text-center">
          <img src="/images/logo_gray.png" style="max-height:200px;">
        </div>
        <div class="col-md-12 mt-3">
          <table class="table table-hover table-bordered table-striped" style="font-size:12px;">
            <thead>
              <tr>
                <th>&nbsp;</th>
                @foreach ($activities->keys() as $activity)
                  <th>@lang('app.activity.' . $activity)</th>
                @endforeach
              </tr>
            </thead>

            @foreach (range(1, 7) as $dayNumber)
              <tr @if (now()->dayOfWeekIso === $dayNumber) class="table-success" @endif>
                <th>
                  @lang('app.schedule.day.' . $dayNumber)
                </th>
                @foreach ($activities as $schedule)
                  @if (!$schedule->has($dayNumber))
                    <td>&nbsp;</td>
                    @continue
                  @endif
                  <td>
                  @foreach ($schedule->get($dayNumber) as $event)
                    @if (!$loop->first)
                      <br>
                    @endif
                    {{ $event->from_time }} - {{ $event->to_time }}
                    @if ($event->is_open_mat)
                      &middot; open mat
                    @elseif ($event->content)
                      &middot; {{ $event->content }}
                    @endif
                  @endforeach
                </td>
                @endforeach
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
