<body>
    @include('navbar')
    <form action="{{ url('proyecto/create') }}" method="POST">
        {{ csrf_field() }}
        <label for="id">Nombre:</label>
        <br>
        <input type="text" name="nombre" id="nombre">
        <br>
        <br>
        <label for="descripcion">Descripción:</label>
        <br>
        <input type="text" name="descripcion" id="descripcion">
        <br>
        <br>
        <label for="repositorio">Repositorio:</label>
        <br>
        <input type="text" name="repositorio" id="repositorio">
        <br>
        <br>
        <label for="fecha_inicio">Fecha inicio:</label>
        <br>
        <input type="text" name="fecha_inicio" id="fecha_inicio">
        <br>
        <br>
        <label for="fecha_fin_estimada">Fecha fin estimada:</label>
        <br>
        <input type="text" name="fecha_fin_estimada" id="fecha_fin_estimada">
        <br>
        <br>
        <button type="submit">Crear</button>
     </form>
</body>