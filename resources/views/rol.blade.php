<body>
    @include('navbar')
    <form action="{{ url('rol/modificar') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" readonly="readonly" value="{{ $rol->id }}" class="form-control">
        </div>
        <div class="form-group">
            <lavel for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $rol->nombre }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" value="{{ $rol->descripcion }}" class="form-control">
       </div>
       <button type="submit" class="btn btn-primary">Modificar</button>
    </form>
    <input type="button" onClick="location.href='/rol/borrar/{{ $rol->id }}';" value="borrar" class="btn btn-primary" >
</body>
