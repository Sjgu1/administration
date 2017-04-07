<body>
    @include('navbar')
    <form id="user_form" action="{{ url('user/modificar') }}" method="POST" role="form" data-toggle="validator">
        {{ csrf_field() }}
        <div class="form-group has-feedback">
            <label for="id" class="control-label">ID:</label>
            <input readonly="readonly" type="text" id="id" name="id" value="{{ $user->id }}" class="form-control">
        </div>
        <div class="form-group has-feedback">
            <label for="nombre" class="control-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $user->nombre }}" class="form-control" data-minlength="3" maxlength="20" required>
        </div>
        <div class="form-group has-feedback">
            <label for="apellidos" class="control-label">Apellidos:</label>
            <input  type="text" id="apellidos" name="apellidos" value="{{ $user->apellidos }}" class="form-control" data-minlength="3" maxlength="50" required>
        </div>
        <div class="form-group has-feedback">
            <label for="email" class="control-label">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" data-minlength="3" maxlength="50" required>
        </div>
        <div class="form-group has-feedback">
            <label for="username" class="control-label">Username:</label>
            <input type="text" id="username" name="username" value="{{ $user->username }}" class="form-control" data-minlength="3" maxlength="20" required>
        </div>
        <br>
        <br>
        <input class="btn btn-primary btn-block btn-lg" type="submit" value="Modificar">
    </form>

    <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#myModal">Borrar</button>
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Borrar usuario</h4>
        </div>
        <div class="modal-body">¿Estás seguro de que quieres borrar el usuario <b>{{ $user->nombre . ' ' . $user->apellidos}}</b>?</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" id="confirmacion" class="btn btn-primary">Borrar</button>
        </div>
        </div>
    </div>
    </div>
    <!-- // Fin modal -->
    <script>
        $('#confirmacion').click(function(){
            window.location.href="/user/borrar/{{ $user->id }}";
        })
    </script>
</body>
