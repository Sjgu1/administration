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
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
<!-- bootstrap color picker -->
<script src="/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap datepicker -->
<script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
<section class="content-header">
      <h1>@lang('messages.nuevo proyecto')</h1>
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">UI</a></li>
        <li class="active">Timeline</li>
      </ol>-->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col (LEFT) -->
        <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-body">

                <form id="user_form" action="{{ url('proyecto/create') }}" method="POST" enctype="multipart/form-data" role="form" data-toggle="validator">
                    {{ csrf_field() }}
                    
                    <!--Nombre-->
                    <div class="form-group has-feedback">
                        <label for="nombre" class="control-label">@lang('messages.nombre')</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control" data-minlength="3" maxlength="20" required>
                    </div>
                    <!--Descripcion-->
                    <div class="form-group has-feedback">
                        <label for="descripcion" class="control-label">@lang('messages.descripcion'):</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" rows="5" value="{{ old('descripcion') }}" data-minlength="3" maxlength="65535" required></textarea>
                    </div>
                    <!--Repositorio-->
                    <div class="form-group has-feedback">
                        <label for="repositorio" class="control-label">@lang('messages.repositorio'):</label>
                        <input type="repositorio" placeholder="https://github.com/nombreUsuario/nombreProyecto"name="repositorio" id="repositorio" class="form-control">
                    </div>
                    <!--Fecha inicio-->
                    <div class="form-group has-feedback">
                        <label for="message-text" class="control-label">@lang('messages.fecha de inicio'):</label>
                        <div class="form-group has-feedback">
                            <div class='input-group date has-feedback' id="datetimepicker6">
                                <input required name="fecha_inicio" id="fecha_inicio_input"  type='text' readonly class="form-control"  style="background-color: #fff; "/> <span class="input-group-addon">
                                    <span  id="datepicker_fecha_inicio"  class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                        
                    </div>
                    <!--Fecha fin estimada-->
                    <div class="form-group has-feedback">
                        <label for="message-text" class="control-label">@lang('messages.fecha estimada de fin'):</label>
                        <div class="form-group has-feedback">
                            <div class='input-group date has-feedback' id="datetimepicker6">
                                <input required name="fecha_fin_estimada" id="fecha_estimada_fin"  type='text' readonly class="form-control"  style="background-color: #fff; "/> <span class="input-group-addon">
                                    <span  id="datepicker_fecha_estimada_fin"  class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                        
                    </div>
                    <!--Boton-->
                    <div class="box-footer">
                        <input class="btn btn-primary btn-lg" type="submit" value="@lang('messages.crear')">
                    </div>
                </form>
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
    $('#datepicker_fecha_inicio').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
    startDate: $("#fecha_inicio_sprint").val()
    })
    .on('changeDate', function(e) {
        $("#fecha_inicio_input").val($("#datepicker_fecha_inicio").datepicker('getFormattedDate'));
        $("#datepicker_fecha_estimada_fin").datepicker('setStartDate', $('#datepicker_fecha_inicio').datepicker('getDate'));
    });
</script>
<script>
    $('#datepicker_fecha_estimada_fin').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
    startDate: $("#fecha_inicio_sprint").val()
    })
    .on('changeDate', function(e) {
        $("#fecha_estimada_fin").val($("#datepicker_fecha_estimada_fin").datepicker('getFormattedDate'));
    });
</script>
<script>
$(document).ready(function(){
   setTimeout(function(){
         $('#event-modal').fadeOut(400);
   },2000);
});
</script>
@endsection
