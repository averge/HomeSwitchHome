<?php

require_once('../../controlador/dbConfig.php');
$sqlDatos = "SELECT * FROM Subasta WHERE idSubasta=".$_GET['id'];
$resultadoDatos = mysqli_query($con,$sqlDatos);
$datos = mysqli_fetch_assoc($resultadoDatos);

$sqlEliminarFecha = "DELETE FROM fechasDisponibles WHERE idFecha=".$datos['idFecha'];
$resultadoEliminarFecha = mysqli_query($con,$sqlEliminarFecha);

$sqlEliminarHotsale = "DELETE FROM Subasta WHERE idSubasta=".$_GET['idH'];
$resultadoEliminarHotsale = mysqli_query($con,$sqlEliminarHotsale);

header("Location: ../crearSubasta.php?id=".$_GET['idH']);

 ?>
