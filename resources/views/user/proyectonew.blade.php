@extends('layouts.privada')
    
<body>
@section('content')
        <form id="proyecto_form" action="{{ url('proyecto/create') }}" method="POST" role="form" data-toggle="validator">
        {{ csrf_field() }}
        <!--<div class="form-group has-feedback">
            <label for="date" class="control-label">Date:</label>
            <div class="input-group">
                <input type="text" id="example1" class="form-control" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" required>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>-->
        <div class="form-group has-feedback">
            <label for="id" class="control-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control" data-minlength="3" maxlength="20" required>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback">
            <label for="descripcion" class="control-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5" value="{{ old('descripcion') }}" data-minlength="3" maxlength="65535" required></textarea>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback">
            <label for="repositorio" class="control-label">Repositorio:</label>
            <input type="text" id="repositorio" name="repositorio" class="form-control" value="{{ old('repositorio') }}" pattern="((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback">
            <label for="fecha_inicio" class="control-label">Fecha inicio:</label>
            <div class="input-group">
                <input type="text" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" placeholder="dd/MM/YY" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" required>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="fecha_fin_estimada" class="control-label">Fecha fin estimada:</label>
            <div class="input-group">
                <input type="text" id="fecha_fin_estimada" name="fecha_fin_estimada" class="form-control" value="{{ old('fecha_fin_estimada') }}" placeholder="dd/MM/YY" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" required>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <br>
        <input type="submit" class="btn btn-block btn-lg btn-primary" value="Crear">
     </form>
    <script>
    // When the document is ready
    $(document).ready(function () {

        $('#fecha_inicio').datepicker({
            autoclose: true,
            format: "dd/mm/yyyy"
        });

        $('#fecha_fin_estimada').datepicker({
            autoclose: true,
            format: "dd/mm/yyyy"
        });

    });
    </script>
@endsection
</body>