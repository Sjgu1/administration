<script type="text/javascript">
$(document).ready(function() {

    $('#users tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>
<body>
	@include('navbar')
	<form action="{{ url('users') }}" method="POST">
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
		<table id="users" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre 
					@if($valorNombre == "")
					<input type="text" name="nombre" id="nombre" value=""></th>
					@else
					<input type="text" name="nombre" id="nombre" value={{$valorNombre}}></th>
					@endif
					<th>Apellidos</th>
					<th>Email</th>
					<th>Username</th>
					<th>Fecha registro</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Email</th>
					<th>Username</th>
					<th>Fecha registro</th>
				</tr>
			</tfoot>
			<tbody>
				@foreach ($users as $user)
				<tr>
					<td><a href="user/{{ $user->id }}">{{ $user->id }}</a></td>
					<td>{{ $user->nombre }}</td>
					<td>{{ $user->apellidos }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->username }}</td>
					<td>{{ $user->fecha_registro }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $users->links() }}
	</form>	
	<form action="{{ url('user/new') }}" method="GET">
	<button type="submit">Crear</button>	
	</button>					
	</script>
</body>