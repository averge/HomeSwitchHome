<?php
require_once("../../controlador/dbConfig.php");
$sqlBajaSubasta = "UPDATE Subasta SET estado=2 WHERE idSubasta =".$_GET['id'];
$resultadoBaja = mysqli_query($con,$sqlBajaSubasta);
if ($resultadoBaja) {
  header("Location: ../crearSubasta.php?id=".$_GET['idH']);
}
 ?>
