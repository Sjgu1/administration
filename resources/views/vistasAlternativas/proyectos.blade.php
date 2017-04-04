<!-- Esta vista se utiliza con las funciones propias de filtrado y ordenado, 
se tienen que colocar en la carpeta views, comentar las funciones del controlador
correspondiente y descomentar las funciones alternativas -->

<script type="text/javascript">
$(document).ready(function() {

    $('#proyectos tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>
<body>
	@include('navbar')
	<form action="{{ url('proyectos') }}" method="POST">
	 {{ csrf_field() }}
		<button type="submit">Filtrar</button>
	 	<select name="campoOrdenado">
  			<option value="id">ID</option>
  			<option value="nombre">NOMBRE</option>
		</select>
		<select name="tipoOrdenacion">
  			<option value="asc">Asc</option>
  			<option value="desc">Desc</option>
		</select>
		<table id="proyectos" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
					<th>Descripcion </th>
					<th>Repositorio </th>
					<th>Fecha inicio </th>
				</tr>	
			</thead>
			<tbody>
				@foreach ($proyectos as $proyecto)
				<tr>
					<td><a href="proyecto/{{ $proyecto->id }}">{{ $proyecto->id }}</a></td>
					<td><a href="proyecto/{{ $proyecto->id }}">{{ $proyecto->nombre }}</a></td>
					<td>{{ $proyecto->descripcion }}</td>
					<td><a href="{{ $proyecto->repositorio }}">{{ $proyecto->repositorio }}</a></td>
					<td>{{ $proyecto->fecha_inicio }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	{{ $proyectos->links() }}
	</form>
	<hr>
	<p>Búsqueda avanzada</p>
	<div>
	<select name="campoOrdenado">
  			<option value="nombre">Nombre</option>
  			<option value="descripcion">Descripción</option>
			<option value="descripcion">Repositorio</option>
			<option value="descripcion">Fecha de inicio</option>
		</select>

	</div>
	<form action="{{ url('proyecto/new') }}" method="GET">
	<button type="submit">Crear</button>	
	</button>
</body>
</html>