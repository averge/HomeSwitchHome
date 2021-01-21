<?php
if (isset($_POST['id'])){
  require_once("../controlador/dbConfig.php");

  $sql="SELECT cantidadSemanasDisp FROM hospedaje WHERE idHospedaje=".$_POST['id'];
  $resultado=mysqli_query($con,$sql);
  $resultado=mysqli_fetch_assoc($resultado);
  $cantidad=$resultado['cantidadSemanasDisp'];
  $cantidad=$cantidad+$_POST['semanas'];
  $sql="UPDATE hospedaje SET cantidadSemanasDisp=".$cantidad." WHERE idHospedaje=".$_POST['id'];
  $resultado1=mysqli_query($con,$sql);

  for($i=0;$i<$_POST['semanas'];$i++){
      $sql="INSERT INTO fechasDisponibles(idHospedaje, inicioSemana) VALUES ('".$_POST['id']."','".$_POST['semana'.$i]."')";
      $resutado1=mysqli_query($con,$sql);
      $sqlId = "SELECT MAX(idFecha) FROM fechasDisponibles";
      $resultadoId = mysqli_query($con,$sqlId);
      $idFecha = mysqli_fetch_assoc($resultadoId);
      $sql = "INSERT INTO Subasta (idHospedaje,idFecha,precio,estado) VALUES ('".$_POST['id']."','".$idFecha['MAX(idFecha)']."','".$_POST['precio'.$i]."','11')";
      $resultadoSub = mysqli_query($con,$sql);
  }
  if($resultado1){
    header("Location: ../detalle.php?id=".$_POST['id']."&exito=1");
  }
}

 ?>
