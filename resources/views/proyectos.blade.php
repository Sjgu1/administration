<!DOCTYPE html>
<html>
<head>


    <!-- Versión compilada y comprimida del CSS de Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
 
    <!-- Tema opcional -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
 
    <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	
	

	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js">
	</script>

	<script type="text/javascript" class="init">	
        $(document).ready(function() {
            $('#proyectos').DataTable();
        } );
    </script>
</head>
<body>
	<table id="proyectos" class="table table-striped table-bordered" cellspacing="0" width="100%">
    	<thead>
			<tr>
    			<th>ID</th>
        		<th>Nombre</th>
				<th>Descripcion</th>
				<th>Repositorio</th>
				<th>Fecha de inicio</th>
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
	</script>
</body>
</html>