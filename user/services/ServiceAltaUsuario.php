<?php
function getAge ($fecha)
    {
        $mayor=18;
        $nacio = DateTime::createFromFormat('Y-m-d', $fecha);
        $calculo = $nacio->diff(new DateTime());

        $edad=  $calculo->y;
        if ($edad < $mayor)
        { ?>
          <form name="myForm" id="myForm" action="../singUp.php?error=4" method="POST">
            <input type="hidden" name="nombre" value="<?php echo $_POST['nombre'];?>" />
            <input type="hidden" name="apellido" value="<?php echo $_POST['apellido'];?>" />
            <input type="hidden" name="email" value="<?php echo $_POST['email'];?>" />
            <input type="hidden" name="nacionalidad" value="<?php echo $_POST['nacionalidad'];?>" />
            <input type="hidden" name="tarjeta" value="<?php echo $_POST['tarjeta'];?>" />
            <input type="hidden" name="fechaNac" value="<?php echo $_POST['fechaNac'];?>" />
            <input type="hidden" name="membresia" value="<?php echo $_POST['membresia'];?>" />
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
    }
getAge($_POST['fechaNac']);
require_once("../../hospedajes/controlador/dbConfig.php");
$usuario = "SELECT idUsuario FROM usuarios WHERE mail='".$_POST['email']."'";
$resultadoUsuario = mysqli_query($con,$usuario);
if (mysqli_num_rows($resultadoUsuario)>0){
  ?>
  <form name="myForm" id="myForm" action="../singUp.php?error=1" method="POST">
    <input type="hidden" name="nombre" value="<?php echo $_POST['nombre'];?>" />
    <input type="hidden" name="apellido" value="<?php echo $_POST['apellido'];?>" />
    <input type="hidden" name="email" value="<?php echo $_POST['email'];?>" />
    <input type="hidden" name="nacionalidad" value="<?php echo $_POST['nacionalidad'];?>" />
    <input type="hidden" name="tarjeta" value="<?php echo $_POST['tarjeta'];?>" />
    <input type="hidden" name="fechaNac" value="<?php echo $_POST['fechaNac'];?>" />
    <input type="hidden" name="membresia" value="<?php echo $_POST['membresia'];?>" />
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
if ($_POST['pass1'] != $_POST['pass'] ){
  ?>
  <form name="myForm" id="myForm" action="../singUp.php?error=3" method="POST">
    <input type="hidden" name="nombre" value="<?php echo $_POST['nombre'];?>" />
    <input type="hidden" name="apellido" value="<?php echo $_POST['apellido'];?>" />
    <input type="hidden" name="email" value="<?php echo $_POST['email'];?>" />
    <input type="hidden" name="nacionalidad" value="<?php echo $_POST['nacionalidad'];?>" />
    <input type="hidden" name="tarjeta" value="<?php echo $_POST['tarjeta'];?>" />
    <input type="hidden" name="fechaNac" value="<?php echo $_POST['fechaNac'];?>" />
    <input type="hidden" name="membresia" value="<?php echo $_POST['membresia'];?>" />
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
$sqlAltaUsuario = "INSERT INTO usuarios (imagenData, imagenType, tokens, nombre, apellido, mail, password,
   nacionalidad, tarjeta, fechaNac, tipo, solicitud)
   VALUES ( 'descarga.jpg','jpg','2','".$_POST['nombre']."','".$_POST['apellido']."','".$_POST['email']."','".$_POST['pass']."',
   '".$_POST['nacionalidad']."','".$_POST['tarjeta']."','".$_POST['fechaNac']."','2','".$_POST['membresia']."')";
 $resultadoAlta=mysqli_query($con,$sqlAltaUsuario);
 if($_POST['membresia'] == 3){
   $sqlNotificarSolicitud="INSERT INTO notificaciones (idUsuario,notificacion,tipo,oculta,visto)";
   $sqlNotificarSolicitud.=" VALUES ('2','El usuario ".$_POST['apellido'].", ".$_POST['nombre']." solicitó ser Premium',5,0,0)";
   $resultadoNotificar=mysqli_query($con,$sqlNotificarSolicitud);
 }
 if ($resultadoAlta){
   header("Location: ../login.php?add=1");
 }
 ?>
