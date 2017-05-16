@extends('layouts.privada')
<body>
@section('content')
<section class="content-header">
      <h1>Nuevo Proyecto</h1>
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
                        <input type="repositorio" name="repositorio" id="repositorio" class="form-control">
                    </div>
                    <!--Fecha inicio-->
                    <div class="form-group has-feedback">
                        <label for="message-text" class="control-label">@lang('messages.fecha de inicio'):</label>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker6'>
                                <input type='text' class="form-control" name="fecha_inicio" id="fecha_inicio" />
                                <span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <script>
                            $('#datetimepicker6').datetimepicker({
                                format: "DD/MM/YYYY"
                            });
                        </script>
                    </div>
                    <!--Fecha fin estimada-->
                    <div class="form-group has-feedback">
                        <label for="message-text" class="control-label">@lang('messages.fecha estimada de fin'):</label>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker7'>
                                <input type='text' class="form-control" name="fecha_fin_estimada" id="fecha_fin_estimada" />
                                <span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <script>
                            $('#datetimepicker7').datetimepicker({
                                format: "DD/MM/YYYY"
                            });
                        </script>
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
@endsection
