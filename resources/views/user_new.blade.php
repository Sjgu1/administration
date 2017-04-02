
    <body>
        @include('navbar')
        <form action="{{ url('user/create') }}" method="POST">
            {{ csrf_field() }}
            <label for="id">Nombre:</label>
            <br>
            <input type="text" name="nombre" id="nombre">
            <br>
            <br>
            <label for="descripcion">Apellidos:</label>
            <br>
            <input type="text" name="apellidos" id="apellidos">
            <br>
            <br>
            <label for="email">Email:</label>
            <br>
            <input type="text" name="email" id="email">
            <br>
            <br>
            <label for="username">Username:</label>
            <br>
            <input type="text" name="username" id="username">
            <br>
            <br>
            <label for="password">Password:</label>
            <br>
            <input type="password" name="password" id="password">
            <br>
            <br>
            <button type="submit">Crear</button>
        </form>
</body>