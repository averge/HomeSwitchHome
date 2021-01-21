<?php
require_once('../../hospedajes/controlador/dbConfig.php');
$sql = "UPDATE notificaciones set oculta = 1 WHERE idNotificacion=".$_GET['id'];
$resultado = mysqli_query($con,$sql);
if ($resultado){
  header('Location: ../verNotificaciones.php');
}

 ?>
