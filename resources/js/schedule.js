import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import _ from 'lodash'

$(function() {
  if ($('#calendar-container').is(':visible')) {
    const $spinner = $('#calendar-spinner')
    const $filter = $('#calendar-filter')

    const $fullcalendar = new Calendar($('#calendar')[0], {
      plugins: [dayGridPlugin],
      locale: $('html').prop('lang').substr(0, 2),
      defaultView: 'dayGridWeek',
      height: 'auto',
      minTime: '09:00:00',
      maxTime: '21:00:00',
      allDaySlot: false,
      displayEventEnd: true,
      firstDay: 1,
      header: false,
      footer: false,
      events: JSON.parse($('#calendar-events').html()),
      loading: function() {
        $spinner.removeClass('d-none')
      },
      datesRender: function () {
        $spinner.addClass('d-none')
        $filter.removeClass('d-none')
      },
      eventRender: function(event, element) {
        let filterSlug = $('select', $filter).val()
        let slug = _.get(event, 'event.extendedProps.slug')
        if (filterSlug && slug != filterSlug) {
          return false
        }
      }
    })

    $fullcalendar.render()

    $filter.find('select').change(function () {
      $fullcalendar.rerenderEvents()
    })
  }
})
