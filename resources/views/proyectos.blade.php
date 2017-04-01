<!DOCTYPE html>
<html>
<head>


    <!-- Versión compilada y comprimida del CSS de Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
 
    <!-- Tema opcional -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
 
    <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	
	
</head>
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
					<th>Fecha de inicio </th>
				</tr>	
			</thead>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th>Repositorio</th>
					<th>Fecha de inicio</th>
				</tr>				
			</tfoot>
			<tbody>
				@foreach ($proyectos as $proyecto)
				<tr>
					<td>{{ $proyecto->id }}</td>
					<td>{{ $proyecto->nombre }}</td>
					<td>{{ $proyecto->descripcion }}</td>
					<td>{{ $proyecto->repositorio }}</td>
					<td>{{ $proyecto->fecha_inicio }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	{{ $proyectos->links() }}
	</form>			
</body>
</html>