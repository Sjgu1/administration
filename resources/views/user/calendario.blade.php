@extends('layouts.privada')

@section('content')

    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="/adminlte/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/fullcalendar/fullcalendar.print.css" media="print">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="/adminlte/plugins/fullcalendar/fullcalendar.min.js"></script>
    <!-- fullCalendar 2.2.5 -->

    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <section class="content-header">
      <h1>
        @lang('messages.calendario')
        <small>@lang('messages.proyecto')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>@lang('messages.inicio')</a></li>
        <li><a href="#">UI</a></li>
        <li>@lang('messages.actividad')</li>
      </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next Hoy',
        center: 'title',
        right: ''
      },
      buttonText: {
        today: 'today',
        month: 'Mes',
        week: 'Semana',
        day: 'Día'
      },
      //Random default events
      events: [

          @foreach ($requisitos as $requisito)
            {
                title: {!! '"' !!} {{ $requisito->nombre }} {!! '"' !!} {{ ',' }}
                start: new Date({{ $requisito->fecha_inicio_split[2] }}, {{ $requisito->fecha_inicio_split[1] - 1 }}, {{ $requisito->fecha_inicio_split[0] }}),
                end: new Date({{ $requisito->fecha_fin_estimada_split[2] }}, {{ $requisito->fecha_fin_estimada_split[1] - 1 }}, {{ $requisito->fecha_fin_estimada_split[0] }}),
                backgroundColor: {!! '"' !!} {{ $requisito->color }} {!! '"' !!} {{ ',' }}
                borderColor: {!! '"' !!} {{ $requisito->color }} {!! '"' !!} {{ ',' }}
            },
          @endforeach
      ],
      editable: false,
      droppable: false, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      }
    });

    $('#calendar').fullCalendar('option', 'height', 'auto');

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });
</script>
@endsection