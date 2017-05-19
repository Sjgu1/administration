@extends('layouts.privada')
@section('content')
<script src="/adminlte/colores.js"></script>
<script type="text/javascript">
    function update(jscolor, id) {
        document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).style.backgroundColor = '#' + jscolor;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log("aqui llego");
        $.post("/requisitoUsuario/colores", {
            columna: document.getElementById('cambiarColor').getAttribute('value'),
            color: document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).style.backgroundColor = '#' + jscolor,
            cambiar: "fondo",
            sprint_id: id
        });

    }
</script>
<script type="text/javascript">
    function updateTexto(jscolor, id) {
        document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).style.color = '#' + jscolor;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post("/requisitoUsuario/colores", {
            columna: document.getElementById('cambiarColor').getAttribute('value'),
            color: document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).style.color = '#' + jscolor,
            cambiar: "texto",
            sprint_id: id
        });

    }
</script>

<script type="text/javascript">
    function updateRequisitoColor(jscolor, id) {
        //document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).css.backgroundTopColor = '#' + jscolor;
        document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).style.borderTopColor = '#' + jscolor;
        // $('document.getElementById(document.getElementById('cambiarColor').getAttribute('value'))')

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post("/requisitoUsuario/colorRequisito", {
            color: document.getElementById(document.getElementById('cambiarColor').getAttribute('value')).style.color = '#' + jscolor,
            requisito_id: id
        });
    }
</script>
<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(data, nuevoEstado) {
        console.log("paso por drop y muestro " + data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post("/pizarra", {
            id: data,
            estado: nuevoEstado
        });

    }

    function cambiarColor(recibido) {
        var a = document.getElementById('cambiarColor');
        a.setAttribute('value', recibido);
        console.log(recibido);
    }
</script>
<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    })
</script>

<input id="cambiarColor" style="display:none;" value="columna1">
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/adminlte/dist/js/pages/dashboard.js"></script>

<section class="content-header">
    <h1>{{$proyecto->nombre}}
            <small>{{$sprint->nombre}} 
                <a href="#" data-toggle="collapse" data-target="#selectorColores" ><i class="fa fa-gears"></i></a>
            </small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> @lang('messages.inicio')</a></li>
            <li><a href="#">UI</a></li>
            <li class="active">@lang('messages.actividad')</li>
        </ol>

</section>
<div class="content">
    <div class="content">
        <div class="row">

            <div class="col-md-12 container">
                <div class="collapse fade" id="selectorColores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="col-md-12 well-sm">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('messages.ajustes de diseño')</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#selectorColores"><i class="fa fa-remove"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" onchange="cambiarColor(this.value);">
                                                <option value="columna1">@lang('messages.por hacer')</option>
                                                <option value="columna2">@lang('messages.en tramite')</option>
                                                <option value="columna3">@lang('messages.hecho')</option>
                                            </select>
                                        </div>
                                    </div>
                                        <!-- /.col -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>@lang('messages.color del fondo')</label>
                                                <input class="jscolor" onchange="update(this.jscolor, {{$sprint->id}})">
                                                <br/>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>@lang('messages.color del texto')</label>
                                                <input class="jscolor" onchange="updateTexto(this.jscolor,{{$sprint->id}})">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    
                                    <!-- /.row -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-12 box box-primary well-sm" id="columna1" style="background-color:{{$sprint->color1}}; color:{{$sprint->colorTexto1}};">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('messages.por hacer')</h3>
                        <span class=" pull-right glyphicon glyphicon-plus" data-toggle="modal" data-target="#crearRequisito" style="cursor: pointer; cursor: hand;">
                </span>
                    </div>
                    <div id="accordion1" class="connectedSortable box-body">
                        @foreach ($requisitos as $requisito ) @if ($requisito->estado == 'Por hacer')
                        <div class="panel box box-primary" style="border-top-width:7px; border-top-color:{{$requisito->color}}" id="modal{{$requisito->id}}" onclick="cambiarColor(modal{{$requisito->id}}.id)">
                            <div class="box-header with-border" id="{{$requisito->id}}">
                                <h4 class="box-title">
                                    <a  data-toggle="collapse" data-parent="#accordion1" href="#desplegar{{$requisito->id}}" aria-expanded="false" class="collapsed"> {{$requisito->nombre}} </a>
                                </h4>
                                <i class="fa fa-fw fa-edit pull-right btn " class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$requisito->id}}"></i>
                            </div>
                            <div id="desplegar{{$requisito->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div style="color:#000" class="box-body">
                                    {{$requisito->descripcion}}
                                </div>
                            </div>
                        </div>
                        <script>
                            $("#{{$requisito->id}}").sortable({
                                connectWith: "connectedSortable",
                                forcePlaceholderSize: true,
                                opacity: 0.5
                            });
                        </script>
                        @endif @endforeach
                    </div>
                    <script>
                        $('#accordion1').on("sortreceive", function(event, ui) {
                            // console.log(ui);
                            drop(ui.item["0"].firstElementChild.id, 'Por hacer');

                        });
                    </script>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-md-12 box box-primary well-sm" id="columna2" style="background-color:{{$sprint->color2}}; color:{{$sprint->colorTexto2}};">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('messages.en tramite') 
            </h3>
                    </div>
                    <div id="accordion2" class="connectedSortable box-body">
                        @foreach ($requisitos as $requisito ) @if ($requisito->estado == 'En trámite')
                        <div class="panel box box-primary" style="border-top-width:7px; border-top-color:{{$requisito->color}}" id="modal{{$requisito->id}}" onclick="cambiarColor(modal{{$requisito->id}}.id)">
                            <div class="box-header with-border" id="{{$requisito->id}}">
                                <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion2" href="#desplegar{{$requisito->id}}" aria-expanded="false" class="collapsed"> {{$requisito->nombre}} </a>
                            </h4>
                                <i class="fa fa-fw fa-edit pull-right btn " class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$requisito->id}}"></i>

                            </div>
                            <div id="desplegar{{$requisito->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div style="color:#000" class="box-body">
                                    {{$requisito->descripcion}}
                                </div>
                            </div>
                        </div>
                        <script>
                            $("#{{$requisito->id}}").sortable({
                                connectWith: "connectedSortable",
                                forcePlaceholderSize: true,
                                opacity: 0.5
                            });
                        </script>
                        @endif @endforeach
                    </div>
                    <script>
                        $('#accordion2').on("sortreceive", function(event, ui) {

                            drop(ui.item["0"].firstElementChild.id, 'En trámite');
                        });
                    </script>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-md-12 box box-primary well-sm" id="columna3" style="background-color:{{$sprint->color3}}; color:{{$sprint->colorTexto3}};">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('messages.hecho')
            </h3>
                    </div>
                    <div id="accordion3" class="connectedSortable box-body">
                        @foreach ($requisitos as $requisito ) @if ($requisito->estado == 'Hecho')
                        <div class="panel box box-primary" style="border-top-width:7px; border-top-color:{{$requisito->color}}" id="modal{{$requisito->id}}" onclick="cambiarColor(modal{{$requisito->id}}.id)">
                            <div class="box-header with-border" id="{{$requisito->id}}">
                                <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion3" href="#desplegar{{$requisito->id}}" aria-expanded="false" class="collapsed"> {{$requisito->nombre}} </a>
                            </h4>
                                <i class="fa fa-fw fa-edit pull-right btn " class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$requisito->id}}"></i>
                            </div>
                            <div id="desplegar{{$requisito->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div style="color:#000" class="box-body">
                                    {{$requisito->descripcion}}
                                </div>
                            </div>
                        </div>
                        <script>
                            $("#{{$requisito->id}}").sortable({
                                connectWith: "connectedSortable",
                                forcePlaceholderSize: true,
                                opacity: 0.5
                            });
                        </script>
                        @endif @endforeach
                    </div>
                    <script>
                        $('#accordion3').on("sortreceive", function(event, ui) {
                            drop(ui.item["0"].firstElementChild.id, 'Hecho');
                        });
                    </script>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="modal fade" id="crearRequisito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="requisito_form" action="{{ url('requisito/create') }}" method="POST" role="form" data-toggle="validator">
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-header form-group has-feedback">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <label for="message-text" class="control-label">@lang('messages.tarea'):</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" data-minlength="3" maxlength="20" required>
                        </div>
                        <div class="modal-body">
                            <div class="form-group has-feedback">
                                <label for="descripcion" class="control-label">@lang('messages.descripcion'):</label>
                                <textarea id="descripcion" name="descripcion" class="form-control" rows="5" data-minlength="3" maxlength="65535" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">@lang('messages.P-S'):</label>
                                <br/>
                                <input type="hidden" name="sprint_id" value="{{$sprint->id }}" /> {{ $proyecto->nombre . ' - ' . $sprint->nombre }}
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">@lang('messages.fecha estimada de fin'):</label>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker6'>
                                        <input type='text' class="form-control" name="fecha_estimada_fin" id="fecha_estimada_fin" />
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <script>
                                    $('#datetimepicker6').datetimepicker({
                                        format: "DD/MM/YYYY"
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cerrar')</button>
                            <button type="submit" class="btn btn-primary">@lang('messages.guardar')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach ($requisitos as $requisito )

        <div class="modal fade" id="exampleModal{{$requisito->
   id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="requisito_form_modificar" action="{{ url('requisito/modificar') }}" method="POST" role="form" data-toggle="validator">
                        <input type="hidden" name="sprint_id" value="{{$sprint->id }}" />
                        <input type="hidden" name="id" value="{{$requisito->id }}" />
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <input type="hidden" name="estado" value="{{$requisito->estado }}" />
                        <div class="modal-header form-group has-feedback">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <label for="recipient-name" class="control-label">@lang('messages.nombre'):</label>
                            <input type="text" class="form-control modal-title" name="nombre" value="{{$requisito->nombre}}"  data-minlength="3" maxlength="20" required>
                        </div>
                        <div class="modal-body">
                            <div class="form-group  has-feedback">
                                <label for="descripcion" class="control-label">@lang('messages.descripcion'):</label>
                                <textarea id="descripcion" name="descripcion" class="form-control" rows="5" data-minlength="3" maxlength="65535" required>{{ $requisito->descripcion }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class=" col-md-6 form-group">
                                        <label for="message-text" class="control-label">@lang('messages.fecha estimada de inicio'):</label>
                                        <div class="form-group">
                                            <div class='input-group date'>
                                                <input type='text' class="form-control" value="{{$requisito->fecha_inicio}}" disabled /> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="message-text" class="control-label">@lang('messages.fecha estimada de fin'):</label>

                                        <div class="form-group">
                                            <div class='input-group date' id='fecha_fin_{{$requisito->id}}'>
                                                <input type='text' class="form-control" name="fecha_estimada_fin" value="{{$requisito->fecha_fin_estimada}}" /> <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class=" col-md-6 ">
                                            <div class="form-group">
                                                <div <div class='input-group'>
                                                    <label style="color:#000">@lang('messages.color de la tarjeta'):
                                                        <input style="z-index:2;" class="jscolor btn-xs btn-info" onchange="updateRequisitoColor(this.jscolor,{{$requisito->id}})">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $('#fecha_fin_{{$requisito->id}}').datetimepicker({
                                            format: "DD/MM/YYYY"
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="well">
                                @lang('messages.usuarios asignados ahora'):
                                <br> @foreach($usuarios as $usuario) @foreach($requisitosAsignados as $reqAsig ) @if($requisito->id == $reqAsig->requisito->id) @if($usuario->user->id == $reqAsig->user->id )
                                <!--<option selected="selected" value="{{$usuario->user->id}}">{{$usuario->user->name}}</option>-->
                                <label value="{{$usuario->user->name}}">{{$usuario->user->name}}</label>
                                <br> @endif @endif @endforeach @endforeach
                                <br> @lang('messages.selecciona nuevos usuarios'):
                                <br/>
                                <select name="basic" id="ex-data-multiple-{{$requisito->id}}" multiple style="display: none;">
                                    @foreach($usuarios as $usuario)
                                    <option value="{{$usuario->user->id}}">{{$usuario->user->name}}</option>
                                    @endforeach
                                </select>
                                <script type="text/javascript">
                                    $('#ex-data-multiple-{{$requisito->id}}').picker();

                                    $('#ex-data-multiple-{{$requisito->id}}').on('sp-change', function() {
                                        console.log($('#ex-data-multiple-{{$requisito->id}}'));

                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        var array = [];
                                        for (var i = 0; i < $('#ex-data-multiple-{{$requisito->id}}')["0"].selectedOptions.length; i++) {

                                            array.push($('#ex-data-multiple-{{$requisito->id}}')["0"].selectedOptions[i].value);
                                        }

                                        $.post("/requisitoUsuario", {
                                            opciones: array,
                                            id_requisito: "{{$requisito->id}}"
                                        });
                                    });
                                </script>
                            </div>
                            <div class="modal-footer">
                                <button id="confirmacion{{ $requisito->id }}" type="button" class="btn btn-danger">@lang('messages.eliminar')</button>
                                <button type="submit" class="btn btn-success">@lang('messages.modificar')</button>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script>
            $("#confirmacion{{ $requisito->id }}").click(function() {

                swal({
                    title: "¿Estás seguro?",
                    text: "Vas a eliminar {{ $requisito->nombre}}.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sí, adelante",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    allowOutsideClick: true
                },
                function(){
                    window.location.href = "/requisito/borrar/{{ $requisito->id }}";            
                });
            });

        </script>
    @endforeach
    <script>
        $(function() {
            $("#accordion1, #accordion2", "#accordion3").sortable({
                connectWith: "connectedSortable",
                opacity: 0.5
            }).disableSelection();
        });
    </script>
    @endsection