<body>
    @include('navbar')
    <form action="{{ url('rol/create') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="id">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
     </form>
</body>