@include('navbar')
<script type="text/javascript">
$(document).ready(function() {

    $('#permisos tr').click(function() {
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
            $('#permisos').DataTable();
        } );
    </script>
</head>
<body>

	<table id="permisos" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
			<tr>
        		<th>Nombre</th>
				<th>Descripción</th>
			</tr>
		</thead>
		<tbody>
            @foreach ($permisos as $permiso)
			<tr>
				<td><a href="permiso/{{ $permiso->id }}">{{ $permiso->nombre }}</a></td>
    			<td>{{ $permiso->descripcion }}</td>
			</tr>
            @endforeach
		</tbody>
    </table>					
	</script>
</body>