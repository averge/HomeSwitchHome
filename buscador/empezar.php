<?php

require_once('../hospedajes/controlador/dbConfig.php');
$datosSubasta="SELECT * FROM Subasta INNER JOIN hospedaje on (Subasta.idHospedaje = hospedaje.idHospedaje) WHERE idSubasta=".$_POST['id'];
$resultadoDatos = mysqli_query($con,$datosSubasta);
$rowsSubasta = mysqli_fetch_assoc($resultadoDatos);
$dateAux = new DateTime($rowsSubasta['fechaFin']);
$dateAux = $dateAux->modify('+3 day');
$fechaFin = $dateAux->format('Y-m-d h:i:s');
$sqlFilas = "SELECT * FROM fila where idSubasta =".$_POST['id'];
$resultadoFilas = mysqli_query($con,$sqlFilas);
  $rowsFilas=mysqli_fetch_assoc($resultadoFilas);
  $detallefila = "SELECT * FROM detalleFila WHERE idFila=".$rowsFilas['idFila'];
  $resultadoDetalleFila = mysqli_query($con,$detallefila);
  if ( mysqli_num_rows($resultadoDetalleFila) > 0 ) {
  while ($rows = mysqli_fetch_array($resultadoDetalleFila)){
    $notificarUsuario = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
    $notificarUsuario .= " VALUES ('".$rows['idUsuario']."','".$_POST['id']."','¡ATENCION! Comenzo la subasta de ".$rowsSubasta['titulo']." tiene 3 Dias para Pujar', 3, 0, 0)";
    $resultadoNotificarUsuario = mysqli_query($con,$notificarUsuario);
  }
}
  $notificarAdmin = "INSERT INTO notificaciones (idUsuario,idSubasta,notificacion,tipo,oculta,visto)";
  $notificarAdmin .= " VALUES ('0','".$_POST['id']."','¡ATENCION! Comenzo la subasta de ".$rowsSubasta['titulo']." ', 3, 0, 0)";
  $resultadoNotificarAdmin = mysqli_query($con,$notificarAdmin);
  if ($resultadoNotificarAdmin) {
    $sqlActualizarSubasta = "UPDATE Subasta set fechaFin = '".$fechaFin."', estado = 1 WHERE idSubasta = ".$_POST['id'];
    $resultadoActualizar = mysqli_query($con,$sqlActualizarSubasta);

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



 ?>
