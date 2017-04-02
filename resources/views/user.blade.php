<body>
    @include('navbar')
    <form action="{{ url('user/modificar') }}" method="POST">
        {{ csrf_field() }}
        <label for="id">ID:</label>
        <br>
        <input readonly="readonly" type="text" name="id" id="id" value="{{ $user->id }}">
        <br>
        <br>
        <label for="nombre">Nombre:</label>
        <br>
        <input type="text" name="nombre" id="nombre" value="{{ $user->nombre }}">
        <br>
        <br>
        <label for="apellidos">Apellidos:</label>
        <br>
        <input  type="text" name="apellidos" id="apellidos" value="{{ $user->apellidos }}">
        <br>
        <br>
        <label for="email">Email:</label>
        <br>
        <input type="text" name="email" id="email" value="{{ $user->email }}">
        <br>
        <br>
        <label for="username">Username:</label>
        <br>
        <input type="text" name="username" id="username" value="{{ $user->username }}">
        <br>
        <br>
            <button class="btn btn-primary"type="submit">Modificar</button>
    </form>
    <input type="button" onClick="location.href='/user/borrar/{{ $user->id }}';" value="borrar" class="btn btn-primary" >
</body>
