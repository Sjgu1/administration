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
					<!--<th>ID 
					@if($valorID == "")
						<!--<input type="text" name="id" id="id" value=""></th>-->
					@else
						<!--<input type="text" name="id" id="id" value={{$valorID}}></th>-->
					@endif
					<th>Proyecto 
					@if($valorNombre == "")
					<!--<input type="text" name="nombre" id="nombre" value=""></th>-->
					@else
					<input type="text" name="nombre" id="nombre" value={{$valorNombre}}></th>
					@endif
					<th>Usuario</th>
					<th>Rol</th>
				</tr>	
			</thead>
			<tbody>
				@foreach($proyectosusers as $proyectouser)
				<tr>
					<td><a href="www.google.com">{{ $proyectouser->proyecto->nombre }}</a></td>
					<td>{{ $proyectouser->user->nombre }}</td>
					<td>{{ $proyectouser->rol->nombre }}</td>
					<td></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	{{ $proyectosusers->links() }}
	</form>
	<hr>
	<p>Búsqueda avanzada</p>
	<!--<form action="{{ url('proyecto/new') }}" method="GET">
	<button type="submit">Crear</button>	
	</button>-->
</body>
</html>