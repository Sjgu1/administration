<body>
    @include('navbar')
    <form action="{{ url('user/create') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="control-label">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="apellidos" class="control-label">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" class="form-control">
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email:</label>
            <input type="text" id="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="username" class="control-label">Username:</label>
            <input type="text" id="username" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        <button type="submit">Crear</button>
    </form>
</body>