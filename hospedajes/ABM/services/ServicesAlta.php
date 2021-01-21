<?php
require_once ("../../controlador/dbConfig.php");
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$direccion = $_POST['direccion'];
$sql = "SELECT idHospedaje FROM hospedaje WHERE titulo = '".$titulo."'";
$resultado = mysqli_query($con,$sql);
if ($resultado->num_rows != 0){
  ?>
    <form name="myForm" id="myForm" action="../Alta.php?error=3" method="POST">
      <input type="hidden" name="titulo" value="<?php echo $_POST['titulo'];?>" />
      <input type="hidden" name="cantPersonas" value="<?php echo $_POST['cantPersonas'];?>" />
      <input type="hidden" name="direccion" value="<?php echo $_POST['direccion'];?>" />
      <input type="hidden" name="ciudad" value="<?php echo $_POST['ciudad'];?>" />
      <input type="hidden" name="provincia" value="<?php echo $_POST['provincia'];?>" />
      <input type="hidden" name="descripcion" value="<?php echo $_POST['descripcion'];?>" />
      </form>
      <script>
          var auto_refresh = setInterval(
          function()
          {
          submitform();
        }, 0.01);

          function submitform()
          {
            document.myForm.submit();
          }
          </script>
          <?php
  die();
}
$direccion = str_replace(' ','',$direccion);
$titulo = str_replace(' ','',$titulo);
$descripcion = str_replace(' ','',$descripcion);
if ( (strlen($titulo) == 0) || (strlen($descripcion) == 0) || (strlen($direccion) == 0) ){
  ?>
    <form name="myForm" id="myForm" action="../Alta.php?error=1" method="POST">
      <input type="hidden" name="titulo" value="<?php echo $_POST['titulo'];?>" />
      <input type="hidden" name="cantPersonas" value="<?php echo $_POST['cantPersonas'];?>" />
      <input type="hidden" name="direccion" value="<?php echo $_POST['direccion'];?>" />
      <input type="hidden" name="ciudad" value="<?php echo $_POST['ciudad'];?>" />
      <input type="hidden" name="provincia" value="<?php echo $_POST['provincia'];?>" />
      <input type="hidden" name="descripcion" value="<?php echo $_POST['descripcion'];?>" />
      </form>
      <script>
          var auto_refresh = setInterval(
          function()
          {
          submitform();
        }, 0.01);

          function submitform()
          {
            document.myForm.submit();
          }
          </script>
          <?php
  die();
}
$imageProperties = getimageSize($_FILES['imagen']['tmp_name']);
$checker = $imageProperties[2];
if (!(in_array($checker , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))){
  ?>
    <form name="myForm" id="myForm" action="../Alta.php?error=2" method="POST">
      <input type="hidden" name="titulo" value="<?php echo $_POST['titulo'];?>" />
      <input type="hidden" name="cantPersonas" value="<?php echo $_POST['cantPersonas'];?>" />
      <input type="hidden" name="direccion" value="<?php echo $_POST['direccion'];?>" />
      <input type="hidden" name="ciudad" value="<?php echo $_POST['ciudad'];?>" />
      <input type="hidden" name="provincia" value="<?php echo $_POST['provincia'];?>" />
      <input type="hidden" name="descripcion" value="<?php echo $_POST['descripcion'];?>" />
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
  die();
}
$type = $imageProperties['mime'];
$type = str_replace('image/', '', $type);
$sqlDireccion = "INSERT INTO Direccion (Direccion, ciudad, Provincia ) VALUES ( '".$_POST['direccion']."' , '".$_POST['ciudad']."' , '".$_POST['provincia']."' )";
$resultadoDireccion = mysqli_query($con,$sqlDireccion);
$sqlDireccion = "SELECT MAX(idDireccion) FROM Direccion";
$resultadoDireccion = mysqli_query($con,$sqlDireccion);
$rowsDireccion = mysqli_fetch_array($resultadoDireccion);
$sql = "INSERT INTO hospedaje ( idDireccion, titulo, descripcion, imagenType, cantidadPersonas, cantidadSemanasDisp, tipo) VALUES ('".$rowsDireccion['MAX(idDireccion)']."' , '".$_POST['titulo']."','".$_POST['descripcion']."','".$type."','".$_POST['cantPersonas']."','".$_POST['semanas']."', 'normal')";
$tmpName = $_FILES['imagen']['tmp_name'];
$resultado = mysqli_query($con,$sql);
if($resultado){
  $sql = "SELECT idHospedaje FROM hospedaje WHERE titulo = '".$_POST['titulo']."'";
  $resultado = mysqli_query($con,$sql);
  $rows = mysqli_fetch_assoc($resultado);
  /*En la variable $name tendrian que cambiar mi /opt/lampp/htdocs/
  por c/users/#nombreDeUsuarioEnWindows/wamp/www/#Carpeta donde tengan el proyecto.
  Y una vez que se bajen el repo que subi completo vamos a tener todos lo mismo
  */

    $name="../../../images/idHospedaje".$rows['idHospedaje'].".".$type;

  fopen($name,"a");
  copy($tmpName,$name);
  $name = "idHospedaje".$rows['idHospedaje'].".".$type;
  $sql = "UPDATE hospedaje SET imagenData = '".$name."' WHERE idHospedaje = ".$rows['idHospedaje'];
  $resultado = mysqli_query($con,$sql);
  if ($resultado){
    if (isset($_POST['semanas'])){
      if ($_POST['semanas'] > 0){
        for ($i=0;$i<$_POST['semanas'];$i++){
          $date = new \DateTime($_POST['semana'.$i]);
          $date = $date->modify("last monday");
          $newdateInicio = $date->format("Y-m-d");
          $sql = "INSERT INTO fechasDisponibles (idHospedaje,inicioSemana) VALUES ('".$rows['idHospedaje']."','".$newdateInicio."')";
          $resultado = mysqli_query($con,$sql);
          $sqlId = "SELECT MAX(idFecha) FROM fechasDisponibles";
          $resultadoId = mysqli_query($con,$sqlId);
          $idFecha = mysqli_fetch_assoc($resultadoId);
          $sql = "INSERT INTO Subasta (idHospedaje,idFecha,precio,estado) VALUES ('".$rows['idHospedaje']."','".$idFecha['MAX(idFecha)']."','".$_POST['precio'.$i]."','11')";
          $resultadoSub = mysqli_query($con,$sql);
        }
      }
    }
    header("Location: ../../Index.php?exito=1");
  }
}
?>
