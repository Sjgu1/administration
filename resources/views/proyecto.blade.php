<body>
    @include('navbar')
    <form action="{{ url('proyecto/modificar') }}" method="POST">
        {{ csrf_field() }}
        <label for="id">ID:</label>
        <br>
        <input readonly="readonly" type="text" name="id" id="id" value="{{ $proyecto->id }}">
        <br>
        <br>
        <label for="nombre">Nombre:</label>
        <br>
        <input type="text" name="nombre" id="nombre" value="{{ $proyecto->nombre }}">
        <br>
        <br>
        <label for="descripcion">Descripción:</label>
        <br>
        <input type="text" name="descripcion" id="descripcion" value="{{ $proyecto->descripcion }}">
        <br>
        <br>
        <label for="descripcion">Repositorio:</label>
        <br>
        <label type="text" name="descripcion" id="descripcion" value="{{ $proyecto->repositorio }}">
        <br>
        <br>
        <label for="descripcion">Fecha de inicio:</label>
        <br>
        <label type="text" name="descripcion" id="descripcion" value="{{ $proyecto->fecha_inicio }}">
        <br>
        <br>
            <button class="btn btn-primary"type="submit">Modificar</button>
    </form>
    <input type="button" onClick="location.href='/proyecto/borrar/{{ $proyecto->id }}';" value="borrar" class="btn btn-primary" >
</body>
