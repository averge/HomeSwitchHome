<!DOCTYPE html>
<html>
  <head>

    <meta charset="ISO-8859-1">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <title>Home Switch Home Site</title>
    <!--<link rel="shortcut icon" href="favico.ico"/>-->
    <!--<link type="text/css" rel="stylesheet" href="style.css" media="all"> -->



<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../../style.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../../vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="../css/landing-page.min.css" rel="stylesheet">
    </head>
  <body>
    <?php
    require_once("../controlador/dbConfig.php");
    $sqlHospedaje = "SELECT * FROM hospedaje WHERE idHospedaje=".$_GET['id'];
    $resultadoHospedaje = mysqli_query($con,$sqlHospedaje);
    $rowsHospedaje = mysqli_fetch_assoc($resultadoHospedaje);
    $sqlFechas="SELECT idFecha,inicioSemana FROM fechasDisponibles WHERE idHospedaje=".$_GET['id']." ORDER BY inicioSemana DESC";
    $resultadoFechas = mysqli_query($con,$sqlFechas);
    if (isset($_GET['fecha'])){
      ?>
      <script>
      alert('Lo sentimos, no se pueden crear los 6 meses de inscripciones debido a que la fecha caducó. Ahora este hospedaje se encuentra en solicitud para ser Hotsale!');
      </script>
      <?php
    }
    ?>
      <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../../Logos/HSH-Complete.svg" width="200px"></a>

      <a href="../Index.php" class="btn btn-primary">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver al Listado
      </a>
      <?php
          session_start();?>
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
          <a class="btn btn-danger" href="../../user/services/ServicesLogOut.php">Cerrar Sesion</a>        </div>
  </nav>
  <div class="container-fluid">
      <div class="content-wrapper">
      <div class="item-container">
        <div class="container">
          <div class="col-md-16">
          <h2 style="text-align:center;"> <?php echo $rowsHospedaje['titulo'];?> </h2>
          <div class="product col-md-5 service-image-left">
            <center>
              <img id="item-display" src="../../images/<?php echo $rowsHospedaje['imagenData'];?>" alt="Foto hospedaje" title="fotografia" width="400px" height="283px" style="margin-left:355px"></img>
            </center>
          </div>
        </div>
          <div class="col-md-12">
            <ul class="fechas">
              <?php
            while ($rowsFechas = mysqli_fetch_array($resultadoFechas)) {
              $sqlSubasta="SELECT * FROM Subasta WHERE idHospedaje=".$_GET['id']." AND idFecha=".$rowsFechas['idFecha'];
              $resultadoSubasta = mysqli_query($con,$sqlSubasta);
              if (mysqli_num_rows($resultadoSubasta) == 1){
                $rowsSubasta = mysqli_fetch_assoc($resultadoSubasta);
                switch ($rowsSubasta['estado']) {
                  case 1:
                  date_default_timezone_set('America/Argentina/Buenos_Aires');
                  $dateAux = new DateTime($rowsSubasta['fechaFin']);
                  $dateAux = $dateAux->format('Y-m-d h:i:s');
                  $date = date('m/d/Y h:i:s', time());
                  $date = new DateTime($date);
                  $date = $date->format('Y-m-d h:i:s');
                  if ($date >= $dateAux){
                    ?>
                      <form name="myForm" id="myForm" action="../../buscador/terminarSubasta.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $rowsSubasta['idSubasta'] ?>" />
                        <input type="hidden" name="crear" value="1" />
                        </form>
                        <script>
                            var auto_refresh = setInterval(
                            function()
                            {
                            submitform();
                          }, 0);

                            function submitform()
                            {
                              document.myForm.submit();
                            }
                            </script>
                            <?php
                  }
                  ?>
                  <div id="subasta1" style="background-color:#A9F5D0">
                  <form name="form" action="../../buscador/terminarSubasta.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $rowsSubasta['idSubasta'];?>">
                    <input type="hidden" name="crear" value="1" />
                    <li style="text-align:center;font-size:19pt;list-style:none"><strong>SUBASTA ACTIVA</strong> Para Semana<input style="text-align:center;font-size:19pt" type="text" class="form-control" name="semana" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly /><h4>PRECIO ACTUAL $<?php echo $rowsSubasta['precio'];?></h4>
                      La subasta terminara automaticamente el
                      <input style="text-align:center;font-size:19pt;" type="text" class="form-control" name="semana" value="<?php echo $dateAux;?>" readonly />
                    <input type="submit" class="btn btn-danger" value="Terminar Subasta" /></li>
                  </form>
                  <a style="margin-top:7px" class="btn btn-warning" href="services/ServiceCancelarSubasta.php?idH=<?php echo $_GET['id'];?>&id=<?php echo $rowsSubasta['idSubasta'];?>"> ELIMINAR SUBASTA </a>
                </div>
                  <?php
                  break;
                  case 2:
                  $sqlUsuario = "SELECT idUsuario,nombre,apellido FROM usuarios WHERE idUsuario=".$rowsSubasta['idUsuario'];
                  $resultadoUsuario = mysqli_query($con,$sqlUsuario);
                  $rowsUsuario = mysqli_fetch_assoc($resultadoUsuario);
                  $USUARIO = $rowsUsuario['apellido'].', '.$rowsUsuario['nombre'];
                  ?>
                  <div id="subasta1" style="background-color:#81F79F">
                    <li style="text-align:center;font-size:19pt;list-style:none"> <strong>SUBASTA CON GANADOR</strong> Para semana<input style="text-align:center;font-size:19pt" type="text" class="form-control" name="semana" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly /><h4>PRECIO GANADOR $<?php echo $rowsSubasta['precio'];?></h4></li>
                    USUARIO GANADOR : <strong><?php echo $USUARIO; ?></strong>
                    <a href="verPerfil.php?id=<?php echo $rowsSubasta['idUsuario'];?>" class="btn btn-info"> Ver Perfil </a>
                  </div>
                  <?php
                  break;
                  case 3:
                  $sqlFila = "SELECT idFila FROM fila WHERE idSubasta=".$rowsSubasta['idSubasta'];
                  $resultadoFila = mysqli_query($con,$sqlFila);
                  $rowsfila = mysqli_fetch_assoc($resultadoFila);
                  $sqlCantidadFila = "SELECT count(*) as cantidad FROM detalleFila WHERE idFila = ".$rowsfila['idFila'];
                  $resultadoCantidadFila = mysqli_query($con,$sqlCantidadFila);
                  $rowsCantidadFila = mysqli_fetch_assoc($resultadoCantidadFila);
                  date_default_timezone_set('America/Argentina/Buenos_Aires');
                  $dateAux = new DateTime($rowsSubasta['fechaFin']);
                  $dateAux = $dateAux->format('Y-m-d h:i:s');
                  $date = date('m/d/Y h:i:s', time());
                  $date = new DateTime($date);
                  $date = $date->format('Y-m-d h:i:s');
                  if ($date >= $dateAux){
                    ?>
                      <form name="myForm" id="myForm" action="../../buscador/empezar.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $rowsSubasta['idSubasta'] ?>" />
                        <input type="hidden" name="crear" value="1" />
                        </form>
                        <script>
                            var auto_refresh = setInterval(
                            function()
                            {
                            submitform();
                          }, 0);

                            function submitform()
                            {
                              document.myForm.submit();
                            }
                            </script>
                            <?php
                  }
                  ?>
                  <div id="subasta1" style="background-color:#E1F5A9" >
                    <li style="text-align:center;font-size:19pt;list-style:none"><strong>Inscripciones abiertas</strong> Para semana<input style="text-align:center;font-size:19pt" type="text" class="form-control" name="semana" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly /><h4>PRECIO BASE $<?php echo $rowsSubasta['precio'];?></h4></li>
                    Hay un Total de : <strong><?php echo $rowsCantidadFila['cantidad']."</strong> INSCRIPTOS"; ?>
                    <form name="form" action="../../buscador/empezar.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $rowsSubasta['idSubasta'];?>" />
                      $<input style="text-align:center;font-size:15pt;width:130px" type="number" name="precio"<?php echo "value='".$rowsSubasta['precio']."'"; ?> required /> <input style="text-align:center;font-size:15pt" type="submit" class="btn btn-success" value="Iniciar 3 días de Subasta" /></li>
                    </form>
                  <span> La Subasta comenzara de manera automatica el </span>
                  <input style="text-align:center;font-size:19pt" type="text" class="form-control" name="semana" value="<?php echo $rowsSubasta['fechaFin'];?>" readonly />
                  </div>
                  <?php
                  break;
                  case 4:
                  ?>
                  <div id="subasta1" style="background-color:#FA8258">
                    <li style="text-align:center;font-size:19pt;list-style:none"><strong>SUBASTA SIN GANADOR</strong> Para semana<input style="text-align:center;font-size:19pt" type="text" class="form-control" name="semana" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly /><h4>PRECIO BASE $<?php echo $rowsSubasta['precio'];?></h4></li>
                    <form name="form" action="solicitarHotsale.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $rowsSubasta['idSubasta'];?>" />
                      <input type="hidden" name="idH" value="<?php echo $_GET['id'];?>" />
                      <h4>La subasta no tuvo ofertas, puede solicitar el hotsale de esta propiedad en esta fecha con solo un click</h4>
                    <input type="submit" class="btn btn-success" value="Solicitar Ser Hotsale">
                    </li>
                    </form>
                  </div>
                  <?php
                  break;
                  case 5:
                  ?>
                <div id="subasta1" style="background-color:#F3F781">
                <form name="form" action="services/ServiceCrearHotsale.php" method="POST" style="margin-top:85px;">
                  <input type="hidden" name="idF" value="<?php echo $rowsFechas['idFecha'];?>" />
                  <input type="hidden" name="idH" value="<?php echo $_GET['id'];?>" />
                  <li style="text-align:center;font-size:19pt;list-style:none"> <strong>EN SOLICITUD A HOTSALE</strong> Para semana<input style="text-align:center;font-size:19pt" type="text" class="form-control" name="semana" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                  <a href="verSolicitudesHotsale.php" class="btn btn-success"> Ver Solicitudes a Hotsale </a>
                </form>
                </div>
                  <?php
                  break;
                  case 6:?>
                  <div id="subasta1" style="background-color:#FFFF00">
                    <div style="margin-top:85px;">
                    <input type="hidden" name="idF" value="<?php echo $rowsFechas['idFecha'];?>" />
                    <input type="hidden" name="idH" value="<?php echo $_GET['id'];?>" />
                    <li style="text-align:center;font-size:19pt;list-style:none"> <strong>EN HOTSALE</strong> Para semana<input style="text-align:center;font-size:19pt;background-color:#F3F781" type="text" class="form-control" name="semana" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                    <a href="verTodosHotsales.php?tipo=Hotsale" class="btn btn-success"> Ver Todos los Hotsale </a>
                  </div>
                </div><?php
                  break;
                  case 10:
                  date_default_timezone_set('America/Argentina/Buenos_Aires');
                  $dateAux = new DateTime($rowsFechas['inicioSemana']);
                  $dateAux = $dateAux->modify('-1 year');
                  $dateAux = $dateAux->format('Y-m-d h:i:s');
                  $dateDeUso = new DateTime($rowsFechas['inicioSemana']);
                  $date = date('Y/m/d h:i:s', time());
                  $date = new DateTime($date);
                  if ( $date <= $dateAux ) {?>
                    <form name="myForm" id="myForm" action="../ABM/services/ServicesEliminarSinPrecio.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $rowsSubasta['idSubasta'] ?>" />
                      </form>
                      <script>
                          var auto_refresh = setInterval(
                          function()
                          {
                          submitform();
                        }, 0);

                          function submitform()
                          {
                            document.myForm.submit();
                          }
                          </script>
                          <?php
                  }
                  ?>
                  <div id="subasta1">
                    <form name="form" action="services/setearPrecio.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $rowsSubasta['idSubasta'];?>" />
                      <li style="text-align:center;font-size:19pt;list-style:none"> Inicio de Semana<input style="text-align:center;font-size:19pt;" type="text" class="form-control" name="semana" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />$<input type="number" name="precio" placeholder="Ingrese precio" required /> <input type="submit" class="btn btn-success" value="Setear Valor"/>
                        Las Inscripciones comenzaran automaticamente el
                        <input style="text-align:center;font-size:19pt;" type="text" class="form-control" name="semana" value="<?php echo $dateAux;?>" readonly />
                        <span style="background-color:#F3F781 ;color:red;font-size:13pt"> Si no setea un valor antes de que comience la inscripcion se descartará</span>
                      </li>
                    </form>
                </div>
                <?php
                  break;
                  case 11:
                  date_default_timezone_set('America/Argentina/Buenos_Aires');
                  $dateAux = new DateTime($rowsSubasta['fechaFin']);
                  $dateAux = $dateAux->format('Y-m-d h:i:s');
                  $date = date('m/d/Y h:i:s', time());
                  $date = new DateTime($date);
                  $date = $date->format('Y-m-d h:i:s');
                  if ( $date >= $dateAux ) {
                    ?>
                    <form name="myForm" id="myForm" action="services/ServiceCrearInscripcion.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $rowsSubasta['idSubasta'] ?>" />
                      </form>
                      <script>
                          var auto_refresh = setInterval(
                          function()
                          {
                          submitform();
                        }, 0);

                          function submitform()
                          {
                            document.myForm.submit();
                          }
                          </script>
                          <?php
                  }
                  ?>
                  <div id="subasta1">
                    <form name="form" action="services/setearPrecio.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $rowsSubasta['idSubasta'];?>" />
                      <li style="text-align:center;font-size:19pt;list-style:none"> Inicio de Semana<input style="text-align:center;font-size:19pt;" type="text" class="form-control" name="semana" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />$<input type="number" name="precio" placeholder="Ingrese precio nuevo" value="<?php echo $rowsSubasta['precio'];?>" required /> <input type="submit" class="btn btn-success" value="Cambiar Valor"/>
                        Las Inscripciones comenzaran automaticamente el
                        <input style="text-align:center;font-size:19pt;" type="text" class="form-control" name="semana" value="<?php echo $dateAux;?>" readonly />
                      </li>
                    </form>
                </div>
                <?php
                  break;
                }

              ?>

              <?php
            } else {
              date_default_timezone_set('America/Argentina/Buenos_Aires');
              $dateFechaDisponible = new DateTime($rowsFechas['inicioSemana']);
              $date = date('m/d/Y h:i:s', time());
              $date = new DateTime($date);
              $date = $date->modify('+3 day');
              $date = $date->modify('+6 month');
              $date = $date->format('Y-m-d h:i:s');
              $dateFechaDisponible = $dateFechaDisponible->format('Y-m-d h:i:s');
              $dateAux = new DateTime($rowsFechas['inicioSemana']);
              $dateAux = $dateAux->modify('-1 year');
              $dateAux = $dateAux->format('Y-m-d h:i:s');
              ?>
              <div id="subasta1">
                <form name="form" action="services/ServiceCrearInscripcion.php" method="POST">
                  <input type="hidden" name="idF" value="<?php echo $rowsFechas['idFecha'];?>" />
                  <input type="hidden" name="idH" value="<?php echo $_GET['id'];?>" />
                  <li style="text-align:center;font-size:19pt;list-style:none"> Inicio de Semana<input style="text-align:center;font-size:19pt; <?php if ($date >= $dateFechaDisponible) { echo 'background-color:red'; }?>" type="text" class="form-control" name="semana" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly /><?php if ($date < $dateFechaDisponible) { ?>$<input type="number" name="precio" placeholder="Ingrese precio base" required /> <input type="submit" class="btn btn-success" value="Iniciar 6 meses de Inscripciones"/>
                    Las Inscripciones comenzaran automaticamente el
                    <input style="text-align:center;font-size:19pt;" type="text" class="form-control" name="semana" value="<?php echo $dateAux;?>" readonly />
                  <?php } ?>
                    <?php if ($date >= $dateFechaDisponible) { echo 'La fecha ya quedo antigua para usarla como subasta, solo se puede usar como hotsale ';
                      echo '<a class="btn btn-warning" href="solicitarHotsale.php?idF='.$rowsFechas["idFecha"].'&idH='.$_GET["id"].'"> Solicitar ser Hotsale </a>';
                     }?></li>
                </form>
            </div>
              <?php
            }
          }
            ?>
          </ul>
        </div>
    </div>
  </div>
<?php

    if (mysqli_num_rows($resultadoFechas) == 0) {

      echo '<h2> No hay fechas disponibles</h2>';
    }
 ?>
 </div>
      <div style="width:500px;" id="pie">
        <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
      </div>
    </div>
  </body>
</html>
