"use strict";

document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    timeZone: 'America/Sao_Paulo',
    headerToolbar: {
      start: 'prev, next, today',
      // will normally be on the left. if RTL, will be on the right
      center: 'title',
      end: 'dayGridMonth, timeGridWeek, timeGridDay' // will normally be on the right. if RTL, will be on the left

    },
    buttonText: {
      today: 'Hoje',
      month: 'mês',
      week: 'semana',
      day: 'dia',
      list: 'lista'
    },
    dateClick: function dateClick(info) {
      alert('Clicked on: ' + info.dateStr);
      alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
      alert('Current view: ' + info.view.type); // change the day's background color just for fun

      info.dayEl.style.backgroundColor = 'red';
    },
    events: [{
      // this object will be "parsed" into an Event Object
      title: 'The Title1',
      // a property!
      start: '2022-03-15 23:13:11',
      // a property!
      end: '2022-03-16 23:13:11' // a property! ** see important note below about 'end' **

    }, {
      // this object will be "parsed" into an Event Object
      title: 'The Title2',
      // a property!
      start: '2022-03-17 17:13:11',
      // a property!
      end: '2022-03-18 23:13:11' // a property! ** see important note below about 'end' **

    }],
    locale: 'pt-br'
  });
  calendar.render().updateSize();
});