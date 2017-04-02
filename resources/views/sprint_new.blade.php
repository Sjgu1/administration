    <body>
        @include('navbar')
        <form action="{{ url('sprint/create') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="id">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="proyecto_id">Proyecto:</label>
                <select id="proyecto_id" name="proyecto_id" class="form-control">
                    @foreach ($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">Fecha inicio:</label>
                <input type="text" id="fecha_inicio" name="fecha_inicio" class="form-control">
            </div>
            <div class="form-group">
                <label for="fecha_fin_estimada">Fecha fin estimada:</label>
                <input type="text" id="fecha_fin_estimada" name="fecha_fin_estimada" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
</body>
