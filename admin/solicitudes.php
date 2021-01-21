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


    </head>
  <body>
    <div class="container">
    	    <nav class="navbar navbar-light bg-light static-top">
      <a class="navbar-brand" href="../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../Logos/HSH-Complete.svg" width="200px"></a>
      <a class="btn btn-primary" href="../user/verUsuarios.php">Ver Usuarios </a>
      <a class="btn btn-primary" href="index.php">Atras </a>
      <a class="btn" href="../user/verPerfil.php"><?php session_start(); echo $_SESSION['apellido'].", ".$_SESSION['nombre'] ?></a>
            <a href="../user/verPerfil.php"><img class="logo" src="../Logos/descarga.jpg" width="60px"></a>
            <a class="btn btn-danger" href="../user/services/ServicesLogOut.php">Cerrar Sesion</a>
</nav>
   <table class="table table">

      <?php
          if  (isset($_GET['exito'])){
          ?> <div id="exito">
            <label>El usuario ahora es  <strong> PREMIUM </strong></label>
            </div> <?php
            }
          if  (isset($_GET['rechazo'])){
          ?> <div id="delete">
            <label>El usuario fue  <strong> RECHAZADO </strong></label>
            </div> <?php
            } ?>
	<?php
   require_once("../hospedajes/controlador/dbConfig.php");
		$usuario = "SELECT * FROM usuarios WHERE solicitud=3";
		$resultado = mysqli_query($con,$usuario);
    while ($res = mysqli_fetch_array($resultado)){ ?>
      <table style="float:left; margin-left:25px;margin-top:5px; border:2px solid  #909497 ">
      <th style="width:95px">
        <TR ALIGN=CENTER><td colspan="2"> <img src="../images/<?php echo $res['imagenData'];?>" width="100" height="90"> </td></TR>
			 	<TR ALIGN=CENTER><TH>NOMBRE</TH><td class="table-primary"> <?php echo $res['nombre'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>APELLIDO</TH><td class="table-primary"> <?php echo $res['apellido'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>MAIL</TH><td class="table-primary"> <?php echo $res['mail'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>NACIONALIDAD</TH><td class="table-primary"> <?php echo $res['nacionalidad'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>FECHA DE NACIMIENTO</TH><td class="table-primary"><?php echo $res['fechaNac'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>TARJETA</TH><td class="table-primary"><?php echo $res['tarjeta'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>TOKENS</TH><td class="table-primary"> <?php echo $res['tokens'];?></td></TR>
			 	<TR ALIGN=CENTER><TH></TH><td class="table-primary"><a class="btn btn-success" href='aceptar.php?id=<?php echo $res['idUsuario']; ?>'onclick="return confirmation()">Aceptar</a><a class="btn btn-danger" href='rechazar.php?id=<?php echo $res['idUsuario']; ?>'onclick="return rechazar()">Rechazar</td>
      </th>
    </table>
        <?php } ?>

<script>
              function confirmation() {
      return confirm('Esta seguro que desea aceptar a este usuario como Premium?');
    }
    function rechazar() {
      return confirm('Esta seguro que desea rechazar a este usuario como Premium?');
    }
              </script>


</body>
</html>
