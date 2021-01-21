<?php
session_start();
require_once('../hospedajes/controlador/dbConfig.php');
$sqlVerificar = "SELECT idFila FROM fila WHERE idSubasta=".$_GET['id'];
$resultadoVerificar = mysqli_query($con,$sqlVerificar);
$rowsVerificar = mysqli_fetch_assoc($resultadoVerificar);
$sqlVerificarDetalle = "SELECT idUsuario FROM detalleFila WHERE idFila=".$rowsVerificar['idFila']." AND idUsuario=".$_SESSION['idUsuario'];
$resultadoVerificarDetalle = mysqli_query($con,$sqlVerificarDetalle);
if (mysqli_num_rows($resultadoVerificarDetalle)>0){
  header("Location: ".$_GET['return']."&yaInscripto=1");
  die();
}
else{
  $sqlInscribir = "INSERT into detalleFila (idFila,idUsuario) VALUES ('".$rowsVerificar['idFila']."','".$_SESSION['idUsuario']."')";
  $resultadoInscribir = mysqli_query($con,$sqlInscribir);
  $sqlTitulo = "SELECT hospedaje.titulo From hospedaje INNER JOIN Subasta ON (Subasta.idHospedaje = hospedaje.idHospedaje) WHERE Subasta.idSubasta =".$_GET['id'];
  $resultadoTitulo = mysqli_query($con,$sqlTitulo);
  $titulo = mysqli_fetch_array($resultadoTitulo);
  $sqlNotificarInscripcion = "INSERT into notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
  $sqlNotificarInscripcion.= " VALUES ('0','".$_GET['id']."','¡Nueva inscripcion! El usuario ".$_SESSION['apellido'].",".$_SESSION['nombre']." Se inscribió a la subasta por el hospedaje ".$titulo['titulo']."',4,0,0)";
  $resultadoNotificar = mysqli_query($con,$sqlNotificarInscripcion);
  echo $sqlNotificarInscripcion;
  if ($resultadoNotificar){
    header("Location: ".$_GET['return']."&inscripto=1");
    die();
  }
}
 ?>
