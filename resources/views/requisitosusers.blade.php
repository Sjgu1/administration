@extends('layouts.privada')
<script type="text/javascript">
$(document).ready(function() {

    $('#requistos tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
    </script>

<body>
	@section('content')

	<table id="requisitos" class="table table-striped table-bordered display" cellspacing="0" width="100%">
    	<thead>
			<tr>
				<th>Nombre</th>
			</tr>
		</thead>
		<tbody>
            @foreach ($requisitosusers as $requisitouser)
			<tr>
				<td><a href="/requisitosusers">{{ $requisitouser->nombre }}</a></td>
				<!--td>{{ $requisitouser->descripcion}}</td-->
    			<td>{{ $requisitouser->sprint }}</td>
			</tr>
            @endforeach
		</tbody>
    </table>					
	</script>
	@endsection
</body>
