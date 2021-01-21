<!DOCTYPE html>
<html>
  <head>
    <link rel="apple-touch-icon" sizes="180x180" href="../Logos/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Logos/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Logos/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="../Logos/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <title>Home Switch Home Site</title>
    <!--<link rel="shortcut icon" href="favico.ico"/>-->
    <link type="text/css" rel="stylesheet" href="../style.css" media="all">



<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="../css/landing-page.min.css" rel="stylesheet">

  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </head>
  <body>
    <?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
     ?>
    <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../Logos/HSH-Complete.svg" width="200px"></a>
      <?php if (isset($_GET['return'])){
        ?>
        <a class="btn btn-primary" href="<?php echo $_GET['return']?>">Atras</a>
        <?php
    }
    else {
      ?>
      <a class="btn btn-primary" href="../index.php">Inicio</a>
      <?php
    }
        session_start();
        if (isset($_SESSION['idUsuario'])){
          ?>
          <div id="perfil">
            <?php if (isset($_GET['id'])){
              ?>
              <a class="btn" href="../user/verPerfil.php?return=<?php echo $actual_link;?>"><?php echo $_SESSION['apellido'].", ".$_SESSION['nombre'] ?></a>
          <?php
          }
          for ($i=0;$i<$_SESSION['tokens'];$i++) {
          ?>
          <img src="../Logos/coin.png" width="25px" height="25px" alt="coin">
            <?php
          }
          if (isset($_GET['id'])){
          ?>
          <a href="../user/verPerfil.php?return=<?php echo $actual_link;?>"><img class="logo" src="../images/<?php echo $_SESSION['imagen'];?>" width="60px"></a>
          <?php
        }?>
          </div>
          <a class="btn btn-danger" href="../user/services/ServicesLogOut.php">Cerrar Sesion</a>
          <?php
        }else{
       ?>
      <a class="btn btn-primary" href="../user/login.php">Iniciar Sesion</a>
    <?php } ?>
    </div>
  </nav>
<?php

if (isset($_GET['id'])){
  require_once("../hospedajes/controlador/dbConfig.php");
  $sqlSubasta="SELECT * FROM Subasta WHERE idSubasta=".$_GET['id'];
  $resultadoSubasta = mysqli_query($con,$sqlSubasta);
  $rowsSubasta = mysqli_fetch_assoc($resultadoSubasta);
  $sqlHospedaje = "SELECT * FROM hospedaje WHERE idHospedaje=".$rowsSubasta['idHospedaje'];
  $resultadoHospedaje = mysqli_query($con,$sqlHospedaje);
  $rowsHospedaje = mysqli_fetch_assoc($resultadoHospedaje);
  $sqlFechas = "SELECT * FROM fechasDisponibles WHERE idFecha=".$rowsSubasta['idFecha'];
  $resultadoFecha = mysqli_query($con,$sqlFechas);
  $rowsFechas = mysqli_fetch_array($resultadoFecha);
  $sqlDireccionCompleta = "Select Direccion.idDireccion, Direccion.Direccion, Direccion.ciudad, provincias.provincia FROM ( Direccion INNER JOIN provincias ON ( Direccion.Provincia = provincias.id ) ) WHERE Direccion.idDireccion =".$rowsHospedaje['idDireccion'];
  $resultadoDireccionCompleta = mysqli_query($con,$sqlDireccionCompleta);
  $rowsDireccionCompleta = mysqli_fetch_assoc($resultadoDireccionCompleta);
}
 ?>
 <div class="container-fluid">
     <div class="content-wrapper">
 		<div class="item-container">
 			<div class="container">
 				<div class="col-md-16">
 					<div class="product col-md-5 service-image-left">
 						<center>
 							<img id="item-display" src="../images/<?php echo $rowsHospedaje['imagenData'];?>" alt="Foto hospedaje" title="fotografia" width="400" height="250"></img>
 						</center>
 					</div>
 				</div>
        <?php if(isset($_GET['error']))
        {
        switch ($_GET['error']) {
        case 1:
        ?>
        <script type="text/javascript">
        alert('El precio debe ser mayor al precio actual de la subasta!');
        </script>
        <?php
        break;
        }
      }
      if (isset($_GET['sub'])){
        ?>
        <script type="text/javascript">
        alert('Oferta exitosa!');
        </script>
        <?php
      }
      ?>
 				<div class="col-md-7">

 					<div class="product-title"><h2 style="text-align:center"><?php echo $rowsHospedaje['titulo']; ?></h2></div>
 					<div class="product-desc"><?php echo $rowsHospedaje['descripcion']; ?></div>
          <div class="product-desc"><h4>Cantidad de Personas: <?php echo $rowsHospedaje['cantidadPersonas']; ?></h4></div>
          <div class="product-desc"><h4>Ubicacion: <?php echo utf8_encode($rowsDireccionCompleta['Direccion'].', '.$rowsDireccionCompleta['ciudad'].', '.$rowsDireccionCompleta['provincia'].', Argentina'); ?></h4></div>
          <div class="product-desc"><h4 >Precio Actual: <span <?php if (isset($_GET['sub'])){echo "style= background-color:#2EFE64";}?>>$<?php echo $rowsSubasta['precio']; ?></span></h4></div>
          <?php
          if ($_SESSION['idUsuario'] == 0) {
          if ($rowsSubasta['subastado'] == 1) {
              $sqlUsuarioGanador="SELECT * FROM usuarios WHERE idUsuario = ".$rowsSubasta['idUsuario'];
              $resultadoUsuarioGanador = mysqli_query($con,$sqlUsuarioGanador);
              $usuarioGanador = mysqli_fetch_assoc($resultadoUsuarioGanador);
          ?>
          <div class="product-desc"><h4 style="background-color: #d5f5e3 ;">Propiedad Con Ofertas</h4></div>
          <div class="product-desc"><h4 style="background-color: #d5f5e3 ;">Actual ganador: <?php echo $usuarioGanador['apellido'].', '.$usuarioGanador['nombre']; ?></h4></div>
        <?php
      }
        else {?>
          <div class="product-desc"><h4 style="background-color: #fadbd8;">La propiedad no recibio ofertas</h4></div>
          <?php
        }
      }?>
          <div class="btn-group cart">
            <form action="ServiceOfertar.php" method="post">
              <input type="hidden" name="idS" value="<?php echo $_GET['id'];?>">
              <input type="hidden" name="precioBase" value="<?php echo $rowsSubasta['precio'];?>">
              <div class="col-auto">
                <label class="sr-only" for="inlineFormInputGroup"><?php echo $rowsSubasta['precio'];?></label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text" style="font-size:18pt">$</div>
                    <?php if ($_SESSION['tokens']==0) {
                      ?>
                      <input type="text" style="height:50px;width:251px;font-size:18pt;text-align:center" name="precioNuevo" placeholder="No posee Tokens" readonly>
                      <input type="button" style="margin-left:8px; border-radius:8px;font-size:18pt"name="ofertar" value="OFERTAR" class="btn btn-secondary">
                    </form>
                      <?php
                    } else { if ($_SESSION['tipo']==1){

                ?>
                    <input type="text" style="height:50px;width:385px;font-size:18pt;text-align:center" name="precioNuevo" placeholder="Administrador no puede ofertar" readonly>
                    <input type="button" style="margin-left:8px; border-radius:8px;font-size:18pt"name="ofertar" value="OFERTAR" class="btn btn-secondary">

                    <?php
                    } else { ?>
                      <input type="number" style="height:50px;width:215px;font-size:18pt;text-align:center" name="precioNuevo" placeholder="<?php echo $rowsSubasta['precio'];?>" required>
                      <input type="submit" style="margin-left:8px; border-radius:8px;font-size:18pt"name="ofertar" value="OFERTAR" class="btn btn-success">
                      <?php
                    }
                  }?>
        </div>
      </div>
    </div>
        </div>
 				</div>
 			</div>
 		</div>
      <div id="pie">
        <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
      </div>
    </div>

      <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
