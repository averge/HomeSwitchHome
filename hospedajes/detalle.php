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

  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </head>
  <body>
    <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../Logos/HSH-Complete.svg" width="200px"></a>
      <a class="btn btn-primary" href="Index.php">Atras</a>
      <?php
          session_start();
          ?>
          <div id="perfil">
          <a class="btn" href="../user/verPerfil.php"><?php echo $_SESSION['apellido'].", ".$_SESSION['nombre'] ?></a>
          <?php
          for ($i=0;$i<$_SESSION['tokens'];$i++) {
          ?>
          <img src="../Logos/coin.png" width="25px" height="25px" alt="coin">
            <?php
          } ?>
          <a href="../user/verPerfil.php"><img class="logo" src="../images/<?php echo $_SESSION['imagen'];?>" width="60px"></a>
          </div>
     <a class="btn btn-danger" href="../user/services/ServicesLogOut.php">Cerrar Sesion</a>
    </div>
  </nav>
<?php
if (isset($_GET['fechaMenor'])){
  ?>
  <script>
  alert('La fecha debe ser minimamente posterior a un año desde hoy');
  </script>
  <?php
}
if (isset($_GET['id'])){
  require_once("controlador/dbConfig.php");
    $sqlHospedaje="SELECT * FROM hospedaje WHERE idHospedaje=".$_GET['id'];
    $sqlFechas="SELECT idFecha,inicioSemana FROM fechasDisponibles WHERE idHospedaje=".$_GET['id']." ORDER BY inicioSemana DESC";
    $resultadoHospedaje = mysqli_query($con,$sqlHospedaje);
    $resultadoFechas = mysqli_query($con,$sqlFechas);
    $rowsHospedaje = mysqli_fetch_assoc($resultadoHospedaje);
    $sqlDireccionCompleta = "Select Direccion.idDireccion, Direccion.Direccion, Direccion.ciudad, provincias.provincia FROM ( Direccion INNER JOIN provincias ON ( Direccion.Provincia = provincias.id ) ) WHERE Direccion.idDireccion =".$rowsHospedaje['idDireccion'];
    $resultadoDireccionCompleta = mysqli_query($con,$sqlDireccionCompleta);
    $rowsDireccionCompleta = mysqli_fetch_assoc($resultadoDireccionCompleta);
}
 ?>
 <div class="container-fluid">
     <div class="content-wrapper">
 		<div class="item-container">
 			<div class="container">
 				<div class="col-md-16">
 					<div class="product col-md-5 service-image-left">
 						<center>
 							<img id="item-display" src="../images/<?php echo $rowsHospedaje['imagenData'];?>" alt="Foto hospedaje" title="fotografia" width="283px"></img>
 						</center>
 					</div>
 				</div>

 				<div class="col-md-7">
 					<div class="product-title"><h2 style="text-align:center"><?php echo $rowsHospedaje['titulo']; ?></h2></div>
 					<div class="product-desc"><?php echo $rowsHospedaje['descripcion']; ?></div>
          <div class="product-desc"><h4>Cantidad de Personas: <?php echo $rowsHospedaje['cantidadPersonas']; ?></h4></div>
          <div class="product-desc"><h4>Ubicacion: <?php echo utf8_encode($rowsDireccionCompleta['Direccion'].', '.$rowsDireccionCompleta['ciudad'].', '.$rowsDireccionCompleta['provincia'].', Argentina'); ?></h4></div>
 					<!--para futuras puntuaciones!!!
          <div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>-->
          <?php
          if($_SESSION['tipo']==1){?>
            <div class="btn-group cart">
              <a href="ABM/modificar.php?id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-warning">
                  Editar
                </button>
              </a>
            </div>
              <?php
            }?>
 				</div>
 			</div>
 		</div>
 		<div class="container-fluid">
 			<div class="col-md-12 product-info">
        <ul class="nav nav-pills" style="margin-top: 30px; background-color:#eaeded">
        <li class="nav-item">
          <a<?php if (!isset($_GET['action'])){
                  ?> class="nav-link active" <?php }

                  if (isset($_GET['action'])) {
                   if ($_GET['action']=="semanas") {
                  ?> class="nav-link active" <?php
                    }
                    else{
                      ?> class="nav-link" <?php
                    }
                  }
                    ?> href="detalle.php?id=<?php echo $_GET['id'];?>&action=semanas" style="color:black">Semanas Disponibles</a>
        </li>
        <?php
        if($_SESSION['tipo']==1){?>
        <li class="nav-item">
          <a <?php
                  if (isset($_GET['action'])) {
                   if ($_GET['action']=="agregar") {
                  ?> class="nav-link active" <?php
                    }
                    else{
                      ?> class="nav-link" <?php
                    }
                  }
                    ?> href="detalle.php?id=<?php echo $_GET['id'];?>&action=agregar" style="color:black">Agregar Semanas</a>
        </li> <?php } ?>
      </ul>
 				<div id="myTabContent" class="tab-content">
 						<div class="tab-pane fade in active" id="service-one">
              <div id="contenido">
 							<section class="container product-info">
 								<?php
                if  (isset($_GET['exito'])){
                ?> <div id="exito">
                  <label>Las fechas se AGREGARON con <strong>éxito</strong></label>
                  </div> <?php
                }
                if  (isset($_GET['eliminar'])){
                ?> <div id="delete">
                  <label>La fecha se ELIMINO con <strong>éxito</strong></label>
                  </div> <?php
                }
                      if (!isset($_GET['action'])){
                        $i=0;
                      ?>
                      <ul class="fechas">
                        <?php
                      while ($rowsFechas = mysqli_fetch_array($resultadoFechas)){
                        $sqlFechaSubasta = "SELECT estado FROM Subasta WHERE idFecha=".$rowsFechas['idFecha'];
                        $resultadoFechaSubasta = mysqli_query($con,$sqlFechaSubasta);
                        if ( ( mysqli_num_rows( $resultadoFechaSubasta ) ) == 1 ) {
                          $rowsFechaSubasta=mysqli_fetch_assoc($resultadoFechaSubasta);
                          switch ($rowsFechaSubasta['estado']) {
                            case 1:
                            ?>
                            <li> Inicio de Semana (En subasta)<input style="background-color:#A9F5D0" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                            <?php
                            break;
                            case 2:
                            ?>
                            <li> Inicio de Semana (Con Ganador)<input style="background-color:#81F79F" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                              <a class="btn btn-danger" style="margin-top:10px" href="ABM/eliminarFecha.php?idF=<?php echo $rowsFechas['idFecha'];?>&idH=<?php echo $rowsHospedaje['idHospedaje'];?>">Eliminar</a>
                            </li>
                            <?php
                            break;
                            case 3:
                            ?>
                            <li> Inicio de Semana (En inscripcion)<input style="background-color:#E1F5A9" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                            </li>
                            <?php
                            break;
                            case 4:
                            ?>
                            <li> Inicio de Semana (Sin ganador)<input style="background-color:#FA8258" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                              <a class="btn btn-danger" style="margin-top:10px" href="ABM/eliminarFecha.php?idF=<?php echo $rowsFechas['idFecha'];?>&idH=<?php echo $rowsHospedaje['idHospedaje'];?>">Eliminar</a>
                            </li>
                            <?php
                            break;
                            case 5:
                            ?>
                            <li> Inicio de Semana (Solicitud a Hotsale)<input style="background-color:#F3F781" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                              <a class="btn btn-danger" style="margin-top:10px" href="ABM/eliminarFecha.php?idF=<?php echo $rowsFechas['idFecha'];?>&idH=<?php echo $rowsHospedaje['idHospedaje'];?>">Eliminar y rechazar solicitud</a>
                            </li>
                            <?php
                            break;
                            case 6:
                            ?>
                            <li> Inicio de Semana (Solicitud a Hotsale Aprobada)<input style="background-color:#FFFF00" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                            </li>
                            <?php
                            break;
                            case 10:
                            ?>
                            <li> Inicio de Semana (Fecha sin precio asignado)<input style="background-color:#FA5858" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                            </li>
                            <?php
                            break;
                          }
                        } else {
                          ?>
                          <li> Inicio de Semana<input type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly /> <?php
                          if ( $_SESSION['tipo'] == 1 ) { ?>
                            <a class="btn btn-danger" style="margin-top:10px" href="ABM/eliminarFecha.php?idF=<?php echo $rowsFechas['idFecha'];?>&idH=<?php echo $rowsHospedaje['idHospedaje'];?>">Eliminar</a><?php
                          } ?></li>
                          <?php
                        }
                        }
                        ?>
                      </ul>
                      <div>
                        <a class="btn btn-info" style="font-size:14pt;padding:11px;border-radius:22px" href="subasta/crearSubasta.php?id=<?php echo $_GET['id'];?>"> Ver estado de fechas </a>
                      <br />
                      <br />
                      <span style="background-color:#A9F5D0;font-size:11pt;padding:9px;border-radius:22px">Fecha en Subasta</span>
                      <span style="background-color:#81F79F;font-size:11pt;padding:9px;border-radius:22px">Subasta terminada con ganador</span>
                      <span style="background-color:#E1F5A9;font-size:11pt;padding:9px;border-radius:22px">Fecha en periodo de Inscripcion</span>
                      <span style="background-color:#FA8258;font-size:11pt;padding:9px;border-radius:22px">Subasta terminada sin ganador (Posible hotsale) </span>
                      <br />
                      <br />
                      <span style="background-color:#F3F781;font-size:11pt;padding:9px;border-radius:22px">Fecha en solicitud a Hotsale </span>
                      <span style="margin-left:5px;background-color:#FFFF00;font-size:11pt;padding:9px;border-radius:22px">Fecha en Hotsale </span>
                      <span style="margin-left:5px;background-color:#eaeded;font-size:11pt;padding:9px;border-radius:22px">Fecha sin Actividad</span>
                      </div>
                      <?php
                      }
                      else {
                        if ($_GET['action'] == 'semanas') {
                          $i=0;
                        ?>
                        <ul class="fechas">
                          <?php
                        while ($rowsFechas = mysqli_fetch_array($resultadoFechas)){
                          $sqlFechaSubasta = "SELECT estado FROM Subasta WHERE idFecha=".$rowsFechas['idFecha'];
                          $resultadoFechaSubasta = mysqli_query($con,$sqlFechaSubasta);
                          if ( ( mysqli_num_rows( $resultadoFechaSubasta ) ) == 1 ) {
                            $rowsFechaSubasta=mysqli_fetch_assoc($resultadoFechaSubasta);
                            switch ($rowsFechaSubasta['estado']) {
                              case 1:
                              ?>
                              <li> Inicio de Semana (En subasta)<input style="background-color:#A9F5D0" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                              <?php
                              break;
                              case 2:
                              ?>
                              <li> Inicio de Semana (Con Ganador)<input style="background-color:#81F79F" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                                <a class="btn btn-danger" style="margin-top:10px" href="ABM/eliminarFecha.php?idF=<?php echo $rowsFechas['idFecha'];?>&idH=<?php echo $rowsHospedaje['idHospedaje'];?>">Eliminar</a>
                              </li>
                              <?php
                              break;
                              case 3:
                              ?>
                              <li> Inicio de Semana (En inscripcion)<input style="background-color:#E1F5A9" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                              </li>
                              <?php
                              break;
                              case 4:
                              ?>
                              <li> Inicio de Semana (Sin ganador)<input style="background-color:#FA8258" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                                <a class="btn btn-danger" style="margin-top:10px" href="ABM/eliminarFecha.php?idF=<?php echo $rowsFechas['idFecha'];?>&idH=<?php echo $rowsHospedaje['idHospedaje'];?>">Eliminar</a>
                              </li>
                              <?php
                              break;
                              case 5:
                              ?>
                              <li> Inicio de Semana (Solicitud a Hotsale)<input style="background-color:#F3F781" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                                <a class="btn btn-danger" style="margin-top:10px" href="ABM/eliminarFecha.php?idF=<?php echo $rowsFechas['idFecha'];?>&idH=<?php echo $rowsHospedaje['idHospedaje'];?>">Eliminar y rechazar solicitud</a>
                              </li>
                              <?php
                              break;
                              case 6:
                              ?>
                              <li> Inicio de Semana (Solicitud a Hotsale Aprobada)<input style="background-color:#FFFF00" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                              </li>
                              <?php
                              break;
                              case 10:
                              ?>
                              <li> Inicio de Semana (Sin precio asignado)<input style="background-color:#eaeded" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                                <a class="btn btn-danger" style="margin-top:10px" href="ABM/eliminarFecha.php?idF=<?php echo $rowsFechas['idFecha'];?>&idH=<?php echo $rowsHospedaje['idHospedaje'];?>">Eliminar</a>

                              </li>
                              <?php
                              break;
                              case 11:
                              ?>
                              <li> Inicio de Semana (Con precio asignado)<input style="background-color:#eaeded" type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly />
                                <a class="btn btn-danger" style="margin-top:10px" href="ABM/eliminarFecha.php?idF=<?php echo $rowsFechas['idFecha'];?>&idH=<?php echo $rowsHospedaje['idHospedaje'];?>">Eliminar</a>

                              </li>
                              <?php
                              break;
                            }
                          } else {
                            ?>
                            <li> Inicio de Semana<input type="text" class="form-control" name="semana<?php echo $i;?>" value="<?php echo $rowsFechas['inicioSemana'];?>" readonly /> <?php
                            if ( $_SESSION['tipo'] == 1 ) { ?>
                              <a class="btn btn-danger" style="margin-top:10px" href="ABM/eliminarFecha.php?idF=<?php echo $rowsFechas['idFecha'];?>&idH=<?php echo $rowsHospedaje['idHospedaje'];?>">Eliminar</a><?php
                            } ?></li>
                            <?php
                          }
                          }
                          ?>
                        </ul>
                        <div>
                          <a class="btn btn-info" style="font-size:14pt;padding:11px;border-radius:22px" href="subasta/crearSubasta.php?id=<?php echo $_GET['id'];?>"> Ver estado de fechas </a>
                        <br />
                        <br />
                        <span style="background-color:#A9F5D0;font-size:11pt;padding:9px;border-radius:22px">Fecha en Subasta</span>
                        <span style="background-color:#81F79F;font-size:11pt;padding:9px;border-radius:22px">Subasta terminada con ganador</span>
                        <span style="background-color:#E1F5A9;font-size:11pt;padding:9px;border-radius:22px">Fecha en periodo de Inscripcion</span>
                        <span style="background-color:#FA8258;font-size:11pt;padding:9px;border-radius:22px">Subasta terminada sin ganador (Posible hotsale) </span>
                        <br />
                        <br />
                        <span style="background-color:#F3F781;font-size:11pt;padding:9px;border-radius:22px">Fecha en solicitud a Hotsale </span>
                        <span style="margin-left:5px;background-color:#FFFF00;font-size:11pt;padding:9px;border-radius:22px">Fecha en Hotsale </span>
                        <span style="margin-left:5px;background-color:#eaeded;font-size:11pt;padding:9px;border-radius:22px">Fecha sin Actividad</span>
                        </div>
                        <?php
                        }
                        else{
                          if ($_GET['action'] == 'agregar') {
                            ?>
                            <form action="detalle.php?id=<?php echo $_GET['id'];?>&action=agregar" method="POST">
                              <div class="form-group col-md-6">
                                <label for="descripcion">Ingrese Cantidad de Semanas</label>
                                <input type="number" class="form-control" id="semanas" name="semanas" <?php if (isset($_POST['semanas'])){?> value="<?php echo $_POST['semanas'];?>"<?php } else {?>placeholder="Cantidad de Semanas"<?php } ?> required>
                              </div>
                            </form>
                            <?php
                              if (isset($_POST['semanas'])){
                                if ($_POST['semanas']>0){
                                  ?>
                                  <form action="ABM/agregarSemanas.php" method="post">
                                    <input type="hidden" value="<?php echo $_POST['semanas']; ?>" name="semanas">
                                    <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
                                  <?php
                                  for ($i=0;$i<$_POST['semanas'];$i++){
                                    if ($i<>0) {echo '<br />';}
                                    ?>

                                    Ingrese Inicio de semana: <input type="date" onChange="return validarFechas(<?php echo $i; ?>)" id="semana<?php echo $i ?>" name="semana<?php echo $i;?>" required />
                                    <br /> Ingrese Precio de semana: $<input type="number" id="precio<?php echo $i ?>" name="precio<?php echo $i;?>" required />
                                    <?php
                                  }
                                  ?>
                                  <input type="submit" class="btn btn-success" value="Cargar Semanas">
                                </form>
                                <script>
                                function validarFechas(i){
                                  var fechaInicio = document.getElementById('semana'+i+'').value;
                                  var hoy = new Date();
                                  hoy.setMonth(hoy.getMonth() + 12);
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
                                  if (fechaInicio < dia){
                                    dia = dd+'-'+mm+'-'+yyyy;
                                    alert("La fecha de disponibilidad debe ser un año posterior a la fecha de hoy. Minimo: "+dia);
                                    return false;
                                  }
                                }
                              </script>
                                  <?php
                                }
                              }
                             ?>
                            <div id="sem" class="form-group col-md-6"></div>
                            <?php
                          }
                        }
                      }
                 ?>
 							</section>
            </div>
            </div>

 				</div>
 				<hr>
 			</div>
 		</div>
 	</div>
 </div>
      <div id="pie">
        <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
      </div>
    </div>

      <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
