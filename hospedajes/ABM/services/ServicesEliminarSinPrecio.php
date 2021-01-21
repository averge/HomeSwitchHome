<?php
require_once ("../../controlador/dbConfig.php");
$sqlDatos = "SELECT * FROM Subasta WHERE idSubasta=".$_POST['id'];
$resultadoDatos = mysqli_query($con,$sqlDatos);
$datos = mysqli_fetch_assoc($resultadoDatos);

$sqlEliminarFechas = "DELETE FROM fechasDisponibles WHERE idFecha = ".$datos['idFecha'];
$resultadoEliminarFecha = mysqli_query($con,$sqlEliminarFechas);

$sqlEliminarSubasta = "DELETE FROM Subasta WHERE idSubasta = ".$datos['idSubasta'];
$resultadoEliminarSubasta = mysqli_query($con,$sqlEliminarSubasta);
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
