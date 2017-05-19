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
            @foreach ($eventos as $evento)

              @if ($evento['show'])
                <!-- timeline time label -->
                <li class="time-label">
                    <span class="bg-red">{{ $evento['dia_concreto'] }}</span>
                </li>
                <!-- /.timeline-label -->
              @endif
            

              @if ($evento['tipo'] == 'commit')
                <!-- timeline item -->
                <li>
                  <i class="fa fa-git bg-aqua"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> {{ $evento['diferencia'] }}</span>

                    <h3 class="timeline-header"><a href="{{ $evento['commiter_url'] }}" target="_blank">{{ $evento['commiter'] }}</a> {{ $evento['commit_header'] }}</h3>

                    <div class="timeline-body">
                      {{ $evento['commit_body'] }}
                    </div>
                    <div class="timeline-footer">
                      <a href="{{ $evento['html_url'] }}" target="_blank" class="btn btn-primary btn-xs">Ir al commit</a>
                      <!--<a class="btn btn-danger btn-xs">Delete</a>-->
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
              
              @elseif ($evento['tipo'] == 'modificacion')
                <!-- timeline item -->
                <li>
                  <i class="{{ $evento['icon'] }}"></i>

                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> {{ $evento['diferencia'] }}</span>

                    <h3 class="timeline-header"><a href="/sprintsrequisitos/{{ $evento['sprint_id'] }}/{{ $evento['id'] }}">{{ $evento['requisito_nombre'] }}</a></h3>

                    <div class="timeline-body">
                      {!! $evento['mensaje'] !!}
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
              @endif

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