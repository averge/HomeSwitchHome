<?php

if (isset($_GET['id'])){
require_once("../hospedajes/controlador/dbConfig.php");
$eliminar="UPDATE usuarios SET solicitud=2 WHERE idUsuario='".$_GET['id']."'";
$resultado=mysqli_query($con,$eliminar);
if($resultado){
  $sqlNotificacion = "INSERT INTO notificaciones (idUsuario,notificacion,tipo,oculta,visto) VALUES ('".$_GET['id']."','¡Lo sentimos! su solicitud de Premium fue rechazada',6,0,0)";
  $resultadoNotificacion = mysqli_query($con,$sqlNotificacion);
}
header("Location: solicitudes.php?rechazo=1");

}
?>
