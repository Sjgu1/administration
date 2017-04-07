<body>
    @include('navbar')
    <form id="rol_form" action="{{ url('rol/create') }}" method="POST" role="form" data-toggle="validator">
        {{ csrf_field() }}
        <div class="form-group has-feedback">
            <label for="id" class="control-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" data-minlength="3" maxlength="20" required>
        </div>
        <div class="form-group has-feedback">
            <label for="descripcion" class="control-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5" data-minlength="3" maxlength="65535" required></textarea>
        </div>
        <br>
        <input type="submit" class="btn btn-block btn-lg btn-primary" value="Crear">
     </form>
</body>