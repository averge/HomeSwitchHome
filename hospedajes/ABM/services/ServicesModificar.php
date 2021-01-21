<?php
require_once ("../../controlador/dbConfig.php");
$titulo = $_POST['titulo'];
$cantPersonas = $_POST['cantPersonas'];
$descripcion = $_POST['descripcion'];
$titulo = str_replace(' ','',$titulo);
$cantPersonas = str_replace(' ','',$cantPersonas);
$descripcion = str_replace(' ','',$descripcion);
$sql = "SELECT idHospedaje FROM hospedaje WHERE titulo = '".$titulo."' AND idHospedaje <> ".$_POST['id'];
$resultado = mysqli_query($con,$sql);
if ($resultado->num_rows != 0){
  header ("Location: ../modificar.php?id=".$_POST['id']."&error=3");
  die();
}
if ( strlen($titulo) == 0 || strlen($cantPersonas) == 0 || strlen($descripcion) == 0 ){
  header ("Location: ../modificar.php?id=".$_POST['id']."&error=1");
  die();
}
$sqlActHospedaje = "UPDATE hospedaje SET titulo='".$_POST['titulo']."',cantidadPersonas='".$_POST['cantPersonas']."',descripcion='".$_POST['descripcion']."' WHERE idHospedaje=".$_POST['id'];
$resultadoActHospedaje = mysqli_query($con,$sqlActHospedaje);
$sql = "SELECT idDireccion FROM hospedaje WHERE idHospedaje = ".$_POST['id'];
$resultado = mysqli_query($con,$sql);
$direccion= mysqli_fetch_assoc($resultado);
$sqlActDireccion = "UPDATE Direccion SET Direccion='".$_POST['direccion']."', ciudad='".$_POST['ciudad']."', Provincia='".$_POST['provincia']."' WHERE idDireccion=".$direccion['idDireccion'];
$sqlActDireccion = mysqli_query($con,$sqlActDireccion);
if (!empty($_FILES['imagen']['tmp_name'])){
  $imageProperties = getimageSize($_FILES['imagen']['tmp_name']);
  $checker = $imageProperties[2];
  if (!(in_array($checker , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))){
    header("Location: ../Alta.php?error=2");
    die();
  }
  $type = $imageProperties['mime'];
  $type = str_replace('image/', '', $type);
  $tmpName = $_FILES['imagen']['tmp_name'];
    $name="../../../images/idHospedaje".$_POST['id'].".".$type;
  fopen($name,"w");
  copy($tmpName,$name);
  fclose($name);
  $name = "idHospedaje".$rows['idHospedaje'].".".$type;

  $sql = "UPDATE hospedaje SET imagenData = '".$name."' WHERE idHospedaje = ".$rows['idHospedaje'];
  $resultado = mysqli_query($con,$sql);
  if ($resultado){
    if (isset($_POST['semanas'])){
      if ($_POST['semanas'] > 0){
        for ($i=0;$i<$_POST['semanas'];$i++){
          $sql = "INSERT INTO fechasDisponibles (idHospedaje,inicioSemana) VALUES ('".$rows['idHospedaje']."','".$_POST['semana'.$i]."')";
          $resultado = mysqli_query($con,$sql);
        }
      }
    }
  }
}
header("Location: ../modificar.php?id=".$_POST['id']."&mod=1");
 ?>
