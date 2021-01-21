<!DOCTYPE html>
<html>
  <head>
    <link rel="apple-touch-icon" sizes="180x180" href="../../Logos/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../Logos/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../Logos/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="../../Logos/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <title>Home Switch Home Site</title>
    <!--<link rel="shortcut icon" href="favico.ico"/>-->
    <link type="text/css" rel="stylesheet" href="../../style.css" media="all">



<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../../vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="../../css/landing-page.min.css" rel="stylesheet">


    </head>
  <body>
    <div class="container">
    	    <nav class="navbar navbar-light bg-light static-top">
      <a class="navbar-brand" href="../../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../../Logos/HSH-Complete.svg" width="200px"></a>
      <a class="btn btn-primary" href="../Index.php">Volver al Listado </a>
      <a class="btn" href="../../user/verPerfil.php"><?php session_start(); echo $_SESSION['apellido'].", ".$_SESSION['nombre'] ?></a>
            <a href="../../user/verPerfil.php"><img class="logo" src="../../Logos/descarga.jpg" width="60px"></a>
            <a class="btn btn-danger" href="../../user/services/ServicesLogOut.php">Cerrar Sesion</a>
</nav>
<h1 style="text-align:center"> Hopedajes en solicitud a Hotsale </h1>

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
   require_once("../controlador/dbConfig.php");
		$sqlSubasta = "SELECT * FROM Subasta inner join hospedaje ON (Subasta.idHospedaje = hospedaje.idHospedaje) inner join fechasDisponibles ON (Subasta.idFecha = fechasDisponibles.idFecha) WHERE Subasta.estado=5";
		$resultado = mysqli_query($con,$sqlSubasta);
    while ($res = mysqli_fetch_array($resultado)){ ?>
      <table style="float:left; margin-left:25px;margin-top:5px; border:2px solid  #909497 ">
        <th style="width:95px">
      <form action="services/ServiceCrearHotsale.php" method="POST">
        <input type="hidden" name="idF" value="<?php echo $res['idFecha'];?>" />
        <input type="hidden" name="idH" value="<?php echo $res['idHospedaje'];?>" />
        <TR ALIGN=CENTER><td colspan="2"> <img src="../../images/<?php echo $res['imagenData'];?>" width="100" height="90"> </td></TR>
			 	<TR ALIGN=CENTER><TH>NOMBRE</TH><td class="table-primary"> <?php echo $res['titulo'];?></td></TR>
			 	<TR ALIGN=CENTER><TH>SEMANA</TH><td class="table-primary"><?php echo $res['inicioSemana'];?></td></TR>
        <TR ALIGN=CENTER><TH>PRECIO</TH><td class="table-primary">$<input type="number" name="precio" required/></td></TR>
			 	<TR ALIGN=CENTER><TH></TH><td class="table-primary"><input type="submit" class="btn btn-success" onclick="return confirmation()" value="Aceptar">
          <a class="btn btn-danger" href='services/ServiceCancelarHotsale.php?id=<?php echo $res['idSubasta']; ?>'onclick="return rechazar()">Rechazar</a></td></tr>
     </form>
</th>
</table>
        <?php }
        if (mysqli_num_rows($resultado) == 0 ){
          echo '<h4>No hay solicitudes de hotsale pendientes';
        }
         ?>

<script>
              function confirmation() {
      return confirm('Esta seguro que desea crear un Hotsale?');
    }
    function rechazar() {
      return confirm('Esta seguro que desea rechazar esta solicitud a Hotsale? Se eliminara toda informacion correspondiente a esta fecha para este hospedaje');
    }
              </script>


</body>
</html>
