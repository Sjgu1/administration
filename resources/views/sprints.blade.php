<script type="text/javascript">
$(document).ready(function() {

    $('#sprints tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>
<body>
	@include('navbar')
	<form action="{{ url('sprints') }}" method="POST">
	 {{ csrf_field() }}
		<button type="submit">Filtrar</button>
	 	<select name="campoOrdenado">
  			<option value="id">ID</option>
  			<option value="nombre">NOMBRE</option>
            <option value="proyecto">PROYECTO</option>
		</select>
		<select name="tipoOrdenacion">
  			<option value="asc">Asc</option>
  			<option value="desc">Desc</option>
		</select>
		<table id="sprints" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>				
					<th>ID 
					@if($valorID == "")
						<input type="text" name="id" id="id" value=""></th>
					@else
						<input type="text" name="id" id="id" value={{$valorID}}></th>
					@endif
					<th>Nombre 
					@if($valorNombre == "")
					    <input type="text" name="nombre" id="nombre" value=""></th>
					@else
					    <input type="text" name="nombre" id="nombre" value={{$valorNombre}}></th>
					@endif
                    <th>Proyecto
                    @if($valorProyecto == "")
                        <input type="text" name="proyecto" id="proyecto" value=""></th>
                    @else
					    <input type="text" name="proyecto" id="proyecto" value={{$valorProyecto}}></th>
					@endif
					<th>Descripcion </th>					
					<th>Fecha de inicio </th>
				</tr>	
			</thead>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Proyecto </th>
					<th>Descripcion </th>					
					<th>Fecha de inicio </th>
				</tr>				
			</tfoot>
			<tbody>
				@foreach ($sprints as $sprint)
				<tr>
					<td><a href="sprint/{{ $sprint->id }}">{{ $sprint->id }}</a></td>
					<td>{{ $sprint->nombre }}</td>
                    <td>{{ $sprint->proyecto_id }}</td>
					<td>{{ $sprint->descripcion }}</td>					
					<td>{{ $sprint->fecha_inicio }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	{{ $sprints->links() }}
	</form>		
	<form action="{{ url('sprint/new') }}" method="GET">
	<button type="submit">Crear</button>	
	</button>
</body>
</html>