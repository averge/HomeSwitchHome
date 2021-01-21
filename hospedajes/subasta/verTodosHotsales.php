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
    <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../../Logos/HSH-Complete.svg" width="200px"></a>

            <?php
              session_start();
              if (isset($_SESSION['idUsuario'])){
                if($_SESSION['tipo']==1){?>
                  <a class="btn btn-primary" href="../Index.php">Volver al Listado de hospedajes</a>
                  <a class="btn btn-primary" href="verSolicitudesHotsale.php">Solicitudes a Hotsale</a>
                    <?php
                  }
                 ?>
                 <div id="perfil">
                 <a class="btn" href="../../user/verPerfil.php"><?php echo $_SESSION['apellido'].", ".$_SESSION['nombre'] ?></a>
                 <?php
                 for ($i=0;$i<$_SESSION['tokens'];$i++) {
                 ?>
                 <img src="../../Logos/coin.png" width="25px" height="25px" alt="coin">
                   <?php
                 } ?>
                 <a href="../../user/verPerfil.php"><img class="logo" src="../../images/<?php echo $_SESSION['imagen'];?>" width="60px"></a>
                 </div>
            <a class="btn btn-danger" href="../../user/services/ServicesLogOut.php">Cerrar Sesion</a>
        <?php
              }else{
             ?>
            <a class="btn btn-primary" href="../../user/login.php">Iniciar Sesion</a>
          <?php } ?>
        </div>
      </nav>
      <div id="condenido">
        <h1 class="mb-5">Listado de Hotsales</h1>
        <?php
        if  (isset($_GET['eliminar'])){
        ?> <div id="delete">
          <label>El hotsale se ELIMINO con <strong>éxito</strong></label>
          </div> <?php
        }
        ?>
        <table class="table table">
         <thead>
           <tr>
               <th scope="col">Id</th>
               <th scope="col">Imagen</th>
               <th scope="col">Titulo</th>
               <th scope="col">Precio</th>
               <th scope="col">Fecha para usar</th>
               <th scope="col"></th>
           </tr>
         </thead>
          <?php
          require_once("../controlador/dbConfig.php");
          $sql = "SELECT * FROM hotsale inner join hospedaje ON (hotsale.idHospedaje = hospedaje.idHospedaje) inner join fechasDisponibles ON (hotsale.idFecha = fechasDisponibles.idFecha) WHERE hotsale.estado = 1 ORDER BY fechasDisponibles.inicioSemana ASC";
          $resultado = mysqli_query($con,$sql);
          while ($rows = mysqli_fetch_array($resultado)){
              ?>
              <tr>
                <td class="table-warning"><?php echo $rows['idHotsale'];?></td>
                <td class="table-warning"><?php echo '<img src="../../images/'.$rows['imagenData'].'" alt="Imagen'.$rows['titulo'].'" width="150" height="150" />';?></td>
                <td class="table-warning"><?php echo $rows['titulo'];?></td>
                <td class="table-warning"><?php echo $rows['precio'];?></td>
                <td class="table-warning"><?php echo $rows['inicioSemana'];?></td>
                <td class="table-warning"><a class="btn btn-danger" href="services/servicesEliminarHotsale.php?id=<?php echo $rows['idHotsale'];?>" onclick="return eliminar()"> Eliminar </a>
              </tr>
          <?php
          }
           ?>
       </table>
      </div>
      <script>
      function eliminar() {
        return confirm('¿Seguro desea eliminar este Hotsale de manera permanente?')
      }
      </script>
      <div id="pie">
        <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
      </div>
    </div>
  </body>
</html>
