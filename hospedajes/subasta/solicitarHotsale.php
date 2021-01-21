<?php
require_once('../controlador/dbConfig.php');
$sqlCrearSolicitudHotsale = "UPDATE Subasta SET estado = 5 WHERE idSubasta=".$_POST['id'];
$resultadoCrearSolicitudHotsale = mysqli_query($con,$sqlCrearSolicitudHotsale);
header("Location: crearSubasta.php?id=".$_POST['idH']);
 ?>
