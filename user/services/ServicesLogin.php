<?php
  require_once("../../hospedajes/controlador/dbConfig.php");
  $sqlLogin = "SELECT * FROM usuarios WHERE mail='".$_POST['email']."' AND password='".$_POST['pass']."'";
  $resultadoLogin = mysqli_query($con,$sqlLogin);
  if (mysqli_num_rows($resultadoLogin)>0) {
    session_start();
    $rowsLogin = mysqli_fetch_array($resultadoLogin);
    $_SESSION['idUsuario'] = $rowsLogin['idUsuario'];
    $_SESSION['nombre'] = $rowsLogin['nombre'];
    $_SESSION['apellido'] = $rowsLogin['apellido'];
    $_SESSION['tokens'] = $rowsLogin['tokens'];
    $_SESSION['tipo'] = $rowsLogin['tipo'];
    $_SESSION['solicitud'] = $rowsLogin['solicitud'];
    $_SESSION['mail'] = $rowsLogin['mail'];
    $_SESSION['imagen'] = $rowsLogin['imagenData'];
    $_SESSION['tipoImagen'] = $rowsLogin['imagenType'];
    if (session_status()==2){
      header("Location: ../../index.php?sing=1");
    }
  }
  else{ ?>
    <form name="myForm" id="myForm" action="../login.php?error=1" method="POST">
      <input type="hidden" name="mail" value="<?php echo $_POST['email'];?>" />
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
  }
 ?>
