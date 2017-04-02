<body>
    @include('navbar')
    <form action="{{ url('requisito/modificar') }}" method="POST">
        {{ csrf_field() }}
        <label for="id">ID:</label>
        <br>
        <input type="text" name="id" id="id" value="{{ $requisito->id }}">
        <br>
        <br>
        <label for="nombre">Nombre:</label>
        <br>
        <input type="text" name="nombre" id="nombre" value="{{ $requisito->nombre }}">
        <br>
        <br>
        <label for="descripcion">Descripción:</label>
        <br>
        <input type="text" name="descripcion" id="descripcion" value="{{ $requisito->descripcion }}">
        <br>
        <br>
        <button type="submit">Modificar</button>
    </form>
    <a href="{{ url('requisito/borrar', $requisito->id) }}">Borrar</a>
</body>
