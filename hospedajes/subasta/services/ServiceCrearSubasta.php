<?php
require_once('../../controlador/dbConfig.php');
$sqlDatos = "SELECT * FROM Subasta WHERE idSubasta=".$_POST['id'];
$resultadoDatos = mysqli_query($con,$sqlDatos);
$datos = mysqli_fetch_assoc($resultadoDatos);

$dateAux = new DateTime($datos['fechaFin']);
$dateAux = $dateAux->modify('+3 day');
$dateAux = $dateAux->format('Y/m/d h:i:s');

date_default_timezone_set('America/Argentina/Buenos_Aires');
$dateAux = new DateTime($datos['fechaFin']);
$dateAux = $dateAux->modify('+3 day');
$dateAux = $dateAux->format('Y/m/d h:i:s');

$sqlSubasta = "UPDATE Subasta SET estado=1, fechaFin='".$dateAux."' WHERE idSubasta=".$_POST['id'];
$resultadoSubasta = mysqli_query($con,$sqlSubasta);

if ($resultadoSubasta){
  header("Location: ../crearSubasta.php?id=".$datos['idHospedaje']."&subasta=1");
}
 ?>
