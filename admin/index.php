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
    <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../Logos/HSH-Complete.svg" width="200px"></a>
      <a class="btn btn-primary" href="../">Atras</a>
      <a class="btn" href="../user/verPerfil.php"><?php session_start(); echo $_SESSION['apellido'].", ".$_SESSION['nombre'] ?></a>
            <a href="../user/verPerfil.php"><img class="logo" src="../Logos/descarga.jpg" width="60px"></a>
            <a class="btn btn-danger" href="../user/services/ServicesLogOut.php">Cerrar Sesion</a>

</div>
</nav>
 <table class="table table">
<th>
	<TR ALIGN=CENTER ><td class="table-primary"> <a href="../user/verUsuarios.php"> VER USUARIOS </a></td></TR>
	<TR><td></td></TR>
	<TR ALIGN=CENTER ><td class="table-primary"> <a href="solicitudes.php">VER SOLICITUDES DE PREMIUM </a></td></TR>
</th>
</table>
</body>
</html>
