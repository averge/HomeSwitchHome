<!DOCTYPE html>
<html>
  <head>
    <link rel="apple-touch-icon" sizes="180x180" href="Logos/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Logos/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Logos/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="Logos/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
    <title>Home Switch Home Site</title>
    <!--<link rel="shortcut icon" href="favico.ico"/>-->
    <link type="text/css" rel="stylesheet" href="style.css" media="all">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">
<!--<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    </head>
  <body>
    <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="#"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="Logos/HSH-Complete.svg" width="200px"></a>
        <?php   session_start();
        ?>
        <a href="buscador/ServicesBuscar.php?tipo=Todos">Listado Hospedajes</a>
        <?php
        if (isset($_SESSION['idUsuario'])){
      if($_SESSION['tipo']==1){?>
          <a href="hospedajes/Index.php">Gestion Hospedajes</a>
          <a href="admin/index.php">ADMINISTRADOR </a>
          <?php
        } else { ?>
            <?php } ?>
            <div id="perfil">
            <a class="btn" href="user/verPerfil.php"><?php echo $_SESSION['apellido'].", ".$_SESSION['nombre'] ?></a>
            <?php
            for ($i=0;$i<$_SESSION['tokens'];$i++) {
            ?>
            <img src="Logos/coin.png" width="25px" height="25px" alt="coin">
              <?php
          } ?>
            <a href="user/verPerfil.php"><img class="logo" src="images/<?php echo $_SESSION['imagen']; ?>" width="60px"></a>
            <?php
              require_once('hospedajes/controlador/dbConfig.php');
              if ($_SESSION['tipo'] == 1){
                $sqlNotificaciones="Select * from notificaciones where idUsuario=".$_SESSION['idUsuario']." AND visto=0";
              }
              else{
                $sqlNotificaciones="Select * from notificaciones where idUsuario=".$_SESSION['idUsuario']." AND visto=0";
              }
              $resultadoNotificaciones=mysqli_query($con,$sqlNotificaciones);
              if (mysqli_num_rows($resultadoNotificaciones)>0){
                ?>
                <a href="user/verNotificaciones.php"><img class="logo" src="Logos/notification-active.png" width="50px"></a>
                <?php
              } else {
                ?>
                <a href="user/verNotificaciones.php"><img class="logo" src="Logos/notification.png" width="50px"></a>
                <?php
              }
             ?>
          </div>
           <a class="btn btn-danger" href="user/services/ServicesLogOut.php" >Cerrar Sesion</a>
  <?php
        }else{
       ?>
      <a class="btn btn-primary" href="user/login.php">Iniciar Sesion</a>
    <?php } ?>
    </div>
  </nav>
  <header class="masthead text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">Bienvenidos a nuestro sitio web!</h1>
      </div>
      <div class="col-xl-9 mx-auto">
        <form class="form-inline" action="buscador/ServicesBuscar.php" method="POST" onsubmit="return verificar()">
                <input type="text" id="buscadorNombre" name="buscadorNombre" class="form-control form-control-lg" placeholder="Ingrese nombre o Lugar" >
                <input type="date" id="buscadorFechaInicio" name="buscadorFechaInicio" class="form-control form-control-lg" placeholder="Seleccione Fecha (opcional)" >
                <input type="date" id="buscadorFechaFin" name="buscadorFechaFin" class="form-control form-control-lg" placeholder="Seleccione Fecha (opcional)" >
                <input type="hidden" name="tipo" value="Todos">
              <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
      </div>
      <div class="col-xl-9 mx-auto">
        <form class="form-inline" >
        <small style="margin-left: 300px;font-size: 13pt;font-style:bold;color:white">Ingrese Fecha Inicio</small>
        <small style="margin-left: 40px;font-size: 13pt;font-style:bold;color:white">Ingrese Fecha Fin</small>
      </form>
      </div>
      <?php
        if (isset($_GET['yaSolicito'])){
          ?>
          <script>
          alert('Su solicitud se encuentra pendiente, recibira una notificacion cuando sea aceptada o rechazada');
          </script>
          <?php
        }
       ?>
        <script>
        function verificar(){
          var nombre = document.getElementById("buscadorNombre").value;
          var fechaInicio = document.getElementById("buscadorFechaInicio").value;
          var fechaFin = document.getElementById("buscadorFechaFin").value;

          if (fechaInicio.trim().length !== 0) {
            if (fechaFin.trim().length === 0){
              alert("Debe completar seleccionar fecha de Fin");
              return false;
            }
          }
          if (fechaFin.trim().length !== 0) {
            if (fechaInicio.trim().length === 0){
              alert("Debe completar seleccionar fecha de Inicio");
              return false;
            }
            else {
              var hoy = new Date();
              var dd = hoy.getDate();
              var mm = hoy.getMonth()+1;
              var yyyy = hoy.getFullYear();
              if(dd<10) {
                dd='0'+dd;
              }
              if(mm<10) {
                mm='0'+mm;
              }
              var dia = yyyy+'-'+mm+'-'+dd;
              if (fechaFin < fechaInicio) {
                alert("La fecha de Fin debe ser posterior o igual a la fecha de inicio");
                return false;
              }
              else {
                if (fechaInicio < dia){
                  alert("La fecha de Inicio debe ser posterior a la fecha de Hoy: "+dia);
                  return false;
                }
              }
            }
          }
          if (nombre.trim().length === 0 && fechaInicio.trim().length === 0 && fechaFin.trim().length === 0 ){
            alert("Debe completar al menos uno de los campos");
            return false;
          }
          else {
            return true;
          }
        }
        </script>
    </div>
  </div>
</header>
<!-- Icons Grid -->
  <section class="features-icons bg-light text-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <a class="icono" href="buscador/ServicesBuscar.php?tipo=Hotsale">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-tag m-auto text-primary"></i>
            </div>
            <h3>HOTSALE!</h3>
            <p class="lead mb-0">Sea cualquier tipo de ususario compre ahora mismo en nustra seccion de ofertas hotsale!</p>
          </div>
        </a>
        </div>
        <div class="col-lg-4">
          <a class="icono" href="buscador/ServicesBuscar.php?tipo=Subasta">
          <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-home m-auto text-primary"></i>
            </div>
            <h3>Compre por subastas</h3>
            <p class="lead mb-0">Usted podra adquirir propiedades a través de subastas</p>
          </div>
        </a>
        </div>
        <?php  if (isset($_SESSION['tipo'])){
          if ($_SESSION['tipo']!=1){
        if(isset($_SESSION['solicitud'])) { if ($_SESSION['solicitud']==2){?>
        <div class="col-lg-4">
          <a class="icono"href="admin/pasate.php" onclick="return confirmation()" >
          <div class="features-icons-item mx-auto mb-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-plus m-auto text-primary"></i>
            </div>
            <h3>Pasate a premium</h3>
            <p class="lead mb-0">Pasate a usuario premium a disfruta de todos sus beneficios</p>
          </div>
        </a>
        </div>
      <?php } else { if ($_SESSION['solicitud']==3) {?>
        <div class="col-lg-4">
          <div class="features-icons-item mx-auto mb-0 mb-lg-3">
            <div class="features-icons-icon d-flex">
              <i class="icon-clock m-auto text-primary"></i>
            </div>
            <h3>Solicitud a Premium pendiente</h3>
            <p class="lead mb-0">Ya tenes los beneficos de premium o tu solicitu esta pendinte</p>
          </div>
        </div>
     <?php } else {
       if ($_SESSION['solicitud']==1){
         ?>
           <div class="col-lg-4">
             <div class="features-icons-item mx-auto mb-0 mb-lg-3">
               <div class="features-icons-icon d-flex">
                 <i class="icon-star m-auto text-primary"></i>
               </div>
               <h3>Ya eres usuario Premium</h3>
               <p class="lead mb-0">Ya tenes los beneficos de premium</p>
             </div>
           </div>
        <?php
       }
     }
    }
   }

 }
}
   ?>

      </div>
    </div>
                  <script>
              function confirmation() {
      return confirm('Esta seguro que desea solicitar pasarse a premium?');
    }
              </script>

  </section>
      <div id="pie">
        <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
      </div>
    </div>

      <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
