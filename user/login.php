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



<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="../css/landing-page.min.css" rel="stylesheet">
    </head>
  <body>
      <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../Logos/HSH-Complete.svg" width="200px"></a>
    </div>
  </nav>
      <div id="condenido">
        <div id="singin" style="padding-left:235px;padding-right:800px;">
          <h2> Inicio de Session </h2>
          <?php
            if (isset($_GET['add'])){
              ?>
              <script>
              alert('Se registro correctamente, ahora podra iniciar sesion en nuestro sistema');
              </script>
              <?php
            }
            if (isset($_GET['error'])){
              ?>
              <script>
              alert('El usuario y/o contraseña son incorrectos');
              </script>
              <?php
            }
           ?>
          <form action="services/ServicesLogin.php" method="post">
  <div class="form-group" >
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" <?php if(isset($_POST['mail'])) { echo "value='".$_POST['mail']."'";} else { ?> placeholder="Enter email" <?php } ?> required>
    <small id="emailHelp" class="form-text text-muted">El mismo que utilizo al registrarse</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="pass" placeholder="Password" required>
  </div>
  <div class="form-check">
    ¿No eres usuario? <a href="singUp.php">Registrate</a>
  </div>
  <a href="../index.php" class="btn btn-warning">Volver</a>
  <button style="margin-top:10px;margin-left:100px" type="submit" class="btn btn-info">Iniciar Session</button>
</form>
</div>

      <div id="pie" class="fixex-bottom">
        <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
      </div>
    </div>
  </body>
</html>
