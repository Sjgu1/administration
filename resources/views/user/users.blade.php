@extends('layouts.privada')

@section('content')

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="/adminlte/dist/js/pages/dashboard.js"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="/js/typeahead-0.11.1.js"></script>

    <style type="text/css">

        .user-image {
            margin-left: 20%;
        }

    </style>

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
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control modal-title" name="nombre" placeholder="Nombre">
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-4">
              <div class="form-group">
                <select class="form-control">
                    <option value="Rol" disabled="disabled" selected>Rol</option>

                    @foreach ($rols as $rol)
                        <option value="{{ $rol->nombre }}">{{ $proyecto_user->rol->nombre }}</option>
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
      </div>
      <!-- /.box -->

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form id="user_form" action="{{ url('user/modificar') }}" method="POST" enctype="multipart/form-data" role="form" data-toggle="validator">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <input readonly="readonly" type="hidden" id="id" name="id" value="{{ $user->id }}" class="form-control">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="name" class="control-label">Usuario:</label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" data-minlength="3" maxlength="20" required>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="apellidos" class="control-label">Rol:</label>
                                <input  type="text" id="apellidos" name="apellidos" value="{{ $user->apellidos }}" class="form-control" data-minlength="3" maxlength="50" required>
                            </div>
                            <div class="box-footer">
                                <input class="btn btn-primary btn-lg" type="submit" value="Invitar">
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

<!-- Formulario modificación rol -->
@foreach ($proyecto_users as $proyecto_user)

<div class="modal fade" id="exampleModalProyectoUser{{ $proyecto_user->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="proyecto_user_form_modificar" action="{{ url('requisito/modificar') }}" method="POST" role="form" data-toggle="validator">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <label for="recipient-name" class="control-label">{{ $proyecto_user->user->name . ' ' . $proyecto_user->user->apellidos }}</label>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control">
                            @foreach ($rols as $rol)

                                @if ($proyecto_user->rol->nombre == $rol->nombre)
                                    <option value="{{ $rol->nombre }}" selected>{{ $proyecto_user->rol->nombre }}</option>
                                @else
                                    <option value="{{ $rol->nombre }}">{{ $rol->nombre }}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" >Cancelar</button>
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

        var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};

var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
  'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
  'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
  'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
  'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
  'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
  'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
  'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
  'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
];

$('#the-basics .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(states)
});
    
    </script>

    <script>
        @foreach ($proyecto_users as $proyecto_user)

            $("#deleteButton{{ $proyecto_user->user_id }}").click(function() {

                swal({
                    title: "Are you sure?",
                    text: "No podrás deshacer esta acción",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    allowOutsideClick: true
                },
                function(){
                    swal("Deleted!", "Your imaginary file has been deleted", "success");
                });
            });

        @endforeach
</script>

@endsection