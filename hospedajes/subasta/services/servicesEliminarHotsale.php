<?php
require_once('../../controlador/dbConfig.php');
$sqlDatos = "SELECT * FROM hotsale WHERE idHotsale=".$_GET['id'];
$resultadoDatos = mysqli_query($con,$sqlDatos);
$datos = mysqli_fetch_assoc($resultadoDatos);

$sqlEliminarFecha = "DELETE FROM fechasDisponibles WHERE idFecha=".$datos['idFecha'];
$resultadoEliminarFecha = mysqli_query($con,$sqlEliminarFecha);

$sqlEliminarHotsale = "DELETE FROM hotsale WHERE idHotsale=".$_GET['id'];
$resultadoEliminarHotsale = mysqli_query($con,$sqlEliminarHotsale);

header("Location: ../verTodosHotsales.php?eliminar=1");
 ?>
