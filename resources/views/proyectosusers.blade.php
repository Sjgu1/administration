@extends('layouts.privada')
<script type="text/javascript">
$(document).ready(function() {

    $('#proyectos tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>
<body>
	@section('content')
		<table id="proyectos" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>				
					<!--<th>ID 
					@if($valorID == "")
						<!--<input type="text" name="id" id="id" value=""></th>-->
					@else
						<!--<input type="text" name="id" id="id" value={{$valorID}}></th>-->
					@endif
					<th>Proyecto 
					@if($valorNombre == "")
					<!--<input type="text" name="nombre" id="nombre" value=""></th>-->
					@else
					<input type="text" name="nombre" id="nombre" value={{$valorNombre}}></th>
					@endif
					<th>Rol</th>
				</tr>	
			</thead>
			<tbody>
				@foreach($proyectosusers as $proyectouser)
				<tr>
					<td><a href="/proyectosusers" >{{ $proyectouser->proyecto->nombre }}</a></td>
					<td>{{ $proyectouser->rol->nombre }}</td>
					<td></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	{{ $proyectosusers->links() }}
	</form>
	<hr>
	<!--<form action="{{ url('proyecto/new') }}" method="GET">
	<button type="submit">Crear</button>	
	</button>-->
@endsection
</body>
