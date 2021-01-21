<?php
require_once('../hospedajes/controlador/dbConfig.php');
$datosSubasta="SELECT * FROM Subasta INNER JOIN hospedaje on (Subasta.idHospedaje = hospedaje.idHospedaje) WHERE idSubasta=".$_POST['id'];
$resultadoDatos = mysqli_query($con,$datosSubasta);
$rowsSubasta = mysqli_fetch_assoc($resultadoDatos);

if ( $rowsSubasta['subastado'] == '1' ) {
  $sqlHistoria = "SELECT * FROM Pujas WHERE idSubasta=".$_POST['id']." ORDER BY precio DESC";
  $resultadoHistoria = mysqli_query($con,$sqlHistoria);

  while ($rows = mysqli_fetch_array($resultadoHistoria)){
    $sqlUsuario = "SELECT idUsuario,nombre,apellido,tarjeta,tokens FROM usuarios WHERE idUsuario=".$rows['idUsuario'];
    $resultadoUsuario = mysqli_query($con,$sqlUsuario);
    $usuario = mysqli_fetch_assoc($resultadoUsuario);
    if (intval($usuario['tokens']) > 0){

      $terminarSubasta = "UPDATE Subasta SET estado = '2', idUsuario=".$rows['idUsuario'].", precio=".$rows['precio']." WHERE idSubasta = ".$_POST['id'];
      $resultadoTerminar = mysqli_query($con,$terminarSubasta);

      $descontarToken = "UPDATE usuarios set tokens = ".($usuario['tokens']-1)." WHERE idUsuario = ".$usuario['idUsuario'];
      $resultadoDescontarToken = mysqli_query($con,$descontarToken);

      $notificarGanador = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
      $notificarGanador .= " VALUES ('".$usuario['idUsuario']."','".$_POST['id']."','¡FELICITACIONES ADQUIRIO EL HOSPEDAJE ".$rowsSubasta['titulo']." EN LA BREVEDAD NUESTROS AGENTES SE COMUNICARAN CON USTED', 7, 0, 0)";
      $resultadoNotificar = mysqli_query($con,$notificarGanador);

      $sqlNotificacionPago = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
      $sqlNotificacionPago .= " VALUES ('".$usuario['idUsuario']."','".$_POST['id']."','¡Se realizo el pago con exito! Se cargo el importe de $".$rows['precio']." en la tarjeta ****-****-****-".(1000%$usuario['tarjeta'])."' , 7, 0, 0)";
      $resultadoNotificarPago = mysqli_query($con,$sqlNotificacionPago);

      $sqlNotificacionToken = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
      $sqlNotificacionToken .= " VALUES ('".$usuario['idUsuario']."','".$_POST['id']."','¡Se desconto el token con exito! Para poder ver los cambios en las monedas de arriba por favor vuelva a iniciar sesion' , 7, 0, 0)";
      $resultadoNotificarToken = mysqli_query($con,$sqlNotificacionToken);

      $notificarAdmin = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
      $notificarAdmin .= " VALUES ('0','".$_POST['id']."','¡HAY GANADOR! Termino la subasta de ".$rowsSubasta['titulo']." Fue el usuario ".$usuario['apellido'].",".$usuario['nombre']."', 8, 0, 0)";
      $resultadoNotificarAdmin = mysqli_query($con,$notificarAdmin);

      if (isset($_POST['crear'])){
        ?>
        <form name="myForm" id="myForm" action="../hospedajes/subasta/crearSubasta.php" method="GET">
          <input type="hidden" name="id" value="<?php echo $rowsSubasta['idHospedaje'];?>" />
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
    } else {
    ?>
    <form name="myForm" id="myForm" action="ServicesBuscar.php" method="GET">
      <input type="hidden" name="tipo" value="Todos" />
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
      die();
      }
      }

      $terminarSubasta="UPDATE Subasta SET estado = 4 WHERE idSubasta=".$_POST['id'];
      $resultadoTerminar = mysqli_query($con,$terminarSubasta);
      $notificarAdmin = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
      $notificarAdmin .= " VALUES ('0','".$_POST['id']."','¡NO HAY GANADOR! Termino la subasta de ".$rowsSubasta['titulo']." No hubieron Ofertas. ', 9, 0, 0)";
      $resultadoNotificarAdmin = mysqli_query($con,$notificarAdmin);

      if (isset($_POST['crear'])){
        ?>
        <form name="myForm" id="myForm" action="../hospedajes/subasta/crearSubasta.php" method="GET">
          <input type="hidden" name="id" value="<?php echo $rowsSubasta['idHospedaje'];?>" />
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
    } else {
    ?>
    <form name="myForm" id="myForm" action="ServicesBuscar.php" method="GET">
      <input type="hidden" name="tipo" value="Todos" />
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

  } else {
      $terminarSubasta="UPDATE Subasta SET estado = 4 WHERE idSubasta=".$_POST['id'];
      $resultadoTerminar = mysqli_query($con,$terminarSubasta);
      $notificarAdmin = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
      $notificarAdmin .= " VALUES ('0','".$_POST['id']."','¡NO HAY GANADOR! Termino la subasta de ".$rowsSubasta['titulo']." No hubieron Ofertas. ', 9, 0, 0)";
      $resultadoNotificarAdmin = mysqli_query($con,$notificarAdmin);

      if (isset($_POST['crear'])){
        ?>
        <form name="myForm" id="myForm" action="../hospedajes/subasta/crearSubasta.php" method="GET">
          <input type="hidden" name="id" value="<?php echo $rowsSubasta['idHospedaje'];?>" />
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
    } else {
    ?>
    <form name="myForm" id="myForm" action="ServicesBuscar.php" method="GET">
      <input type="hidden" name="tipo" value="Todos" />
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
    }
