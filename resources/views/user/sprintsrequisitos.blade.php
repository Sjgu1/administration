@extends('layouts.privada')
@section('cabecera')
@if(session()->has('message'))
    @if(session()->has('exito'))
    <div class="alert alert-success alert-dismissible" id="event-modal">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <h4><i class="icon fa fa-check"></i> Éxito!</h4>
      <p>{{ session()->get('message') }}</p>
    </div>
    @else
    <div class="alert alert-danger alert-dismissible" id="event-modal">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        <p>{{ session()->get('message') }}</p>
    </div>
    @endif
@endif
@endsection
@section('content')

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
<!-- bootstrap color picker -->
<script src="/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap datepicker -->
<script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/adminlte/dist/js/pages/dashboard.js"></script>
<input id="fecha_inicio_proyecto" value="{{$proyecto->fecha_inicio}}" class="hide"/>
    <!-- Header -->
    <section class="content-header">
        <h1>@lang('messages.requisitos')<small>{{$proyecto->nombre}}</small></h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> @lang('messages.inicio')</li>
            <li>Sprints</li>
            <li class="active">{{ $sprint->nombre }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content connectedSortable">
        <div class="callout callout-info">
            <h4>{{ $sprint->nombre }}
                @if ($modificar_sprint) <i class="fa fa-fw fa-edit pull-right btn " class="btn btn-primary" data-toggle="modal" data-target="#exampleModalEdit"></i>@endif
            </h4>

        <p>{{ $sprint->fecha_inicio }} <i class="fa fa-minus"></i> {{ $sprint->fecha_fin_estimada }}</p>
      </div>
        <div class="row">
            <div id="requisitos_no_finalizados" class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">@lang('messages.requisitos en proceso')</h3>

                        <!--<div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <!-- /.box-header -->

                    @if (count($requisitos_no_finalizados) >= 1)
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('messages.nombre')</th>
                                <th>@lang('messages.progreso estimado')</th>
                                <th>%</th>
                                <th>@lang('messages.finalizacion')</th>
                                <th>@lang('messages.usuario')</th>
                            </tr>

                            @foreach ($requisitos_no_finalizados as $requisito)
                                <tr data-toggle="modal" data-target="#exampleModal{{ $requisito->id }}" style="cursor: pointer; cursor: hand;">
                                    <td>{{ $requisito->nombre }}</td>
                                    <td>
                                        <div class="progress progress-xs {{ $requisito->stripped }} active">
                                            <div class="progress-bar progress-bar-{{ $requisito->color }}" style="width: {{ $requisito->progreso }}"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-{{ $requisito->color }}">{!! $requisito->porcentaje !!}</span></td>
                                    <td>{{ $requisito->finalizacion }}</td>

                                    <td>
                                        @foreach ($requisito->users as $userReq)
                                            <img src="/perfiles/{{ $userReq->imagen }}" class="user-image" alt="User Image" width="25" height="25" style="margin-left: 10%;">
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                    @endif
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <!-- Requisitos finalizados -->
        <div class="row">
            <div id="requisitos_finalizados" class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">@lang('messages.requisitos finalizados')</h3>

                        <!--<div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <!-- /.box-header -->

                    @if (count($requisitos_finalizados) >= 1)
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>@lang('messages.nombre')</th>
                                <th>@lang('messages.fecha de inicio')</th>
                                <th>@lang('messages.fecha estimada de fin')</th>
                                <th>@lang('messages.fecha fin')</th>
                                <th>@lang('messages.duracion')</th>
                            </tr>

                            @foreach ($requisitos_finalizados as $requisito)
                                <tr data-toggle="modal" data-target="#exampleModal{{ $requisito->id }}" style="cursor: pointer; cursor: hand;">
                                    <td><strike>{{ $requisito->nombre }}</strike></td>
                                    <td>{{ $requisito->fecha_inicio }}</td>
                                    <td>{{ $requisito->fecha_fin_estimada }}</td>
                                    <td>{{ $requisito->fecha_fin }}</td>
                                    <td>{{ $requisito->duracion }}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                    @endif
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- Fin requisitos finalizados -->
    </section>

<!-- Formulario modificación sprint -->
<div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="requisito_form_modificar" action="{{ url('sprint/modificar') }}" method="POST" role="form" data-toggle="validator">

                        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}" />
                        <input type="hidden" name="id" value="{{$sprint->id }}" />
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-header form-group has-feedback">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <label for="recipient-name" class="control-label">@lang('messages.nombre'):</label>
                            <input type="text" class="form-control modal-title" name="nombre" value="{{$sprint->nombre}}"  data-minlength="3" maxlength="50" required>
                        </div>
                        <div class="modal-body">
                            <div class="form-group  has-feedback">
                                <label for="descripcion" class="control-label">@lang('messages.descripcion'):</label>
                                <textarea id="descripcion" name="descripcion" class="form-control" value="{{$sprint->descripcion}}" rows="5" data-minlength="3" maxlength="65535" required>{{$sprint->descripcion}}</textarea>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class=" col-md-4 form-group has-feedback">
                                        <label for="message-text" class="control-label">Fecha estimada inicio:</label>
                                        <div class="form-group has-feedback">
                                            <div class='input-group date has-feedback' id="fecha_inicio_crear">
                                                <input id="input_fecha_inicio_sprint{{ $sprint->id }}" type='text' readonly class="form-control"  name="fecha_inicio"  value="{{ $sprint->fecha_inicio }}" style="background-color: #fff; "/> <span class="input-group-addon">
                                                    <span id="datepicker_fecha_inicio_sprint{{ $sprint->id }}" class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 has-feedback">
                                        <label for="message-text" class="control-label">Fecha estimada fin:</label>

                                        <div class="form-group has-feedback">
                                            <div class='input-group has-feedback date'id="fecha_fin_estimada_crear"  >
                                                <input id="input_fecha_fin_estimada_sprint{{ $sprint->id }}"type='text' readonly class="form-control" name="fecha_fin_estimada" value="{{ $sprint->fecha_fin_estimada }}" style="background-color: #fff; "/> <span class="input-group-addon">
                                                <span id="datepicker_fecha_fin_estimada_sprint{{ $sprint->id }}" class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 has-feedback">
                                        <label for="message-text" class="control-label">@lang('messages.fecha fin'):</label>

                                        <div class="form-group has-feedback">
                                            <div class='input-group date has-feedback 'id="fecha_fin_crear" >
                                                <input id="input_fecha_fin_sprint{{ $sprint->id }}" type='text' readonly class="form-control" name="fecha_fin" value="{{ $sprint->fecha_fin }}" style="background-color: #fff; "/> <span class="input-group-addon">
                                                <span id="datepicker_fecha_fin_sprint{{ $sprint->id }}" class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                @if ($borrar_sprint)
                                <button id="eliminar_sprint{{ $sprint->id }}" type="button" class="btn btn-danger pull-left">@lang('messages.eliminar')</button>
                                @endif
                                <button class="btn btn-default" data-dismiss="modal" aria-label="Close">@lang('messages.proyectos')</button>
                                @if ($modificar_sprint)
                                <button type="submit" class="btn btn-success">@lang('messages.modificar')</button>
                                @endif
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- FIN Formulario modificación sprint -->


<!-- Formularios modificación -->
@foreach ($requisitos as $requisito )

    <div class="modal fade" id="exampleModal{{ $requisito->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="requisito_form_modificar" action="{{ url('requisito/modificar_public') }}" method="POST" role="form" data-toggle="validator">
                    <input type="hidden" name="sprint_id" value="{{ $sprint->id }}" />
                    <input type="hidden" name="input_id" value="{{ $requisito->id }}" />
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <input type="hidden" name="estado" value="{{ $requisito->estado }}" />

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <label for="recipient-name" class="control-label">@lang('messages.nombre'):</label>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control modal-title" name="input_nombre" value="{{ $requisito->nombre }}"  data-minlength="3" maxlength="20" required>
                        </div>
                    </div>
                    <div class="modal-body" style="margin-bottom: 0px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-default box-solid collapsed-box" style="background-color: #fff;">
                                    <div class="box-header with-border" style="background-color: #fff;">
                                    <h3 class="box-title">Log</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="display: none;">
                                        @foreach ($modificacions as $clave => $valor)
                                            @if ($clave == $requisito->id)
                                                @foreach ($valor as $modificacion)
                                                    <p>{!! '-' . $modificacion['mensaje'] !!}<span class="pull-right">{{ $modificacion['dia_concreto'] }}</span></p>
                                                    <hr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="col-md-6" style="padding-left: 0%">
                                 <label for="message-text" class="control-label">@lang('messages.fecha estimada de inicio'):</label>
                                 <div class="input-group form-group has-feedback">
                                    <input type='text' class="form-control" id="fecha_inicio{{ $requisito->id }}" name="fecha_inicio"readonly value="{{ $requisito->fecha_inicio }}" disabled />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                 </div>
                              </div>
                              <div class="form-group col-md-6 has-feedback">
                                 <label for="message-text" class="control-label">@lang('messages.fecha estimada de fin'):</label>
                                 <div class="form-group has-feedback">
                                    <div class='input-group date has-feedback' id='fecha_fin_{{$requisito->id}}'>
                                       <input type='text' class="form-control" id='input_fecha_estimada_fin{{$requisito->id}}' name="input_fecha_estimada_fin" value="{{$requisito->fecha_fin_estimada}}" /> <span id="datepicker{{ $requisito->id }}"class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <label for="descripcion" class="control-label">@lang('messages.descripcion'):</label>
                        <div class="form-group has-feedback">
                            <textarea id="descripcion" name="input_descripcion" class="form-control" rows="5" data-minlength="3" maxlength="65535" required>{{ $requisito->descripcion }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6" style="padding-left: 0%">
                                    <label for="message-text" class="control-label">Usuario asignado:</label>
                                    <select name="input_user" class="form-control">
                                        <option value="null">@lang('messages.selecciona nuevos usuarios')</option>
                                        @if (count($requisito->users) > 0)
                                            @foreach ($users as $userB)
                                                @if ($userB->id == $requisito->users[0]->id)
                                                    <option value="{{ $userB->id }}" selected>{{ $userB->name . ' ' . $userB->apellidos }}</option>
                                                @else
                                                    <option value="{{ $userB->id }}">{{ $userB->name . ' ' . $userB->apellidos }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach ($users as $userB)
                                                    <option value="{{ $userB->id }}">{{ $userB->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6" style="padding-right: 0%">
                                    <label for="message-text" class="control-label">@lang('messages.color'):</label>
                                    <div class="input-group my-colorpicker{{ $requisito->id }} colorpicker-element">
                                        <input type="text" name="input_color" readonly class="form-control" style="background-color: #fff"  />
                                        <div class="input-group-addon">
                                            <i style="background-color: rgb(130, 124, 124);"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if ($borrar_requisito)
                        <button id="eliminar{{ $requisito->id }}" type="button" class="btn btn-danger pull-left">@lang('messages.eliminar')</button>
                        @endif
                        <button class="btn btn-default" data-dismiss="modal" aria-label="Close">@lang('messages.proyectos')</button>
                        @if ($modificar_requisito)
                        <button type="submit" class="btn btn-success">@lang('messages.modificar')</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- FIN Formularios modificación -->

<script>
@foreach ($requisitos as $requisito)

    $("#eliminar{{ $requisito->id }}").click(function() {

        swal({
            title: "¿Estás seguro?",
            text: "Vas a borrar el requisito {{ $requisito->nombre }}",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Sí, adelante",
            closeOnConfirm: false,
            allowOutsideClick: true
        },
        function(){
           window.location.href = "/requisito/borrar/{{ $requisito->id }}";            
       });
    });

@endforeach
</script>
<script>
@foreach ($requisitos as $requisito)
    //color picker with addon
    $(".my-colorpicker{{ $requisito->id }}").colorpicker();
@endforeach
</script>
<script>

    var url = window.location.href;
    var splitted = url.split('/');

    if (splitted.length == 6 && $.isNumeric(splitted[5])){

        $('#exampleModal' + splitted[5]).modal('show');
    }

</script>


<script>
    //Date picker
    $('#datepicker_fecha_inicio_sprint{{ $sprint->id }}').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: $("#fecha_inicio_proyecto").val()
    })
    .on('changeDate', function(e) {
        // Set the value for the date input
        $("#input_fecha_inicio_sprint{{ $sprint->id }}").val($("#datepicker_fecha_inicio_sprint{{ $sprint->id }}").datepicker('getFormattedDate'));
        $("#datepicker_fecha_fin_estimada_sprint{{ $sprint->id }}").datepicker('setStartDate', $('#datepicker_fecha_inicio_sprint{{ $sprint->id }}').datepicker('getDate'));
        $("#datepicker_fecha_fin_sprint{{ $sprint->id }}").datepicker('setStartDate', $('#datepicker_fecha_inicio_sprint{{ $sprint->id }}').datepicker('getDate'));

        // Revalidate it
        //$('#eventForm').formValidation('revalidateField', 'selectedDate');
    });

    //Date picker
    $('#datepicker_fecha_fin_estimada_sprint{{ $sprint->id }}').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: $("#input_fecha_inicio_sprint{{ $sprint->id }}").val()
    })
    .on('changeDate', function(e) {
        // Set the value for the date input
        $("#input_fecha_fin_estimada_sprint{{ $sprint->id }}").val($("#datepicker_fecha_fin_estimada_sprint{{ $sprint->id }}").datepicker('getFormattedDate'));
        
        // Revalidate it
        //$('#eventForm').formValidation('revalidateField', 'selectedDate');
    });

    //Date picker
    $('#datepicker_fecha_fin_sprint{{ $sprint->id }}').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: $("#input_fecha_inicio_sprint{{ $sprint->id }}").val()
    })
    .on('changeDate', function(e) {
        // Set the value for the date input
        $("#input_fecha_fin_sprint{{ $sprint->id }}").val($("#datepicker_fecha_fin_sprint{{ $sprint->id }}").datepicker('getFormattedDate'));

        // Revalidate it
        //$('#eventForm').formValidation('revalidateField', 'selectedDate');
    });

</script>

<script>

    $("#eliminar_sprint{{ $sprint->id }}").click(function() {

        swal({
            title: "¿Estás seguro?",
            text: "Vas a borrar el sprint {{ $sprint->nombre }}",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Sí, adelante",
            closeOnConfirm: false,
            allowOutsideClick: true
        },
        function(){
            window.location.href = "{{ url('sprint/borrar') . '/' . $sprint->id }}";
        });
    });

</script>
<script>
$(document).ready(function(){
   setTimeout(function(){
         $('#event-modal').fadeOut(400);
   },2000);
});
</script>
<script>
@foreach ($requisitos as $requisito)
    $('#datepicker{{ $requisito->id }}').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      startDate: $("#fecha_inicio{{ $requisito->id }}").val()
    })
    .on('changeDate', function(e) {
        // Set the value for the date input
        $("#input_fecha_estimada_fin{{ $requisito->id }}").val($("#datepicker{{ $requisito->id }}").datepicker('getFormattedDate'));

        // Revalidate it
        //$('#eventForm').formValidation('revalidateField', 'selectedDate');
    });

@endforeach
</script>
@endsection