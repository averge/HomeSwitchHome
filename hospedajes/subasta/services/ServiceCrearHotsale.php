<?php
  require_once('../../controlador/dbConfig.php');
  $sqlCrearHotsale = "INSERT INTO hotsale (idHospedaje, idFecha, precio, estado) VALUES (".$_POST['idH'].",".$_POST['idF'].",".$_POST['precio'].",1)";
  $resuladoCrearHotsale = mysqli_query($con,$sqlCrearHotsale);
  $sqlVerificarSubasta = "SELECT idSubasta FROM Subasta WHERE idHospedaje = ".$_POST['idH']." AND idFecha = ".$_POST['idF'];
  $resultadoVerificar = mysqli_query($con,$sqlVerificarSubasta);
  if (mysqli_num_rows($resultadoVerificar) == 1) {
    $rows = mysqli_fetch_assoc($resultadoVerificar);
    $sqlActualizarSubasta = "UPDATE Subasta SET estado = 6 WHERE idSubasta = ".$rows['idSubasta'];
    $resultadoActualizar = mysqli_query($con,$sqlActualizarSubasta);
  }
  header("Location: ../crearSubasta.php?id=".$_POST['idH']."&hotsale=1");
 ?>
