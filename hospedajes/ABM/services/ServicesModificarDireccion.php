<?php
$direccion = $_POST['direccion'];
$direccion = str_replace(' ','',$direccion);

if (strlen($direccion) == 0){
  header("Location: ../modificarDireccion.php?error=1");
  die();
} else {
  require_once ("../../controlador/dbConfig.php");
  $sqlNuevaDir = "UPDATE Direccion SET Direccion='".$_POST['direccion']."',Localidad='".$_POST['localidad']."',Provincia='".$_POST['provincia']."' WHERE idDireccion = '".$_POST['id']."'";
  $resutadoNuevaDir = mysqli_query($con,$sqlNuevaDir);
  if ($resutadoNuevaDir) {
    header("Location: ../modificar.php?id=".$_POST['idH']."&dir=1");
  }
}
 ?>
