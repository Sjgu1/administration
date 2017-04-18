@extends('layouts.app')


  @section('seleccion')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<ul class="nav navbar-nav">
  <li><a href="{{ url('/home') }}">Home</a></li>
  <li><a href="{{ url('/proyecto') }}">Proyecto</a></li>
  <li  class="active"><a href="{{ url('/contacto') }}">Contacto</a></li>
</ul>
<link rel="stylesheet" href="css/contact.css">
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
@endsection
@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="images/alicante.jpg" alt="Alicante" width="1000" height="600">
        <div class="carousel-caption">
          <h3>Alicante</h3>
        </div>      
      </div>

      <div class="item">
        <img src="images/universidad.jpg" alt="Universidad" width="1000" height="600">
        <div class="carousel-caption">
          <h3>Universidad</h3>
        </div>      
      </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

<!-- Container (The Band Section) -->
<div id="band" class="container text-center">
  <h3>El equipo</h3>
  <p><em>DSS</em></p>
  <p>Somos un equipo de trabajo y no me apetece escribir mas.</p>
  <br>
  <div class="row">
    <div class="col-sm-3">
      <p class="text-center"><strong>Sergio</strong></p><br>
      <div width="15" height="15">
      <a href="#demo" data-toggle="collapse">
        <img src="images/cara.jpg" class="img-circle" alt="Random Name" width="150" height="150">
      </a>
      </div>
    </div>
    <div class="col-sm-3">
      <p class="text-center"><strong>Mario</strong></p><br>
      <a href="#demo2" data-toggle="collapse">
        <img src="images/cara.jpg" class="img-circle " alt="Random Name" width="150" height="150">
      </a>
    </div>
    <div class="col-sm-3">
      <p class="text-center"><strong>Laila</strong></p><br>
      <a href="#demo3" data-toggle="collapse">
        <img src="images/cara.jpg" class="img-circle " alt="Random Name" width="150" height="150">
      </a>
    </div>
    <div class="col-sm-3">
      <p class="text-center"><strong>Jesus</strong></p><br>
      <a href="#demo4" data-toggle="collapse">
        <img src="images/cara.jpg" class="img-circle " alt="Random Name" width="150" height="150">
      </a>
    </div>
  </div>
</div>


<!-- Add Google Maps -->
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div id="googleMap" style="position:fixed"></div>
    </div>
</div>
<script>
function myMap() {
var mapProp= {
    center:new google.maps.LatLng(38.3870384, -0.5116383),
    zoom:18,
};
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuM_W6hCKBRv1_1xJ1md0gt-fOcYNnxLM&callback=myMap"></script>


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
                    <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Por favor, introduzca su número de teléfono">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Mensaje *</label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Mensahe a enviar *" rows="4" required="required" data-error="Por favor, introduzca su mensaje *."></textarea>
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
<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip(); 
  
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
</script>









