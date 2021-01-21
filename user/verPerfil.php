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
      <?php
      if (isset($_GET['return'])) { ?>
            <a class="btn btn-primary" style="font-size:13pt;" href="<?php echo $_GET['return']; if (isset($_GET['id'])) { echo '&id='.$_GET['id'];}?>">Atras</a>
            <?php
      }
      ?>
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
        if  (isset($_GET['mod'])){
        ?> <div id="exito">
          <label>El Usuario se Modifico con <strong>éxito</strong></label>
          </div> <?php
        }
        ?>
    <div class="row" style="max-width:100%">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                      <?php echo '<img style="margin-top:60px;margin-left:10px;" src="../images/'.$rows['imagenData'].'" alt="Imagen'.$rows['mail'].'" width="190" height="200" />';?>
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h1 style="font-size:25pt">
                            <?php echo $rows['apellido'].', '.$rows['nombre'];?></h1>
                        <small><cite title="<?php echo $rows['nacionalidad'];?>" style="font-size:25pt;"><?php echo $rows['nacionalidad']; ?> <i class="glyphicon glyphicon-map-marker">
                        </i></cite></small>
                        <p style="font-size:18pt;">
                            <i class="glyphicon glyphicon-envelope"></i><?php echo $rows['mail'];?>
                            <br />
                            <i class="glyphicon glyphicon-gift"></i><?php echo $rows['fechaNac']; ?>
                            <br />
                            <i class="glyphicon glyphicon-info-sign"></i><?php echo $rows['tokens']; ?> Tokens
                            <br />
                            <i class="glyphicon glyphicon-credit-card"></i><?php echo '****-****-****-'.(1000%$rows['tarjeta']); ?>
                            <br />
                            <?php
                            switch ($rows['tipo']) {
                              case 1: ?>
                              <i class="glyphicon glyphicon-bookmark"></i>Administrador
                              <br />
                              <?php
                              break;
                              case 2: ?>
                              <i class="glyphicon glyphicon-bookmark"></i>Basico
                              <br />
                              <?php
                              break;
                              case 3: ?>
                              <i class="glyphicon glyphicon-bookmark"></i>Premium
                              <br />
                              <?php
                              break;
                            }
                             ?>
                            <i class="glyphicon glyphicon-pencil"></i><a href="modificar.php?id=<?php echo $rows['idUsuario'];?>"> Modificar Informacion</a>
                          </p>
                        <!-- Split button -->

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <?php
            $sqlNotificaciones = "Select * FROM notificaciones WHERE idUsuario=".$rows['idUsuario']." AND oculta = 0 ORDER BY idNotificacion DESC LIMIT 6";
            $resultadoNotificaciones = mysqli_query($con,$sqlNotificaciones);
           ?>
          <h2>Notificaciones Pendientes (<?php echo mysqli_num_rows($resultadoNotificaciones);?>) - <a href="verNotificaciones.php">Ver Notificaciones Pendientes </a></h2>
        </div>
    </div>
</div>

      <div id="pie">
        <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
      </div>
    </div>

	</body>
</html>
