<script type="text/javascript">
$(document).ready(function() {

    $('#requisitos tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>
<body>
	@include('navbar')
	<form action="{{ url('requisitos') }}" method="POST">
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
				@foreach ($requisitos as $requisito)
				<tr>
					<!--<td><a href="requisitos/{{ $requisito->id }}">{{ $requisito->id }}</a></td>-->
					<td><a href="requisito/{{ $requisito->id }}">{{ $requisito->nombre }}</a></td>
					<td>{{ $requisito->descripcion }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	{{ $requisitos->links() }}
	</form>
	<hr>
</body>
</html>