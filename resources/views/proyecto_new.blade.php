<body>
    @include('navbar')
    <form action="{{ url('proyecto/create') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="id">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="repositorio">Repositorio:</label>
            <input type="text" id="repositorio" name="repositorio" class="form-control">
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