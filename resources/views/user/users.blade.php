@extends('layouts.privada')

@section('content')

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
                                <th>Usuario</th>
                                <th>Nombre y apellidos</th>
                                <th>Rol</th>
                                <th>Email</th>
                            </tr>

                            @foreach ($proyecto_users as $proyecto_user)
                                <tr>
                                    <td>{{ $proyecto_user->user->username }}</td>
                                    <td>{{ $proyecto_user->user->name . ' ' . $proyecto_user->user->apellidos }}</td>
                                    <td><span class="label {{ $proyecto_user->rol->label }}">{{ $proyecto_user->rol->nombre }}</span></td>
                                    <td>{{ $proyecto_user->user->email }}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection