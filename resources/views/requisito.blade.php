<body>
    @include('navbar')
    <form id="requisito_form" action="{{ url('requisito/modificar') }}" method="POST" role="form" data-toggle="validator">
        {{ csrf_field() }}
        <div class="form-group has-feedback">
            <label for="id" class="control-label">ID:</label>
            <input type="text" id="id" name="id" readonly="readonly" value="{{ $requisito->id }}" class="form-control">
        </div>
        <div class="form-group has-feedback">
            <label for="nombre" class="control-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $requisito->nombre }}" class="form-control" data-minlength="3" maxlength="20" required>
        </div>
        <div class="form-group has-feedback">
            <label for="sprint_id" class="control-label">Sprint:</label>
            <select id="sprint_id" name="sprint_id" class="form-control">

                <option value="{{ $requisito_sprint->id }}" selected disabled>{{ $requisito_sprint->proyecto->nombre . ' - ' . $requisito_sprint->nombre }}</option>

                @foreach ($proyectos as $proyecto)
                    @foreach ($proyecto->sprints as $sprint)
                        <option value="{{ $sprint->id }}">{{ $proyecto->nombre . ' - ' . $sprint->nombre }}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="form-group has-feedback">
            <label for="descripcion" class="control-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5" data-minlength="3" maxlength="65535" required>{{ $requisito->descripcion }}</textarea>
        </div>
        <br>
        <input type="submit" class="btn btn-block btn-lg btn-primary" value="Modificar">
    </form>
    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#myModal">Borrar</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Borrar requisito</h4>
        </div>
        <div class="modal-body">¿Estás seguro de que quieres borrar el requisito <b>{{ $requisito->nombre }}</b>?</div>
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

        $('#confirmacion').click(function(){
            window.location.href="/requisito/borrar/{{ $requisito->id }}";
        });

    });
    </script>
</body>
