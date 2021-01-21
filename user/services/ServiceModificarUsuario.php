<?php
function getAge ($fecha)
    {
        $mayor=18;
        $nacio = DateTime::createFromFormat('Y-m-d', $fecha);
        $calculo = $nacio->diff(new DateTime());

        $edad=  $calculo->y;
        if ($edad < $mayor)
        {
          header("Location: ../modificar.php?error=4&id=".$_POST['id']);
          die();
         }
    }
getAge($_POST['fechaNac']);
require_once("../../hospedajes/controlador/dbConfig.php");
$usuario = "SELECT idUsuario FROM usuarios WHERE mail='".$_POST['mail']."' AND idUsuario <> '".$_POST['id']."'";
$resultadoUsuario = mysqli_query($con,$usuario);
if (mysqli_num_rows($resultadoUsuario)>0){
  header("Location: ../modificar.php?error=1&id=".$_POST['id']);
  die();
}
if(strlen($_POST['tarjeta'])>16){
  header("Location: ../modificar.php?error=3&id=".$_POST['id']);
  die();
}
$sql = "UPDATE usuarios SET nombre = '".$_POST['nombre']."', apellido = '".$_POST['apellido']."', mail = '".$_POST['mail']."', nacionalidad = '".$_POST['Nacionalidad']."' , tarjeta = '".$_POST['tarjeta']."', fechaNac = '".$_POST['fechaNac']."' WHERE idUsuario = '".$_POST['id']."'";
$resultado = mysqli_query($con,$sql);
if($resultado) {
  if (!empty($_FILES['imagen']['name'])){
    $tmpName = $_FILES['imagen']['tmp_name'];
    $imageProperties = getimageSize($_FILES['imagen']['tmp_name']);
    $type = $imageProperties['mime'];
    $type = str_replace('image/', '', $type);
    $checker = $imageProperties[2];
    if (!(in_array($checker , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))){
      header("Location: ../modificar.php?error=2&id=".$_POST['id']);
      die();
    }
    $name="../../images/idUsuario".$_POST['id'].".".$type;
    fopen($name,"a");
    copy($tmpName,$name);
    $name = "idUsuario".$_POST['id'].".".$type;
    $sql = "UPDATE usuarios SET imagenData = '".$name."' WHERE idUsuario = ".$_POST['id'];
    $resultado = mysqli_query($con,$sql);
    }
    header("Location: ../verPerfil.php?mod=1");
}
?>
