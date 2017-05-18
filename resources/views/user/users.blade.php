@extends('layouts.privada')

@section('content')

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="/adminlte/dist/js/pages/dashboard.js"></script>

    <!-- JS file -->
    <script src="/js/jquery.easy-autocomplete.min.js"></script> 

    <!-- CSS file -->
    <link rel="stylesheet" href="/css/easy-autocomplete.min.css"> 

    <!-- Additional CSS Themes file - not required-->
    <link rel="stylesheet" href="/css/easy-autocomplete.themes.min.css">



    <!-- Header -->
    <section class="content-header">
        <h1>Usuarios<small>Proyecto X</small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">UI</a></li>
            <li class="active">Timeline</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!--<div class="box-header">
                        <h3 class="box-title">Responsive Hover Table</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!-- /.box-header -->

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Foto de perfil</th>
                                <th>Usuario</th>
                                <th>Nombre y apellidos</th>
                                <th>Rol</th>
                                <th>Email</th>
                                <th>Opciones</th>
                            </tr>

                            @foreach ($proyecto_users as $proyecto_user)
                                <tr>
                                    <td><img src="/perfiles/{{ $proyecto_user->user->imagen }}" class="user-image" alt="User Image" width="25" height="25"></td>
                                    <td>{{ $proyecto_user->user->username }}</td>
                                    <td>{{ $proyecto_user->user->name . ' ' . $proyecto_user->user->apellidos }}</td>
                                    <td><span class="label {{ $proyecto_user->rol->label }}">{{ $proyecto_user->rol->nombre }}</span></td>
                                    <td>{{ $proyecto_user->user->email }}</td>
                                    <td>
                                        <i class="fa fa-fw fa-edit btn" data-toggle="modal" data-target="#exampleModalProyectoUser{{ $proyecto_user->user_id }}" style="color: blue"></i>
                                        <i id="deleteButton{{ $proyecto_user->user_id }}" class="fa fa-fw fa-trash-o btn" style="color: red"></i>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Añadir usuario</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form id="requisito_form_modificar" action="{{ url('proyectousercrear') }}" method="POST" role="form" data-toggle="validator">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input id="autocompleteUser" type="text" class="form-control modal-title" name="user_name" placeholder="Nombre">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <select name="rol_id" class="form-control">
                    <option value="Rol" disabled="disabled" selected>Rol</option>

                    @foreach ($rols as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-2">
              <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Invitar">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        </form>
      </div>
      <!-- /.box -->

<!-- Formulario modificación rol -->
@foreach ($proyecto_users as $proyecto_user)

<div class="modal fade" id="exampleModalProyectoUser{{ $proyecto_user->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="proyecto_user_form_modificar" action="{{ url('proyectouser/modificar') }}" method="POST" role="form" data-toggle="validator">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <label for="recipient-name" class="control-label">{{ $proyecto_user->user->name . ' ' . $proyecto_user->user->apellidos }}</label>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                    <input id="user_id" name="user_id" type="hidden" value="{{ $proyecto_user->user_id }}"/>
                    <div class="form-group">
                        <select id="rol_id" name="rol_id" class="form-control">
                            @foreach ($rols as $rol)
                                <br/>
                                @if ($proyecto_user->rol->nombre == $rol->nombre)
                                    <option value="{{ $rol->id }}" selected>{{ $proyecto_user->rol->nombre }}</option>
                                @else
                                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Modificar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach
<!-- FIN formulario modificación rol -->

    </section>

    <script>

        var options = {

        data: [

            @foreach ($users as $userRec)
                {name: {!! '"' !!}{{ $userRec->name . ' ' . $userRec->apellidos }}{!! '"' !!}, type: {!! '"' !!}{{ $userRec->email }}{!! '"' !!}},
            @endforeach
        ],

        getValue: "name",

        template: {
            type: "description",
            fields: {
                description: "type"
            }
        }

        };

        $("#autocompleteUser").easyAutocomplete(options);

    </script>

    <script>
        @foreach ($proyecto_users as $proyecto_user)

            $("#deleteButton{{ $proyecto_user->user_id }}").click(function() {

                swal({
                    title: "¿Estás seguro?",
                    text: "Vas a desvincular a {{ $proyecto_user->user->name . ' ' . $proyecto_user->user->apellidos }} del proyecto",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sí, adelante",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    allowOutsideClick: true
                },
                function(){
                    window.location.href = "{{ url('deleteproyectouser') . '/' . $proyecto_user->proyecto_id . '/' . $proyecto_user->user_id }}";
                });
            });

        @endforeach
</script>

@endsection