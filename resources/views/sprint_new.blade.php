    <body>
        @include('navbar')
        <form id="sprint_form" action="{{ url('sprint/create') }}" method="POST" role="form" data-toggle="validator">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <label for="id" class="control-label">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="form-control" data-minlength="3" maxlength="20" required>
            </div>
            <div class="form-group has-feedback">
                <label for="descripcion" class="control-label">Descripción:</label>
                <textarea id="descripcion" name="descripcion" value="{{ old('descripcion') }}" class="form-control" rows="5" data-minlength="3" maxlength="65535" required></textarea>
            </div>
            <div class="form-group has-feedback">
                <label for="proyecto_id" class="control-label">Proyecto:</label>
                <select id="proyecto_id" name="proyecto_id" class="form-control">
                    @foreach ($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group has-feedback">
                <label for="fecha_inicio" class="control-label">Fecha inicio:</label>
                <div class="input-group">
                    <input type="text" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" class="form-control" placeholder="dd/MM/YY" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" required>
                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="fecha_fin_estimada" class="control-label">Fecha fin estimada:</label>
                <div class="input-group">
                    <input type="text" id="fecha_fin_estimada" name="fecha_fin_estimada" value="{{ old('fecha_fin_estimada') }}" class="form-control" placeholder="dd/MM/YY" pattern="[0-9]{2}/[0-9]{2}/[0-9]{4}" required>
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
</body>
