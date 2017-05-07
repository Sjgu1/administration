@extends('layouts.privada')

@section('content')
    <section class="content-header">
      <h1>
        Timeline
        <small>Proyecto</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">UI</a></li>
        <li class="active">Timeline</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">

            <!-- ZONA ENSAYO -->
            @foreach ($commits as $key => $value)

              <!-- timeline time label -->
              <li class="time-label">
                  <span class="bg-red">{{ $key }}</span>
              </li>
              <!-- /.timeline-label -->

              @foreach ($value as $commit)
              <!-- timeline item -->
              <li>
                <i class="fa fa-user bg-aqua"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fa fa-clock-o"></i> {{ $commit[3] }}</span>

                  <h3 class="timeline-header"><a href="#">{{ $commit[0] }}</a> {{ $commit[1] }}</h3>

                  <div class="timeline-body">
                    {{ $commit[2] }}
                  </div>
                  <div class="timeline-footer">
                    <a href="{{ $commit[4] }}" class="btn btn-primary btn-xs">Ir al commit</a>
                    <!--<a class="btn btn-danger btn-xs">Delete</a>-->
                  </div>
                </div>
              </li>
              <!-- END timeline item -->
              @endforeach

            @endforeach
            <!-- FIN ZONA ENSAYO -->
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
@endsection