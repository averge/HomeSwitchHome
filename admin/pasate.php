<?php
require_once("../hospedajes/controlador/dbConfig.php");
session_start();
$sqlCheckearSolicitud = "SELECT solicitud FROM usuarios WHERE idUsuario ='".$_SESSION['idUsuario']."'";
$resultadoCheck = mysqli_query($con,$sqlCheckearSolicitud);
$solicitud = mysqli_fetch_assoc($resultadoCheck);
if ($solicitud['solicitud'] == 3){
  header("Location: ../index.php?yaSolicito=1");
  die();
}
else{
  $sql="UPDATE usuarios SET solicitud=3 WHERE idUsuario='".$_SESSION['idUsuario']."'";
  $resultadoAlta=mysqli_query($con,$sql);
  $sqlNotificarSolicitud="INSERT INTO notificaciones (idUsuario,notificacion,tipo,oculta,visto)";
  $sqlNotificarSolicitud.=" VALUES ('2','El usuario ".$_SESSION['apellido'].", ".$_SESSION['nombre']." solicitó ser Premium',5,0,0)";
  $resultadoNotificar=mysqli_query($con,$sqlNotificarSolicitud);
  $_SESSION['solicitud'] = 3;
  header("Location: ../index.php");
}
?>
