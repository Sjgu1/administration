<body>
    @include('navbar')
    <form id="proyecto_form" action="{{ url('proyecto/modificar') }}" method="POST" role="form" data-toggle="validator">
        {{ csrf_field() }}
        <div class="form-group has-feedback">
            <label for="id" class="control-label">ID:</label>
            <input type="text" id="id" name="id" readonly="readonly" value="{{ $proyecto->id }}" class="form-control">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback">
            <label for="nombre" class="control-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $proyecto->nombre }}" class="form-control" data-minlength="3" maxlength="20" required>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback">
            <label for="descripcion" class="control-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5" data-minlength="3" maxlength="65535" required>{{ $proyecto->descripcion }}</textarea>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback">
            <label for="repositorio" class="control-label">Repositorio:</label>
            <input type="text" id="repositorio" name="repositorio" value="{{ $proyecto->repositorio }}" class="form-control" pattern="((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)">
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div>
        <div class="form-group has-feedback">
            <label for="fecha_inicio" class="control-label">Fecha de inicio:</label>
            <div class="input-group">
                <input type="text" id="fecha_inicio" name="fecha_inicio" value="{{ $proyecto->fecha_inicio }}" class="form-control" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" required>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="fecha_fin_estimada" class="control-label">Fecha de fin estimada:</label>
            <div class="input-group">
                <input type="text" id="fecha_fin_estimada" name="fecha_fin_estimada" value="{{ $proyecto->fecha_fin_estimada }}" class="form-control" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" required>
                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
        </div>
        <br>
        <input type="submit" class="btn btn-block btn-primary btn-lg" value="Modificar">
    </form>
    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#myModal">Borrar</button>
    <br>
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Borrar proyecto</h4>
        </div>
        <div class="modal-body">¿Estás seguro de que quieres borrar el proyecto <b>{{ $proyecto->nombre }}</b>?</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" id="confirmacion" class="btn btn-primary">Borrar</button>
        </div>
        </div>
    </div>
    </div>
    <!-- // Fin modal -->

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

        $('#confirmacion').click(function(){
            window.location.href="/proyecto/borrar/{{ $proyecto->id }}";
        })

    });
    </script>
</body>
