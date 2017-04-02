<body>
    @include('navbar')
    <form action="{{ url('proyecto/modificar') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" readonly="readonly" value="{{ $proyecto->id }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $proyecto->nombre }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5">{{ $proyecto->descripcion }}</textarea>
        </div>
        <div class="form-group">
            <label for="descripcion">Repositorio:</label>
            <input type="text" id="repositorio" name="repositorio" value="{{ $proyecto->repositorio }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Fecha de inicio:</label>
            <input type="text" id="fecha_inicio" name="fecha_inicio" value="{{ $proyecto->fecha_inicio }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Modificar</button>
    </form>
    <input type="button" onClick="location.href='/proyecto/borrar/{{ $proyecto->id }}';" value="borrar" class="btn btn-primary" >
</body>
