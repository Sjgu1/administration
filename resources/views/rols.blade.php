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
<body>
	@include('navbar')
	<form action="{{ url('rols') }}" method="POST">
	 {{ csrf_field() }}
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

			<tbody>
				@foreach ($rols as $rol)
				<tr>
					<!--<td><a href="rols/{{ $rol->id }}">{{ $rol->id }}</a></td>-->
					<td><a href="rol/{{ $rol->id }}">{{ $rol->nombre }}</a></td>
					<td>{{ $rol->descripcion }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	{{ $rols->links() }}
	</form>
	<hr>
</body>
</html>