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
	<form action="{{ url('proyectos') }}" method="POST">
	 {{ csrf_field() }}
		<button type="submit">Filtrar</button>
		<table id="proyectos" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID <input type="text" name="id" id="id" ></th>
					<th>Nombre <input type="text" name="nombre" id="nombre"></th>
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
					<td>2011/04/25</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	{{ $proyectos->links() }}
	</form>			
</body>
</html>