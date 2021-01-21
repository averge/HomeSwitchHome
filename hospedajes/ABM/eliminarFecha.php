<?php
  require_once("../controlador/dbConfig.php");
  $sqlDatosSubasta = "SELECT * FROM Subasta WHERE idHospedaje = ".$_GET['idH']." AND idFecha = ".$_GET['idF'];
  $resultadoDatos = mysqli_query($con,$sqlDatosSubasta);
  $sqlActualizarHospedaje = "SELECT cantidadSemanasDisp FROM hospedaje WHERE idHospedaje = ".$_GET['idH'];
  $resultadoHospedaje = mysqli_query($con,$sqlActualizarHospedaje);
  $cantidad = mysqli_fetch_assoc($resultadoHospedaje);
  $cantidad = $cantidad['cantidadSemanasDisp'] - 1;
  $sqlActualizarHospedaje = "UPDATE hospedaje SET cantidadSemanasDisp=".$cantidad." WHERE idHospedaje = ".$_GET['idH'];
  $resultadoActualizarHospedaje = mysqli_query($con,$sqlActualizarHospedaje);
  if (mysqli_num_rows($resultadoDatos) == 1) {
    $rows = mysqli_fetch_assoc($resultadoDatos);
    $sqlEliminarSubasta = "DELETE FROM Subasta WHERE idSubasta = ".$rows['idSubasta'];
    $resultadoEliminarSubasta = mysqli_query($con,$sqlEliminarSubasta);
  }
  $sqlEliminarFecha = "DELETE FROM fechasDisponibles WHERE idFecha=".$_GET['idF'];
  $resultadoEliminarFecha = mysqli_query($con,$sqlEliminarFecha);
  if ($resultadoEliminarFecha){
    header("Location: ../detalle.php?id=".$_GET['idH']."&eliminar=1");
  }
  

 ?>
