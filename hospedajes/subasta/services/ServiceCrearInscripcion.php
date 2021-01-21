<?php
require_once('../../controlador/dbConfig.php');

$sqlDatos = "SELECT * FROM Subasta WHERE idSubasta=".$_POST['id'];
$resultadoDatos = mysqli_query($con,$sqlDatos);
$datos = mysqli_fetch_assoc($resultadoDatos);

$dateAux = new DateTime($datos['fechaFin']);
$dateAux = $dateAux->modify('+6 month');
$dateAux = $dateAux->format('Y/m/d h:i:s');

$sqlAgregarInicioSubasta = "UPDATE Subasta SET fechaFin='".$dateAux."',estado = 3 WHERE idSubasta=".$_POST['id'];
$resultadoInicioSubasta = mysqli_query($con,$sqlAgregarInicioSubasta);

$sqlCrearFila = "INSERT INTO fila (idSubasta) VALUES ('".$_POST['id']."')";
$resultadoCrearFila = mysqli_query($con,$sqlCrearFila);
?>
<form name="myForm" id="myForm" action="../../subasta/crearSubasta.php" method="GET">
  <input type="hidden" name="id" value="<?php echo $datos['idHospedaje'] ?>" />
  </form>
  <script>
      var auto_refresh = setInterval(
      function()
      {
      submitform();
    }, 0);

      function submitform()
      {
        document.myForm.submit();
      }
      </script>








<?php
/*date_default_timezone_set('America/Argentina/Buenos_Aires');
$date = date('Y-m-d h:i:s', time());
$currentYear = substr($date,0,4);
$nextYear = intval($currentYear) + 1;
$date = str_replace($currentYear,$nextYear,$date);
$recuperarFecha = "SELECT * FROM fechasDisponibles WHERE idFecha = ".$_POST['idF'];
$resultadoRecuperar = mysqli_query($con,$recuperarFecha);
$fecha = mysqli_fetch_assoc($resultadoRecuperar);
var_dump($_POST);
if ($fecha['inicioSemana'] < $date) {
  header("Location: ../crearSubasta.php?id=".$_POST['idH']."&fecha=menor");
  $sqlCrearSolicitudHotsale = "INSERT INTO Subasta (idHospedaje,idFecha,estado)";
  $sqlCrearSolicitudHotsale .= " VALUES ('".$_POST['idH']."','".$_POST['idF']."',5)";
  $resultadoCrearSolicitudHotsale = mysqli_query($con,$sqlCrearSolicitudHotsale);
  die();
}

$sqlCrearInscripcion = "INSERT INTO Subasta (idHospedaje,idFecha,precio,estado,subastado)";
$sqlCrearInscripcion .= " VALUES ('".$_POST['idH']."','".$_POST['idF']."','".$_POST['precio']."','3',0)";
$resultadoCrearInscripcion = mysqli_query($con,$sqlCrearInscripcion);
$max = "SELECT max(idSubasta) as idSubasta FROM Subasta";
$resultadoMax = mysqli_query($con,$max);
$max = mysqli_fetch_assoc($resultadoMax);
$sqlCrearFila = "INSERT INTO fila (idSubasta) VALUES ('".$max['idSubasta']."')";
$resultadoCrearFila = mysqli_query($con,$sqlCrearFila);

$date = new DateTime($_POST['semana']);
$date = $date->modify("-6 month");
$inicioSubasta = $date->format("Y/m/d");
$sqlAgregarInicioSubasta = "UPDATE Subasta SET fechaFin='".$inicioSubasta."'";
$resultadoInicioSubasta = mysqli_query($con,$sqlAgregarInicioSubasta);

header('Location: ../crearSubasta.php?id='.$_POST['idH']);
*/
 ?>
