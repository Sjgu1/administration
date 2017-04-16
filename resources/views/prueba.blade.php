<!DOCTYPE html>
<html>
    @include('navbar')
    <body>
    <a>hola</a>
    <p>Prueba</p>
    <canvas id="myChart" width="400" height="400"></canvas>
    <!--<canvas id="myChart" width="400" height="400"></canvas>-->
        <div class="container">
            <div class="hero-unit">
                <input type="text" placeholder="click to show datepicker" id="example1">
            </div>
        </div>
        <!-- Load jQuery and bootstrap datepicker scripts -->
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">

            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach ($contributors as $key => $value)
                                {!! '"' !!} {{ $key }} {!! '"' !!} {{ ',' }}
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Contribuciones',
                        data: [
                            @foreach ($contributors as $contributor)
                                {{ $contributor . ',' }}
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });
        </script>
    </body>
</html>