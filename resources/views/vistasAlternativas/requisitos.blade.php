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
    <form action="{{url('requisitos')}}" method="POST">
    {{ csrf_field() }}
        <button type="submit">Filtrar</button>
        <select name="campoOrdenado">
            <option value="id">ID</option>
            <option value="nombre">NOMBRE</option>
        </select>
       <select name="tipoOrdenado">
            <option value="asc">Asc</option>
            <option value="desc">Desc</option>
        </select>
        <table id="requisitos" class="table table-striped table-bordered" cellspacing="0" width="100%">"
            <thead>
                <tr>
                    <th>Nombre
                    @if($valorNombre == "")
                    @else
                    <input type="text" name="nombre" id="nombre" value={{$valorNombre}}></th>
                    @endif
                    <th>Descripcion </th>
                </th>
            </thead>
            
            <tbody>
                @foreach ($requisitos as $requisito)
                <tr>
                    <td><a href="requisito/{{ $requisito->id }}"> {{ $requisito->nombre }}</a></td>
                    <td>{{ $requisito->descripcion }}</td>
                </tr>  
                @endforeach
            </tbody>
        </table>
    {{ $requisitos->links() }}
    </form>
    <p>mierda</p>
</body>
</html>