<body>
    @include('navbar')
    <form action="{{ url('sprint/modificar') }}" method="POST">
        {{ csrf_field() }}
        <label for="id">ID:</label>
        <br>
        <input readonly="readonly" type="text" name="id" id="id" value="{{ $sprint->id }}">
        <br>
        <br>
        <label for="nombre">Nombre:</label>
        <br>
        <input type="text" name="nombre" id="nombre" value="{{ $sprint->nombre }}">
        <br>
        <br>
        <label for="nombre">Proyecto:</label>
        <br>
        <input  readonly="readonly" type="text" name="proyecto" id="proyecto" value="{{ $sprint->proyecto_id }}">
        <br>
        <br>
        <label for="descripcion">Descripción:</label>
        <br>
        <input type="text" name="descripcion" id="descripcion" value="{{ $sprint->descripcion }}">
        <br>
        <br>
        <label for="descripcion">Fecha de inicio:</label>
        <br>
        <label type="text" name="fecha_inicio" id="fecha_inicio" value="{{ $sprint->fecha_inicio }}">
        <br>
        <br>
            <button class="btn btn-primary"type="submit">Modificar</button>
    </form>
    <input type="button" onClick="location.href='/sprint/borrar/{{ $sprint->id }}';" value="borrar" class="btn btn-primary" >
</body>
