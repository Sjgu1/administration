<body>
    @include('navbar')
    <form action="{{ url('requisito/modificar') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" readonly="readonly" value="{{ $requisito->id }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $requisito->nombre }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5">{{ $requisito->descripcion }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Modificar</button>
    </form>
    <input type="button" onClick="location.href='/requisito/borrar/{{ $requisito->id }}';" value="borrar" class="btn btn-primary" >
</body>
