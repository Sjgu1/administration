@extends('layouts.app')


  @section('seleccion')
<ul class="nav navbar-nav">
  <li><a href="{{ url('/home') }}">Home</a></li>
  <li><a href="{{ url('/proyecto') }}">Proyecto</a></li>
  <li  class="active"><a href="{{ url('/contacto') }}">Contacto</a></li>
</ul>
<body>
@endsection
@section('content')
<div class="container">
<form id="contact-form" method="post" role="form">
{{ csrf_field() }}

    <div class="messages"></div>

    <div class="controls">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">Nombre *</label>
                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Por favor, introduzca su nombre *" required="required" data-error="Firstname is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_lastname">Apellidos *</label>
                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Por favor, introduzca sus apellidos *" required="required" data-error="Lastname is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">Email *</label>
                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Por favor, introduzca su email *" required="required" data-error="Valid email is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">Teléfono</label>
                    <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Por favor, introduzca su nuúmero de teléfono">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Mensaje *</label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Por favor, introduzca su mensaje *."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" class="btn btn-success btn-send" value="Enviar Mensaje">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted"><strong>*</strong>Estos campos son obligatorios.</p>
            </div>
        </div>
    </div>

</form>
</div>
</body>
@endsection
<script>
$(function () {

    $('#contact-form').validator();

    $('#contact-form').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = "/home";

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data)
                {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#contact-form').find('.messages').html(alertBox);
                        $('#contact-form')[0].reset();
                    }
                }
            });
            return false;
        }
    })
});
</script>