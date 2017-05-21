@extends('layouts.privada')

@section('content')
    
    <section class="content-header">
      <h1>@lang('messages.graficos')<small>@lang('messages.frecuencia')</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> @lang('messages.inicio')</a></li>
        <li>@lang('messages.graficos')</li>
        <li class="active">@lang('messages.frecuencia') @lang('messages.por dia')</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col (LEFT) -->
        <div class="col-md-12" style="display: none">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('messages.frecuencia') @lang('messages.por hora')</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height: 250px; width: 454px;" height="250" width="454"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->

        <!-- /.col (LEFT) -->
        <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">@lang('messages.frecuencia') @lang('messages.por dia')</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart2" style="height: 250px; width: 454px;" height="250" width="454"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    <script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    //var areaChartCanvas = $("#lineChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    //var areaChart = new Chart(areaChartCanvas);

    var areaChartData = {
      labels: ["00:00AM", "01:00AM", "02:00AM", "03:00AM", "04:00AM", "05:00AM", "06:00AM", "07:00AM", "08:00AM", "09:00AM", "10:00AM", "11:00AM", "12:00PM", "13:00PM", "14:00PM", "15:00PM", "16:00PM", "17:00PM", "18:00PM", "19:00PM", "20:00PM", "21:00PM", "22:00PM", "23:00PM"],
      datasets: [
        {
          label: "Commits",
          backgroundColor: "rgba(60,141,188,0.9)",
          fill: true,
          lineTension: 0,
          borderColor: "rgba(60,141,188,0.8)",
          pointBackgroundColor: "#3b8bba",
          pointHoverBackgroundColor: "#fff",
          //fillColor: "rgba(60,141,188,0.9)",
          //strokeColor: "rgba(60,141,188,0.8)",
          //pointColor: "#3b8bba",
          //pointStrokeColor: "rgba(60,141,188,1)",
          //pointHighlightFill: "#fff",
          //pointHighlightStroke: "rgba(60,141,188,1)",
          data: [

            @foreach ($horas as $hora)
              {{ $hora . ',' }}
            @endforeach

          ]
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      steppedLine: true,
      //Number - Tension of the bezier curve between points
      lineTension: 0,
      //Boolean - Whether to show a dot for each point
      pointDot: true,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 3,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    //areaChart.Line(areaChartData, areaChartOptions);

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    //var lineChart = new Chart(lineChartCanvas);
    var lineChartOptions = areaChartOptions;
    lineChartOptions.fill = false;
    //lineChart.Line(areaChartData, lineChartOptions);

    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: lineChartOptions
    });


    //-------------
    //- LINE CHART DÍA -
    //--------------
    var areaChartData2 = {
      labels: ["@lang('messages.lunes')", "@lang('messages.martes')", "@lang('messages.miercoles')", "@lang('messages.jueves')", "@lang('messages.viernes')", "@lang('messages.sabado')", "@lang('messages.domingo')"],
      datasets: [
        {
          label: "Commits",
          backgroundColor: "#28a745",
          fill: true,
          lineTension: 0,
          borderColor: "#1e7e34",
          pointBackgroundColor: "#1e7e34",
          pointHoverBackgroundColor: "#fff",
          //fillColor: "rgba(210, 214, 222, 1)",
          //strokeColor: "rgba(210, 214, 222, 1)",
          //pointColor: "rgba(210, 214, 222, 1)",
          //pointStrokeColor: "#c1c7d1",
          //pointHighlightFill: "#fff",
          //pointHighlightStroke: "rgba(220,220,220,1)",
          data: [

            @foreach ($dias as $dia)
              {{ $dia . ',' }}
            @endforeach
          
          ]
        }
      ]
    };

    var areaChartOptions2 = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      steppedLine: true,
      //Number - Tension of the bezier curve between points
      lineTension: 0,
      //Boolean - Whether to show a dot for each point
      pointDot: true,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 3,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    //areaChart.Line(areaChartData, areaChartOptions);

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas2 = $("#lineChart2").get(0).getContext("2d");
    //var lineChart = new Chart(lineChartCanvas);
    var lineChartOptions2 = areaChartOptions2;
    lineChartOptions2.fill = false;
    //lineChart.Line(areaChartData, lineChartOptions);

    var lineChart2 = new Chart(lineChartCanvas2, {
        type: 'line',
        data: areaChartData2,
        options: lineChartOptions2
    });

  });
</script>
@endsection