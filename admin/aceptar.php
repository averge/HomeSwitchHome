<?php
if (isset($_GET['id'])){
require_once("../hospedajes/controlador/dbConfig.php");
$sql="UPDATE usuarios SET tipo = 3,solicitud = 1 WHERE idUsuario='".$_GET['id']."'";
$resultadoAlta=mysqli_query($con,$sql);
if ($resultadoAlta) {
  $sqlNotificacion = "INSERT INTO notificaciones (idUsuario,notificacion,tipo,oculta,visto) VALUES ('".$_GET['id']."','¡Felicitaciones! su solicitud de Premium fue aceptada',1,0,0)";
  $resultadoNotificacion = mysqli_query($con,$sqlNotificacion);
  header("Location: solicitudes.php?exito=1");
}
}
?>
