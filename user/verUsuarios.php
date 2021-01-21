<html>
  <head>

    <meta charset="ISO-8859-1">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <title>Home Switch Home Site</title>
    <!--<link rel="shortcut icon" href="favico.ico"/>-->
    <!--<link type="text/css" rel="stylesheet" href="style.css" media="all"> -->



<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="../css/landing-page.min.css" rel="stylesheet">
    </head>
  <body>
      <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../Logos/HSH-Complete.svg" width="200px"></a>
      <a class="btn btn-primary" href="../admin/index.php">Atras</a>
      <a class="btn"><?php session_start(); echo $_SESSION['apellido'].", ".$_SESSION['nombre'] ?></a>
      <a class="btn btn-danger" href="services/ServicesLogOut.php">Cerrar Sesion</a>
    </div>
	<div id="condenido">
        <h1 class="mb-5">Ver Usuarios</h1>

    <table class="table table">



		<?php

		require_once("../hospedajes/controlador/dbConfig.php");
		$usuario = "SELECT * FROM usuarios WHERE tipo>=2";
		$resultado = mysqli_query($con,$usuario);
    while ($res = mysqli_fetch_array($resultado)){ ?>
     <table style="float:left; margin-left:25px;margin-top:5px; border:2px solid  #909497 ">
      <th>
        <TR ALIGN=CENTER><td colspan="2"> <img src="../images/<?php echo $res['imagenData'];?>" width="100" height="90"> </td></TR>
			 	<TR ALIGN=CENTER><TH>NOMBRE</TH><td class="table-primary"> <?php echo $res['nombre'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>APELLIDO</TH><td class="table-primary"> <?php echo $res['apellido'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>MAIL</TH><td class="table-primary"> <?php echo $res['mail'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>NACIONALIDAD</TH><td class="table-primary"> <?php echo $res['nacionalidad'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>FECHA DE NACIMIENTO</TH><td class="table-primary"><?php echo $res['fechaNac'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>TARJETA</TH><td class="table-primary"><?php echo $res['tarjeta'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>TOKENS</TH><td class="table-primary"> <?php echo $res['tokens'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>TIPO</TH><td class="table-primary"> <?php
                 if($res['tipo']==2){
                 		echo "Clasico"; }elseif($res['tipo']==3){echo "Premium";};?></td></TR>
                  </th>
                </table>

<?php } ?>

      </div>
      <div id="pie">
        <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
      </div>
    </div>

	</body>
</html>
