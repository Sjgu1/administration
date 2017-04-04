<body>
    @include('navbar')
    <form action="{{ url('rol/modificar') }}" method="POST">
    <input type="button" onClick="location.href='/rols';" value="Volver" class="btn btn-primary" >

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
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5">{{ $rol->descripcion }}</textarea>
       </div>
       <button type="submit" class="btn btn-primary">Modificar</button>
    </form>
    @foreach ($rol->permisos as $permiso)
        {{ $permiso->nombre }}
	@endforeach
    <input type="button" onClick="location.href='/rol/borrar/{{ $rol->id }}';" value="Borrar" class="btn btn-primary" >

</body>