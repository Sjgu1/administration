<body>
    @include('navbar')
    <form id="requisito_form" action="{{ url('requisito/create') }}" method="POST" role="form" data-toggle="validator">
        {{ csrf_field() }}
        <div class="form-group has-feedback">
            <label for="id" class="control-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" data-minlength="3" maxlength="20" required>
        </div>
        <div class="form-group has-feedback">
            <label for="sprint_id" class="control-label">Sprint:</label>
            <select id="sprint_id" name="sprint_id" class="form-control">
                <option value="" disabled>Proyecto - Sprint</option>
                @foreach ($proyectos as $proyecto)
                    @foreach ($proyecto->sprints as $sprint)
                        <option value="{{ $sprint->id }}">{{ $proyecto->nombre . ' - ' . $sprint->nombre }}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="form-group has-feedback">
            <label for="descripcion" class="control-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="5" data-minlength="3" maxlength="65535" required></textarea>
        </div>
        <br>
        <input type="submit" class="btn btn-block btn-lg btn-primary" value="Crear">
     </form>
</body>