<?php
require_once ("../../controlador/dbConfig.php");

$sqlDatos = "SELECT * FROM Subasta WHERE idSubasta=".$_POST['id'];
$resultadoDatos = mysqli_query($con,$sqlDatos);
$datos = mysqli_fetch_assoc($resultadoDatos);

$sqlSetearPrecio = "UPDATE Subasta set fechaFin='".$_POST['semana']."', precio=".$_POST['precio'].", estado = 11 WHERE idSubasta=".$_POST['id'];
$resultadoSetear = mysqli_query($con,$sqlSetearPrecio);

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
