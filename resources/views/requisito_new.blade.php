<body>
    @include('navbar')
    <form action="{{ url('requisito/create') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="id">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label for="sprint_id">Sprint:</label>
            <select id="sprint_id" name="sprint_id" class="form-control">
                <option value="" disabled>Proyecto - Sprint</option>
                @foreach ($proyectos as $proyecto)
                    @foreach ($proyecto->sprints as $sprint)
                        <option value="{{ $sprint->id }}">{{ $proyecto->nombre . ' - ' . $sprint->nombre }}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
     </form>
</body>