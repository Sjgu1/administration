@include('navbar')
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

	<table id="users" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
			<tr>
        		<th>Nombre</th>
				<th>Apellidos</th>
                <th>Email</th>
				<th>Username</th>
				<th>Fecha de registro</th>
			</tr>
		</thead>
		<tbody>
            @foreach ($users as $user)
			<tr>
				<td><a href="user/{{ $user->id }}">{{ $user->name }}</a></td>
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