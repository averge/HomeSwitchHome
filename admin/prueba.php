<?php
require_once('../hospedajes/controlador/dbConfig.php');
$sql="SELECT inicioSemana From fechasDisponibles WHERE iDfecha=4";
$resultado = mysqli_query($con,$sql);
$fecha = mysqli_fetch_assoc($resultado);
$date = $fecha['inicioSemana'];
$date = str_replace('-', '/', $date );
$date = str_replace('00:00:00', '00:00 AM', $date );
?>
 <script>

 var end = new Date('<?php echo $date; ?>');

 var _second = 1000;
 var _minute = _second * 60;
 var _hour = _minute * 60;
 var _day = _hour * 24;

 var timer;

 function showRemaining() {
     var now = new Date();
     var distance = end - now;
     if (distance < 0) {

         clearInterval(timer);
         document.getElementById('countdown').innerHTML = 'EXPIRED!';

         return;
     }
     var days = Math.floor(distance / _day);
     var hours = Math.floor((distance % _day) / _hour);
     var minutes = Math.floor((distance % _hour) / _minute);
     var seconds = Math.floor((distance % _minute) / _second);

     document.getElementById('dias').innerHTML = days + ' days ';
     document.getElementById('horas').innerHTML = hours + 'hrs ';
     document.getElementById('minutos').innerHTML = minutes + 'mins ';
     document.getElementById('segundos').innerHTML = seconds + 'secs';

 }

 timer = setInterval(showRemaining, 1000);
</script>

<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<div id="countdown">

   <div id="countdown">
     <span id="dias">
     </span>
     <span id="horas">
     </span>
     <span id="minutos">
     </span>
     <span id="segundos">
     </span>
   </div>



</div>
   </body>
</html>
