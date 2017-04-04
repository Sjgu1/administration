@include('navbar')
<script type="text/javascript">
$(document).ready(function() {

    $('#rols tr').click(function() {
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
            $('#rols').DataTable();
        } );
    </script>
</head>
<body>
<<<<<<< HEAD
	@include('navbar')
	<form action="{{ url('rols') }}" method="POST">
	 {{ csrf_field() }}
	 <button type="submit">Filtrar</button>
		<table id="rols" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>				
					<!--<th>ID 
					@if($valorID == "")
						<!--<input type="text" name="id" id="id" value=""></th>-->
					@else
						<!--<input type="text" name="id" id="id" value={{$valorID}}></th>-->
					@endif
					<th>Nombre 
					@if($valorNombre == "")
					<!--<input type="text" name="nombre" id="nombre" value=""></th>-->
					@else
					<input type="text" name="nombre" id="nombre" value={{$valorNombre}}></th>
					@endif
					<th>Descripcion </th>
				</tr>	
			</thead>
=======
>>>>>>> 638f49781399502aaf06136640ebc13a2dc35f54

	<table id="rols" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
			<tr>
        		<th>Nombre</th>
				<th>Descripción</th>
                <th>Permiso</th>
			</tr>
		</thead>
		<tbody>
            @foreach ($rols as $rol)
			<tr>
				<td><a href="rol/{{ $rol->id }}">{{ $rol->nombre }}</a></td>
    			<td>{{ $rol->apellidos }}</td>
                <td>
                @foreach ($rol->permisos as $permiso)
				    <a href="permiso/{{ $permiso->id }}">{{ $permiso->nombre }}</a>
                @endforeach
                </td>
			</tr>
            @endforeach
		</tbody>
    </table>					
	</script>
</body>
