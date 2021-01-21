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

<?php
    require_once("../hospedajes/controlador/dbConfig.php");
    $sqlSubasta="SELECT * FROM Subasta WHERE estado=1";
    $resultadoSubasta = mysqli_query($con,$sqlSubasta);
 ?>
    </head>
  <body>
    <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../Logos/HSH-Complete.svg" width="200px"></a>
      <?php   session_start();
      if (isset($_SESSION['idUsuario'])){
       ?>

          <a class="btn" href="../user/verPerfil.php"><?php echo $_SESSION['apellido'].", ".$_SESSION['nombre'] ?></a>

          <?php
            for ($i=0;$i<$_SESSION['tokens'];$i++) {
            ?>
            <img src="../Logos/coin.png" width="25px" height="25px" alt="coin">
            <?php
          } ?>
            <a href="../user/verPerfil.php"><img class="logo" src="../Logos/descarga.jpg" width="60px"></a>






       <a class="btn btn-danger" href="../user/services/ServicesLogOut.php">Cerrar Sesion</a>
<?php
      } else{
     ?>
    <a class="btn btn-primary" href="../user/login.php">Iniciar Sesion</a>
  <?php } ?>
      </nav>
      <div id="condenido">
        <h1 style="text-align:center">Subastas Actuales</h1>
        <?php if(mysqli_num_rows($resultadoSubasta) == 0){
          echo "<h2>No hay subastas disponibles</h2>";
        }
          while ($rowsSubasta = mysqli_fetch_array($resultadoSubasta)){
            $sqlHospedaje = "SELECT * FROM hospedaje WHERE idHospedaje=".$rowsSubasta['idHospedaje'];
            $resultadoHospedaje = mysqli_query($con,$sqlHospedaje);
            $rowsHospedaje = mysqli_fetch_assoc($resultadoHospedaje);
            $sqlFechas = "SELECT * FROM fechasDisponibles WHERE idFecha=".$rowsSubasta['idFecha'];
            $resultadoFecha = mysqli_query($con,$sqlFechas);
            $rowsFechas = mysqli_fetch_array($resultadoFecha);
          ?>
        <div id="subasta">
          <div id="subastaImagen">
            <?php echo '<img src="../images/'.$rowsHospedaje['imagenData'].'" alt="Imagen'.$rowsHospedaje['titulo'].'" width="400" height="250" />';?>
          </div>
          <div id="subastaInfo">
            <span><h2><?php echo $rowsHospedaje['titulo'];?></h2></span>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="7" cols="80" ><?php echo $rowsHospedaje['descripcion']; ?></textarea>
          </div>
          <div id="ofertar">
            <span><h4>Inicio Semana</h4><h4><?php echo $rowsFechas['inicioSemana'];?></h4></span>
            <span><h4>Precio Actual  $<?php echo $rowsSubasta['precio'];?></h4></span>
            <?php  if (isset($_SESSION['idUsuario'])){ ?><a href="ofertar.php?id=<?php echo $rowsSubasta['idSubasta'];?>" class="btn btn-block btn-lg btn-success">OFERTAR!</a><?php } ?>
          </div>
        </div>
        <?php
      }
         ?>
      </div>
      <div id="pie">
        <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
      </div>
    </div>
  </body>
</html>
