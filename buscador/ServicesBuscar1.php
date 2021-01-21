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
   <?php
   if (isset($_POST['tipo'])) {
     switch ($_POST['tipo']) {
       case 'Todos':
       $sqlBuscar = "Select * from hospedaje inner join Subasta on (Subasta.idHospedaje = hospedaje.idHospedaje) inner join fechasDisponibles on (Subasta.idFecha = fechasDisponibles.idFecha) where Subasta.estado = 1 OR Subasta.estado = 3";
       $sqlBuscarHotsales = "Select * from hospedaje inner join hotsale on (hotsale.idHospedaje = hospedaje.idHospedaje) inner join fechasDisponibles on (hotsale.idFecha = fechasDisponibles.idFecha) where hotsale.estado = 1";
         break;
       case 'Subasta':
       $sqlBuscar = "Select * from hospedaje inner join Subasta on (Subasta.idHospedaje = hospedaje.idHospedaje) inner join fechasDisponibles on (Subasta.idFecha = fechasDisponibles.idFecha) where Subasta.estado = 1 OR Subasta.estado = 3";
       break;
       case 'Hotsale':
       $sqlBuscarHotsales = "Select * from hospedaje inner join hotsale on (hotsale.idHospedaje = hospedaje.idHospedaje) inner join fechasDisponibles on (hotsale.idFecha = fechasDisponibles.idFecha) where hotsale.estado = 1";
         break;
     }
   }
   if (isset($_GET['tipo'])) {
     switch ($_GET['tipo']) {
       case 'Todos':
       $sqlBuscar = "Select * from hospedaje inner join Subasta on (Subasta.idHospedaje = hospedaje.idHospedaje) inner join fechasDisponibles on (Subasta.idFecha = fechasDisponibles.idFecha) where Subasta.estado = 1 OR Subasta.estado = 3";
       $sqlBuscarHotsales = "Select * from hospedaje inner join hotsale on (hotsale.idHospedaje = hospedaje.idHospedaje) inner join fechasDisponibles on (hotsale.idFecha = fechasDisponibles.idFecha) where hotsale.estado = 1";
         break;
       case 'Subasta':
       $sqlBuscar = "Select * from hospedaje inner join Subasta on (Subasta.idHospedaje = hospedaje.idHospedaje) inner join fechasDisponibles on (Subasta.idFecha = fechasDisponibles.idFecha) where Subasta.estado = 1 OR Subasta.estado = 3";
       break;
       case 'Hotsale':
       $sqlBuscarHotsales = "Select * from hospedaje inner join hotsale on (hotsale.idHospedaje = hospedaje.idHospedaje) inner join fechasDisponibles on (hotsale.idFecha = fechasDisponibles.idFecha) where hotsale.estado = 1";
         break;
     }
   }
   if (isset($_POST['buscadorNombre'])){
    if (strlen($_POST['buscadorNombre']) > 0){
      if(isset($sqlBuscar)){
        $sqlBuscar .= " AND hospedaje.titulo LIKE '%".$_POST['buscadorNombre']."%'";
      }
      if (isset($sqlBuscarHotsales)){
        $sqlBuscarHotsales .= " AND hospedaje.titulo LIKE '%".$_POST['buscadorNombre']."%'";
      }
    }
  }
    if (isset($_POST['buscadorFechaInicio']) && isset($_POST['buscadorFechaFin'])) {
      if (strlen($_POST['buscadorFechaInicio']) > 0 && strlen($_POST['buscadorFechaFin'])){
        $date = new \DateTime($_POST['buscadorFechaInicio']);
        $date = $date->modify("last monday");
        $newdateInicio = $date->format("Y-m-d");
        $date = new \DateTime($_POST['buscadorFechaFin']);
        $date = $date->modify("last monday");
        $newdateFin = $date->format("Y-m-d");
        if (isset ($sqlBuscar)){
          $sqlBuscar .= " AND fechasDisponibles.inicioSemana BETWEEN '".$newdateInicio."' AND '".$newdateFin."'";
        }
        if (isset($sqlBuscarHotsales)){
          $sqlBuscarHotsales .= " AND fechasDisponibles.inicioSemana BETWEEN '".$newdateInicio."' AND '".$newdateFin."'";
        }
      }
    }
    if (isset($sqlBuscar)) {
    $sqlBuscar .= " ORDER BY fechasDisponibles.inicioSemana ASC";
  }
    if (isset($sqlBuscarHotsales)) {
      $sqlBuscarHotsales .= " ORDER BY fechasDisponibles.inicioSemana ASC";
    }
   require_once("../hospedajes/controlador/dbConfig.php");
   if (isset($sqlBuscar)){
   $resultadoSubasta = mysqli_query($con,$sqlBuscar);
 }
   if (isset($sqlBuscarHotsales)) {
     $resultadoHotsale = mysqli_query($con,$sqlBuscarHotsales);
   }
    ?>
     </head>
   <body>
     <?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      ?>
     <nav class="navbar navbar-light bg-light static-top">
     <div class="container">
       <a class="navbar-brand" href="../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../Logos/HSH-Complete.svg" width="200px"></a>
       <?php   session_start();
       if (isset($_SESSION['idUsuario'])){
        ?>
        <div id="perfil">
          <?php if (isset($_GET['tipo'])){
            ?>
            <a class="btn" href="../user/verPerfil.php?return=<?php echo $actual_link;?>"><?php echo $_SESSION['apellido'].", ".$_SESSION['nombre'] ?></a>
        <?php
      } else {
        if (isset($_POST['tipo'])){
          ?>
          <a class="btn" href="../user/verPerfil.php?return=<?php echo $actual_link;?>?tipo=<?php echo $_POST['tipo'];?>"><?php echo $_SESSION['apellido'].", ".$_SESSION['nombre'] ?></a>
          <?php
        }
      }
        for ($i=0;$i<$_SESSION['tokens'];$i++) {
        ?>
        <img src="../Logos/coin.png" width="25px" height="25px" alt="coin">

          <?php

      }
      if (isset($_GET['tipo'])){
        ?>
        <a href="../user/verPerfil.php?return=<?php echo $actual_link;?>"><img class="logo" src="../images/<?php echo $_SESSION['imagen'];?>" width="60px"></a>
    <?php
  } else {
    if (isset($_POST['tipo'])){
      ?>
      <a href="../user/verPerfil.php?return=<?php echo $actual_link;?>?tipo=<?php echo $_POST['tipo'];?>"><img class="logo" src="../images/<?php echo $_SESSION['imagen'];?>" width="60px"></a>
      <?php
    }
  }?>
      </div>
      <a class="btn btn-danger" href="../user/services/ServicesLogOut.php">Cerrar Sesion</a>
 <?php
       } else{
      ?>
     <a class="btn btn-primary" href="../user/login.php">Iniciar Sesion</a>
   <?php } ?>
       </nav>
       <div id="condenido">

         <h1 style="text-align:center">Hospedajes Disponibles</h1>
         <form class="form-inline" style="width: 100%"action="ServicesBuscar.php" method="POST" onsubmit="return verificar()">
                 <input type="text" id="buscadorNombre" name="buscadorNombre" class="form-control form-control-lg" placeholder="Ingrese nombre o Lugar" <?php if (isset($_POST['buscadorNombre'])){ ?> value="<?php echo $_POST['buscadorNombre']; ?>"<?php } ?> >
                 <input type="date" id="buscadorFechaInicio" name="buscadorFechaInicio" class="form-control form-control-lg" placeholder="Seleccione Fecha (opcional)" <?php if (isset($_POST['buscadorFechaInicio'])){ ?> value="<?php echo $_POST['buscadorFechaInicio']; ?>"<?php } ?> >
                 <input type="date" id="buscadorFechaFin" name="buscadorFechaFin" class="form-control form-control-lg" placeholder="Seleccione Fecha (opcional)" <?php if (isset($_POST['buscadorFechaFin'])){ ?> value="<?php echo $_POST['buscadorFechaFin']; ?>"<?php } ?> >
                 <div class="form-check">
                   <input type="radio" class="form-check-input" id="Todos" name="tipo" value="Todos" <?php if (isset($_GET['tipo'])) { if ($_GET['tipo']=='Todos') { echo 'checked'; } } else { if (isset($_POST['tipo'])) { if ($_POST['tipo']=='Todos') { echo 'checked'; } } } ?> > Todos
                   <input type="radio" class="form-check-input" id="Subastas" name="tipo" value="Subasta" <?php if (isset($_GET['tipo'])) { if ($_GET['tipo']=='Subasta') { echo 'checked'; } } else { if (isset($_POST['tipo'])) { if ($_POST['tipo']=='Subasta') { echo 'checked'; } } } ?> > Subastas
                   <input type="radio" class="form-check-input" id="Hotsale" name="tipo" value="Hotsale" <?php if (isset($_GET['tipo'])) { if ($_GET['tipo']=='Hotsale') { echo 'checked'; } } else { if (isset($_POST['tipo'])) { if ($_POST['tipo']=='Hotsale') { echo 'checked'; } } } ?> > Hotsale
                </div>
               <button type="submit" class="btn btn-primary">Buscar</button>
         </form>
         <?php
          if (isset($_GET['inscripto'])){
            ?>
            <script>
            alert('Inscripcion exitosa, recibira una notificacion un dia antes de que comience la SUBASTA')
            </script>
            <?php
          }
          if (isset($_GET['yaInscripto'])){
            ?>
            <script>
            alert('Ya se encuentra inscripto, recibira una notificacion un dia antes de que comience la SUBASTA')
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
           else {
             return true;
           }
         }
         </script>
         <?php
         if (isset($sqlBuscar)){
           if(mysqli_num_rows($resultadoSubasta) == 0){
             echo "<h2>No hay hospedajes disponibles para su busqueda</h2>";
           }
         }
          if (isset($sqlBuscarHotsales)) {
            if(mysqli_num_rows($resultadoHotsale) == 0 && !(isset($sqlBuscar)) ){
              echo "<h2>No hay hospedajes disponibles para su busqueda</h2>";
            }
            $contador=1;
              while ($rowHotsale = mysqli_fetch_array($resultadoHotsale)){
                $sqlHospedaje = "SELECT * FROM hospedaje WHERE idHospedaje=".$rowHotsale['idHospedaje'];
                $resultadoHospedaje = mysqli_query($con,$sqlHospedaje);
                $rowsHospedaje = mysqli_fetch_assoc($resultadoHospedaje);
                $sqlFechas = "SELECT * FROM fechasDisponibles WHERE idFecha=".$rowHotsale['idFecha'];
                $resultadoFecha = mysqli_query($con,$sqlFechas);
                $rowsFechas = mysqli_fetch_array($resultadoFecha);
                $date = $rowsFechas['inicioSemana'];
                $date = str_replace('-', '/', $date );
                $date1 = str_replace('00:00:00', '00:00 AM', $date );
                $date = str_replace('00:00 AM', '', $date1 );
              ?>
              <script>

              var end<?php echo $contador; ?> = new Date('<?php echo $date1; ?>');

              var _second<?php echo $contador; ?> = 1000;
              var _minute<?php echo $contador; ?> = _second<?php echo $contador; ?> * 60;
              var _hour<?php echo $contador; ?> = _minute<?php echo $contador; ?> * 60;
              var _day<?php echo $contador; ?> = _hour<?php echo $contador; ?> * 24;

              var timer<?php echo $contador; ?>;

              function showRemaining<?php echo $contador; ?>() {
                  var now = new Date();
                  var distance<?php echo $contador; ?> = end<?php echo $contador; ?> - now;
                  if (distance<?php echo $contador; ?> < 0) {

                      clearInterval(timer<?php echo $contador; ?>);
                      document.getElementById('countdown<?php echo $contador; ?>').innerHTML = 'EXPIRED!';

                      return;
                  }
                  var days<?php echo $contador; ?> = Math.floor(distance<?php echo $contador; ?> / _day<?php echo $contador; ?>);
                  var hours<?php echo $contador; ?> = Math.floor((distance<?php echo $contador; ?> % _day<?php echo $contador; ?>) / _hour<?php echo $contador; ?>);
                  var minutes<?php echo $contador; ?> = Math.floor((distance<?php echo $contador; ?> % _hour<?php echo $contador; ?>) / _minute<?php echo $contador; ?>);
                  var seconds<?php echo $contador; ?> = Math.floor((distance<?php echo $contador; ?> % _minute<?php echo $contador; ?>) / _second<?php echo $contador; ?>);

                  document.getElementById('dias<?php echo $contador; ?>').innerHTML = days<?php echo $contador; ?> + ' dias ';
                  document.getElementById('horas<?php echo $contador; ?>').innerHTML = hours<?php echo $contador; ?> + 'hrs ';
                  document.getElementById('minutos<?php echo $contador; ?>').innerHTML = minutes<?php echo $contador; ?> + 'mins ';
                  document.getElementById('segundos<?php echo $contador; ?>').innerHTML = seconds<?php echo $contador; ?> + 'secs';

              }

              timer<?php echo $contador; ?> = setInterval(showRemaining<?php echo $contador; ?>, 1000);
             </script>
            <div id="hotsale">
              <div id="subastaImagen">
                <?php echo '<img src="../images/'.$rowsHospedaje['imagenData'].'" alt="Imagen'.$rowsHospedaje['titulo'].'" width="400" height="250" />';?>
              </div>
              <div id="subastaInfo">
                <span><h2><?php echo $rowsHospedaje['titulo'];?></h2></span>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="7" cols="80" ><?php echo $rowsHospedaje['descripcion']; ?></textarea>
              </div>
              <div id="info">
                <span><h4>Para usar en la semana del </h4><h4><?php echo $date;?></h4></span>
                <span><h4>Precio Hotsale $<?php echo $rowHotsale['precio'];?></h4></span>
              </div>
              <div id="adquirir">
                     <div id="countdown<?php echo $contador; ?>">
                       Quedan
                       <span class="dias" id="dias<?php echo $contador; ?>">
                       </span>
                       <span class="horas" id="horas<?php echo $contador; ?>">
                       </span>
                       <span class="minutos" id="minutos<?php echo $contador; ?>">
                       </span>
                       <span class="segundos" id="segundos<?php echo $contador; ?>">
                       </span>
                       para adquirir esta OFERTA!
                     </div>
                <?php  if (isset($_SESSION['idUsuario'])){

                  if (isset($_GET['tipo'])){
                    ?>
                    <a href="../subastas/ofertar.php?return=<?php echo $actual_link;?>&id=<?php echo $rowHotsale['idHotsale'];?>" class="btn btn-block btn-lg btn-warning">ADQUIRIR!</a><?php
                  } else {
                  if (isset($_POST['tipo'])){
                  ?>
                  <a href="../subastas/ofertar.php?return=<?php echo $actual_link;?>?tipo=<?php echo $_POST['tipo'];?>&id=<?php echo $rowHotsale['idHotsale'];?>" class="btn btn-block btn-lg btn-warning">ADQUIRIR!</a>
                  <?php
                  }
                }
                }
                ?>
              </div>
            </div>
            <?php
            $contador++;
          }
        }
        if (isset($sqlBuscar)) {
           while ($rowsSubasta = mysqli_fetch_array($resultadoSubasta)){
             $sqlHospedaje = "SELECT * FROM hospedaje WHERE idHospedaje=".$rowsSubasta['idHospedaje'];
             $resultadoHospedaje = mysqli_query($con,$sqlHospedaje);
             $rowsHospedaje = mysqli_fetch_assoc($resultadoHospedaje);
             $sqlFechas = "SELECT * FROM fechasDisponibles WHERE idFecha=".$rowsSubasta['idFecha'];
             $resultadoFecha = mysqli_query($con,$sqlFechas);
             $rowsFechas = mysqli_fetch_assoc($resultadoFecha);
             $date = $rowsFechas['inicioSemana'];
             $date = str_replace('-', '/', $date );
             $date1 = str_replace('00:00:00', '00:00 AM', $date );
             $date = str_replace('00:00 AM', '', $date1 );
           ?>
           <script>

           var end<?php echo $contador; ?> = new Date('<?php echo $date1; ?>');

           var _second<?php echo $contador; ?> = 1000;
           var _minute<?php echo $contador; ?> = _second<?php echo $contador; ?> * 60;
           var _hour<?php echo $contador; ?> = _minute<?php echo $contador; ?> * 60;
           var _day<?php echo $contador; ?> = _hour<?php echo $contador; ?> * 24;

           var timer<?php echo $contador; ?>;

           function showRemaining<?php echo $contador; ?>() {
               var now = new Date();
               var distance<?php echo $contador; ?> = end<?php echo $contador; ?> - now;
               if (distance<?php echo $contador; ?> < 0) {

                   clearInterval(timer);
                   document.getElementById('countdown<?php echo $contador; ?>').innerHTML = 'EXPIRED!';

                   return;
               }
               var days<?php echo $contador; ?> = Math.floor(distance<?php echo $contador; ?> / _day<?php echo $contador; ?>);
               var hours<?php echo $contador; ?> = Math.floor((distance<?php echo $contador; ?> % _day<?php echo $contador; ?>) / _hour<?php echo $contador; ?>);
               var minutes<?php echo $contador; ?> = Math.floor((distance<?php echo $contador; ?> % _hour<?php echo $contador; ?>) / _minute<?php echo $contador; ?>);
               var seconds<?php echo $contador; ?> = Math.floor((distance<?php echo $contador; ?> % _minute<?php echo $contador; ?>) / _second<?php echo $contador; ?>);

               document.getElementById('dias<?php echo $contador; ?>').innerHTML = days<?php echo $contador; ?> + ' dias ';
               document.getElementById('horas<?php echo $contador; ?>').innerHTML = hours<?php echo $contador; ?> + 'hrs ';
               document.getElementById('minutos<?php echo $contador; ?>').innerHTML = minutes<?php echo $contador; ?> + 'mins ';
               document.getElementById('segundos<?php echo $contador; ?>').innerHTML = seconds<?php echo $contador; ?> + 'secs';

           }

           timer<?php echo $contador; ?> = setInterval(showRemaining<?php echo $contador; ?>, 1000);
          </script>
         <div id="subasta">
           <div id="subastaImagen">
             <?php echo '<img src="../images/'.$rowsHospedaje['imagenData'].'" alt="Imagen'.$rowsHospedaje['titulo'].'" width="400" height="250" />';?>
           </div>
           <div id="subastaInfo">
             <span><h2><?php echo $rowsHospedaje['titulo'];?></h2></span>
             <textarea class="form-control" id="descripcion" name="descripcion" rows="7" cols="80" ><?php echo $rowsHospedaje['descripcion']; ?></textarea>
           </div>
           <div id="info">
             <span><h4>Para usar la semana del </h4><h4><?php echo $date;?></h4></span>
             <span><h4>Precio Actual  $<?php echo $rowsSubasta['precio'];?></h4></span>
             <span>La subasta comienza <?php echo $date;?></span>
          </div>
          <div id="adquirir">
            <div id="countdown">
              Quedan
              <span class="dias" id="dias<?php echo $contador; ?>">
              </span>
              <span class="horas" id="horas<?php echo $contador; ?>">
              </span>
              <span class="minutos" id="minutos<?php echo $contador; ?>">
              </span>
              <span class="segundos" id="segundos<?php echo $contador; ?>">
              </span>

             <?php  if (isset($_SESSION['idUsuario'])){
                      if ($rowsSubasta['estado'] == 3){ ?>
                        para inscribirse a esta Subasta
                      </div>
                        <a href="../subastas/inscribirme.php?return=<?php echo $actual_link;?>&id=<?php echo $rowsSubasta['idSubasta'];?>" class="btn btn-block btn-lg btn-primary">INSCRIBIRME!</a>
                        <?php
                      }
                      else {
             ?>
               <?php
               if (isset($_GET['tipo'])){
                 ?>
                 para pujar a esta Subasta
               </div>
                 <a href="../subastas/ofertar.php?return=<?php echo $actual_link;?>&id=<?php echo $rowsSubasta['idSubasta'];?>" class="btn btn-block btn-lg btn-success">OFERTAR!</a><?php
               } else {
               if (isset($_POST['tipo'])){
               ?>
               para pujar a esta Subasta
             </div>
               <a href="../subastas/ofertar.php?return=<?php echo $actual_link;?>?tipo=<?php echo $_POST['tipo'];?>&id=<?php echo $rowsSubasta['idSubasta'];?>" class="btn btn-block btn-lg btn-success">OFERTAR!</a>
               <?php
               }
               }
              }
            } ?>
          </div>
           </div>
         </div>
         <?php
         $contador++;
       }
     }
          ?>
       </div>
       <div id="pie">
         <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
       </div>
     </div>
   </body>
 </html>
