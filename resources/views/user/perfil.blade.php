@extends('layouts.privada')
@section('cabecera')
@if(session()->has('message'))
    @if(session()->has('exito'))
    <div class="alert alert-success alert-dismissible" id="event-modal">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <h4><i class="icon fa fa-check"></i> Éxito!</h4>
      <p>{{ session()->get('message') }}</p>
    </div>
    @else
    <div class="alert alert-danger alert-dismissible" id="event-modal">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        <p>{{ session()->get('message') }}</p>
    </div>
    @endif
@endif
@endsection
@section('content')

    <section class="content-header">
      <h1>@lang('messages.perfil')<small>{{ $usuario->name }}</small></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col (LEFT) -->
        <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-body">
                <form id="user_form" action="{{ url('user/modificar') }}" method="POST" enctype="multipart/form-data" role="form" data-toggle="validator">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input readonly="readonly" type="hidden" id="id" name="id" value="{{ $user->id }}" class="form-control">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="name" class="control-label">@lang('messages.nombre'):</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" data-minlength="3" maxlength="20" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="apellidos" class="control-label">@lang('messages.apellidos'):</label>
                        <input  type="text" id="apellidos" name="apellidos" value="{{ $user->apellidos }}" class="form-control" data-minlength="3" maxlength="50" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="email" class="control-label">Email:</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" data-minlength="3" maxlength="50" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="username" class="control-label">@lang('messages.nombre de usuario'):</label>
                        <input type="text" id="username" name="username" value="{{ $user->username }}" class="form-control" data-minlength="3" maxlength="20" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="username" class="control-label">@lang('messages.contrasenya'):</label>
                        <input type="password" id="password1" name="password" value="" class="form-control" data-minlength="3" maxlength="20" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="username" class="control-label">@lang('messages.repetir contrasenya'):</label>
                        <input type="password" id="password2" name="password" value="" class="form-control" data-minlength="3" maxlength="20" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="username" class="control-label">@lang('messages.imagen de perfil'):</label>
                        <input type="file" id="imagen" name="imagen" value="">
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-primary btn-lg" type="submit" value="@lang('messages.modificar')">
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">@lang('messages.borrar usuario')</h4>
        </div>
        <div class="modal-body">@lang('messages.estas seguro?') <b>{{ $user->name . ' ' . $user->apellidos}}</b>?</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cerrar')</button>
            <button type="button" id="confirmacion" class="btn btn-primary">@lang('messages.borrar')</button>
        </div>
        </div>
    </div>
    </div>
    <!-- // Fin modal -->
    <script>
        $('#confirmacion').click(function(){
            window.location.href="/user/borrar/{{ $user->id }}";
        })
    </script>
    	<script>
$(document).ready(function(){
   setTimeout(function(){
         $('#event-modal').fadeOut(400);
   },2000);
});
</script>
@endsection