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

    <meta charset="ISO-8859-1">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <title>Home Switch Home Site</title>
    <!--<link rel="shortcut icon" href="favico.ico"/>-->
    <!--<link type="text/css" rel="stylesheet" href="style.css" media="all"> -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="../css/landing-page.min.css" rel="stylesheet">
    </head>
  <body>
    <div id="condenido">
      <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../Logos/HSH-Complete.svg" width="200px"></a>
      <a class="btn btn-primary" style="font-size:13pt;" href="verPerfil.php">Atras</a>
      <a class="btn btn-danger" href="services/ServicesLogOut.php" style="font-size:13pt;">Cerrar Sesion</a>
    </div>
  </nav>
    <?php
    session_start();
    require_once('../hospedajes/controlador/dbConfig.php');
    $sql = "SELECT * FROM usuarios WHERE idUsuario = ".$_SESSION['idUsuario'];
    $resultado = mysqli_query($con,$sql);
    $rows = mysqli_fetch_array($resultado);
    ?>
      <div class="container2">
          <?php
            $sqlNotificaciones = "Select * FROM notificaciones WHERE idUsuario=".$rows['idUsuario']." AND oculta = 0 ORDER BY idNotificacion DESC";
            if (isset($_GET['todas'])){
              $sqlNotificaciones = "Select * FROM notificaciones WHERE idUsuario=".$rows['idUsuario']." ORDER BY idNotificacion DESC";
            }
            $resultadoNotificaciones = mysqli_query($con,$sqlNotificaciones);
           ?>
          <?php if(!isset($_GET['todas'])) { ?><h2>Area de Notificaciones Pendientes (<?php echo mysqli_num_rows($resultadoNotificaciones);?>) </h2> <?php } ?><h2>
            <?php
            if (mysqli_num_rows($resultadoNotificaciones)==0){
              echo '<h2> No posee notificaciones</h2>';
            }else{
              while ($rowsNotificaciones = mysqli_fetch_array($resultadoNotificaciones)){
                switch ($rowsNotificaciones['tipo']) {
                  case '1':
                    ?> <div class="alert alert-success" style="height:45px;font-size:13pt">
                    <span class="alert-link"><?php echo $rowsNotificaciones['notificacion']; ?> </span>
                    <?php
                    if (!isset($_GET['todas'])){
                      ?>
                      <a class="btn btn-danger" href="services/OcultarNotificacion.php?id=<?php echo $rowsNotificaciones['idNotificacion'];?>">X</a>
                      <?php
                    }
                    ?>
                  </div>
                  <?php
                    break;
                  case '2':
                  ?> <div class="alert alert-danger" style="height:45px;font-size:13pt">
                  <span class="alert-link"><?php echo $rowsNotificaciones['notificacion']; ?> </span>
                  <?php
                  if (!isset($_GET['todas'])){
                    ?>
                    <a class="btn btn-danger" href="services/OcultarNotificacion.php?id=<?php echo $rowsNotificaciones['idNotificacion'];?>">X</a>
                    <?php
                  }
                  ?>
                </div>
                <?php
                  break;
                  case '3':
                  $sqlSubasta = "SELECT Subasta.*, hospedaje.titulo FROM Subasta inner join hospedaje on (Subasta.idHospedaje = hospedaje.idHospedaje) WHERE Subasta.idSubasta=".$rowsNotificaciones['idSubasta'];
                  $resultadoSubasta = mysqli_query($con,$sqlSubasta);
                  $SubastaRows = mysqli_fetch_assoc($resultadoSubasta);
                  ?> <div class="alert alert-warning" style="height:45px;font-size:13pt">
                  <span class="alert-link"><?php echo $rowsNotificaciones['notificacion']." ".$SubastaRows['titulo'];
                  if ($_SESSION['idUsuario'] != 0 ) {
                    echo "<a href='../subastas/ofertar.php?id=".$SubastaRows['idSubasta']."'> ¡OFERTAR! </a>";
                  }
                  else {
                    echo "<a href='../subastas/ofertar.php?id=".$SubastaRows['idSubasta']."'> Ver Subasta </a>";
                  }
                  ?>
                </span>
                  <?php
                  if (!isset($_GET['todas'])){
                    ?>
                    <a class="btn btn-danger" href="services/OcultarNotificacion.php?id=<?php echo $rowsNotificaciones['idNotificacion'];?>">X</a>
                    <?php
                  }
                  ?>
                </div>
                <?php
                  break;
                  case '4':
                  ?> <div class="alert alert-warning" style="height:45px;font-size:13pt">
                  <span class="alert-link"><?php echo ($rowsNotificaciones['notificacion']); ?> </span>
                  <?php
                  if (!isset($_GET['todas'])){
                    ?>
                    <a class="btn btn-danger" href="services/OcultarNotificacion.php?id=<?php echo $rowsNotificaciones['idNotificacion'];?>">X</a>
                    <?php
                  }
                  ?>
                </div>
                <?php
                  break;
                  case '5':
                  ?> <div class="alert alert-success" style="height:45px;font-size:13pt">
                  <span class="alert-link"><?php echo ($rowsNotificaciones['notificacion']); ?> <a class="btn btn-primary" href="../admin/solicitudes.php">Ver solicitudes a Premium</a></span>
                  <?php
                  if (!isset($_GET['todas'])){
                    ?>
                    <a class="btn btn-danger" href="services/OcultarNotificacion.php?id=<?php echo $rowsNotificaciones['idNotificacion'];?>">X</a>
                    <?php
                  }
                  ?>
                </div>
                <?php
                  break;
                  case '6':
                  ?> <div class="alert alert-danger" style="height:45px;font-size:13pt">
                  <span class="alert-link"><?php echo ($rowsNotificaciones['notificacion']); ?> </span>
                  <?php
                  if (!isset($_GET['todas'])){
                    ?>
                    <a class="btn btn-danger" href="services/OcultarNotificacion.php?id=<?php echo $rowsNotificaciones['idNotificacion'];?>">X</a>
                    <?php
                  }
                  ?>
                </div>
                <?php
                  break;
                  case '7':
                  ?> <div class="alert alert-success" style="height:45px;font-size:13pt">
                  <span class="alert-link"><?php echo ($rowsNotificaciones['notificacion']); ?> </span>
                  <?php
                  if (!isset($_GET['todas'])){
                    ?>
                    <a class="btn btn-danger" href="services/OcultarNotificacion.php?id=<?php echo $rowsNotificaciones['idNotificacion'];?>">X</a>
                    <?php
                  }
                  ?>
                </div>
                <?php
                  break;
                  case '8':
                  ?> <div class="alert alert-success" style="height:45px;font-size:13pt">
                  <span class="alert-link"><?php echo ($rowsNotificaciones['notificacion']); ?> </span>
                  <?php
                  if (!isset($_GET['todas'])){
                    ?>
                    <a class="btn btn-danger" href="services/OcultarNotificacion.php?id=<?php echo $rowsNotificaciones['idNotificacion'];?>">X</a>
                    <?php
                  }
                  ?>
                </div>
                <?php
                  break;
                  case '9':
                  ?> <div class="alert alert-danger" style="height:45px;font-size:13pt">
                  <span class="alert-link"><?php echo ($rowsNotificaciones['notificacion']); ?> </span>
                  <?php
                  if (!isset($_GET['todas'])){
                    ?>
                    <a class="btn btn-danger" href="services/OcultarNotificacion.php?id=<?php echo $rowsNotificaciones['idNotificacion'];?>">X</a>
                    <?php
                  }
                  ?>
                </div>
                <?php
                  break;
                }
                $sqlVisto = "UPDATE notificaciones SET visto = 1 WHERE idNotificacion=".$rowsNotificaciones['idNotificacion'];
                $resultado = mysqli_query($con,$sqlVisto);
                }
            }
            if (!isset($_GET['todas'])){
              echo '<h2><a href="verNotificaciones.php?todas=1">Ver Todas las Notificaciones</a></h2>';
            }

            ?>

      </div>
    </div>
</div>

      <div id="pie">
        <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
      </div>
    </div>

	</body>
</html>
