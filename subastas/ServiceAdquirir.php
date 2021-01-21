<?php
require_once("../hospedajes/controlador/dbConfig.php");
session_start();
if (isset($_POST['inscripcion'])){
  $terminarSubasta = "UPDATE Subasta SET estado = '2' WHERE idSubasta = ".$_POST['id'];
  $resultadoTerminar = mysqli_query($con,$terminarSubasta);

  $descontarToken = "UPDATE usuarios set tokens = ".($usuario['tokens']-1)." WHERE idUsuario = ".$rowsSubasta['idUsuario'];
  $resultadoDescontarToken = mysqli_query($con,$descontarToken);

  $notificarGanador = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
  $notificarGanador .= " VALUES ('".$rowsSubasta['idUsuario']."','".$_POST['id']."','¡FELICITACIONES ADQUIRIO EL HOSPEDAJE ".$rowsSubasta['titulo']." EN LA BREVEDAD NUESTROS AGENTES SE COMUNICARAN CON USTED', 7, 0, 0)";
  $resultadoNotificar = mysqli_query($con,$notificarGanador);

  $sqlNotificacionPago = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
  $sqlNotificacionPago .= " VALUES ('".$rowsSubasta['idUsuario']."','".$_POST['id']."','¡Se realizo el pago con exito! Se cargo el importe de $".$rowsSubasta['precio']." en la tarjeta ****-****-****-".(1000%$usuario['tarjeta'])."' , 7, 0, 0)";
  $resultadoNotificarPago = mysqli_query($con,$sqlNotificacionPago);

  $sqlNotificacionToken = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
  $sqlNotificacionToken .= " VALUES ('".$rowsSubasta['idUsuario']."','".$_POST['id']."','¡Se desconto el token con exito! Para poder ver los cambios en las monedas de arriba por favor vuelva a iniciar sesion' , 7, 0, 0)";
  $resultadoNotificarToken = mysqli_query($con,$sqlNotificacionToken);

  $notificarAdmin = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
  $notificarAdmin .= " VALUES ('0','".$_POST['id']."','¡HAY GANADOR! Termino la subasta de ".$rowsSubasta['titulo']." Fue el usuario ".$usuario['apellido'].",".$usuario['nombre']."', 8, 0, 0)";
  $resultadoNotificarAdmin = mysqli_query($con,$notificarAdmin);
} else {
$datosSubasta="SELECT * FROM hotsale INNER JOIN hospedaje on (hotsale.idHospedaje = hospedaje.idHospedaje) WHERE idHotsale=".$_POST['id'];
$resultadoSubasta = mysqli_query($con,$datosSubasta);
$rowsSubasta = mysqli_fetch_assoc($resultadoSubasta);

$sqlNotificaciones = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
$sqlNotificaciones .= " VALUES ('".$_SESSION['idUsuario']."','".$_POST['id']."','¡FELICITACIONES! ADQUIRIO EL HOSPEDAJE ".$rowsSubasta['titulo']." EN LA BREVEDAD UN AGENTE SE COMUNICARA CON USTED',1,0,0)";
$resultadoNotificar = mysqli_query($con,$sqlNotificaciones);

$sqlTarjeta = "SELECT tarjeta FROM usuarios WHERE idUsuario = ".$_SESSION['idUsuario'];
$resultadoTarteja = mysqli_query($con,$sqlTarjeta);
$tarjeta = mysqli_fetch_assoc($resultadoTarteja);

$sqlNotificacionPago = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
$sqlNotificacionPago .= " VALUES ('".$_SESSION['idUsuario']."','".$_POST['id']."','¡Se realizo el pago con exito! Se cargo el importe de $".$rowsSubasta['precio']." en la tarjeta ****-****-****-".(1000%$tarjeta['tarjeta'])."' , 7, 0, 0)";
$resultadoNotificarPago = mysqli_query($con,$sqlNotificacionPago);

$adquirir = "UPDATE hotsale SET estado=0,idUsuario=".$_SESSION['idUsuario']." WHERE idHotsale=".$_POST['id'];
$resultadoAdquirir = mysqli_query($con,$adquirir);

$adquirirSubasta = "UPDATE Subasta SET estado=7 WHERE idFecha = ".$_POST['idF']." AND idHospedaje = ".$_POST['idH']." AND estado = 6";
$resultadoAdquirirSubasta = mysqli_query($con,$adquirirSubasta);

$sqlNotificaciones = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
$sqlNotificaciones .= " VALUES ('0','".$_POST['id']."','¡FELICITACIONES! EL USUARIO ".$_SESSION['apellido'].",".$_SESSION['nombre']." ADQUIRIO EL HOSPEDAJE ".$rowsSubasta['titulo']."',1,0,0)";
$resultadoNotificar = mysqli_query($con,$sqlNotificaciones);
}

header("Location: ../user/verNotificaciones.php");
 ?>
