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
            $('#users').DataTable();
        } );
    </script>
</head>
<body>
	<table id="users" class="table table-striped table-bordered" cellspacing="0" width="100%">
    	<thead>
			<tr>
    			<th>ID</th>
        		<th>Nombre</th>
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
				<td>{{ $user->id }}</td>
				<td>{{ $user->nombre }}</td>
                <td>{{ $user->apellidos }}</td>
    			<td>{{ $user->email }}</td>
				<td>{{ $user->username }}</td>
				<td>{{ $user->fecha_registro }}</td>
			</tr>
            @endforeach
		</tbody>
    </table>					
	</script>
</body>
</html>