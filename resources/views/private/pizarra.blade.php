@extends('layouts.privada')

<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev, nuevoEstado) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post("/pizarra", { id: data, estado: nuevoEstado });
}
</script>


@section('content')
<div class="row"> 
<h2 class= "col-sm-3">Titulo </h1>
</div>
<div class="row">
    <div class="col-sm-3 container"  ondrop="drop(event,'Por hacer')" ondragover="allowDrop(event)" style="background-color: lightyellow;margin-top: 40px; margin-right: 40px; margin-left: 40px;"> 
            <!-- /.box-header -->
            <div class="box-body" >
              <div class="box-group" id="accordion1">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                @foreach ($requisitos as $requisito )
                @if ($requisito->estado == 'Por hacer')
                <div draggable="true" ondragstart="drag(event)" id="{{$requisito->id}}">
                <div class="panel box box-primary"  id="{{$requisito->id}}"  draggable="true" ondragstart="drag(event)" >
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion1" href="#{{$requisito->id}}" aria-expanded="false" class="collapsed">
                        {{$requisito->nombre}}
                      </a>
                    </h4>
                  </div>              
                  <div id="{{$requisito->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                     {{$requisito->descripcion}}
                    </div>
                  </div>
                </div></div>
                @endif
                @endforeach   
              </div>
            </div>
            <!-- /.box-body -->
        </div>
    <div class="col-sm-3 container " ondrop="drop(event,'En trámite')" ondragover="allowDrop(event)" style="background-color: lightgreen; margin-top: 40px; margin-right: 40px; margin-left: 40px;">  
            <!-- /.box-header -->
            <div class="box-body" >
              <div class="box-group" id="accordion2"  >
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                @foreach ($requisitos as $requisito )
                @if ($requisito->estado == 'En trámite')
                <div draggable="true" ondragstart="drag(event)" id="{{$requisito->id}}">
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion2"  href="#{{$requisito->id}}"  aria-expanded="false" class="collapsed">
                        {{$requisito->nombre}}
                      </a>
                    </h4>
                  </div>              
                  <div id="{{$requisito->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                       {{$requisito->descripcion}}
                    </div>
                  </div>
                </div></div>
                @endif
                @endforeach   
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    <div class="col-sm-3 container " ondrop="drop(event, 'Hecho')" ondragover="allowDrop(event)" style="background-color: lightblue; margin-top: 40px; margin-right: 40px; margin-left: 40px;">  
            <!-- /.box-header -->
            <div class="box-body" >
              <div class="box-group" id="accordion3">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                @foreach ($requisitos as $requisito )
                @if ($requisito->estado == 'Hecho')
                <div draggable="true" ondragstart="drag(event)" id="{{$requisito->id}}">
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion3"  href="#{{$requisito->id}}" aria-expanded="false" class="collapsed">
                      {{$requisito->nombre}}
                      </a>
                    </h4>
                  </div>              
                  <div id="{{$requisito->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                       {{$requisito->descripcion}}
                    </div>
                  </div>
                </div></div>
                @endif
                @endforeach   
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
    <div class="col-sm-1"></div>
</div>
@endsection
