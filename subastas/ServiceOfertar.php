<?php
session_start();
require_once("../hospedajes/controlador/dbConfig.php");
$sqlDatos = "SELECT * FROM Subasta WHERE idSubasta=".$_POST['idS'];
$resultadoDatos = mysqli_query($con,$sqlDatos);
$rowsDatos = mysqli_fetch_assoc($resultadoDatos);
if ($rowsDatos['precio']>$_POST['precioNuevo']){
  header("Location: ofertar.php?id=".$_POST['idS']."&error=1");
}
else{
  $sqlSubastado = "SELECT subastado FROM Subasta WHERE idSubasta=".$_POST['idS'];
  $resultadoSubastado = mysqli_query($con,$sqlSubastado);
  $rowsSubastado = mysqli_fetch_assoc($resultadoSubastado);
  if ( !$rowsSubastado['subastado'] && ($rowsDatos['precio'] == $_POST['precioNuevo'])){
    $sqlModificarSubasta = "UPDATE Subasta SET subastado = 1, precio = ".$_POST['precioNuevo'].", idUsuario=".$_SESSION['idUsuario']." WHERE idSubasta =".$_POST['idS'];
    $resultadoModificar = mysqli_query($con,$sqlModificarSubasta);
    $sqlAgregarPuja = "INSERT INTO Pujas (idSubasta, idUsuario, precio)";
    $sqlAgregarPuja .= " VALUES (".$_POST['idS'].", ".$_SESSION['idUsuario'].",".$_POST['precioNuevo'].")";
    $resultadoAgregarPuja = mysqli_query($con,$sqlAgregarPuja);
    if ($resultadoAgregarPuja){
      header("Location: ofertar.php?id=".$_POST['idS']."&sub=1");
    }
  }
  else{
    if ($rowsDatos['precio'] == $_POST['precioNuevo']){
      header("Location: ofertar.php?id=".$_POST['idS']."&error=1");
      die();
    }
    if ($rowsSubastado['subastado']){
      $sqlGuardarSuplente = "UPDATE Subasta SET idUsuarioSuplente = ".$rowsDatos['idUsuario']." WHERE idSubasta =".$rowsDatos['idSubasta'];
      $resultadoGuartar = mysqli_query($con,$sqlGuardarSuplente);
    }
    $sqlModificarSubasta = "UPDATE Subasta SET precio = ".$_POST['precioNuevo'].",idUsuario=".$_SESSION['idUsuario'].",subastado=1 WHERE idSubasta =".$_POST['idS'];
    $resultadoModificar = mysqli_query($con,$sqlModificarSubasta);
    $sqlAgregarPuja = "INSERT INTO Pujas (idSubasta, idUsuario, precio)";
    $sqlAgregarPuja .= " VALUES (".$_POST['idS'].", ".$_SESSION['idUsuario'].",".$_POST['precioNuevo'].")";
    $resultadoAgregarPuja = mysqli_query($con,$sqlAgregarPuja);
    if ($resultadoAgregarPuja){
      header("Location: ofertar.php?id=".$_POST['idS']."&sub=1");
    }
  }
}
 ?>
