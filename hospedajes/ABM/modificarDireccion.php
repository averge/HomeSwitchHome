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

  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    </head>
<?php
require_once("../controlador/dbConfig.php");
if (isset($_GET['id'])){
  $sqlHospedaje="SELECT * FROM hospedaje WHERE idHospedaje=".$_GET['idH'];
  $resultadoHospedaje = mysqli_query($con,$sqlHospedaje);
  $rowsHospedaje = mysqli_fetch_array($resultadoHospedaje);
  $sqlDireccionCompleta = "Select Direccion.idDireccion, Direccion.Direccion, localidades.localidad, provincias.provincia FROM ( Direccion INNER JOIN localidades ON ( Direccion.Localidad = localidades.id ) INNER JOIN provincias ON ( Direccion.Provincia = provincias.id ) ) WHERE Direccion.idDireccion =".$_GET['id'];
  $resultadoDireccionCompleta = mysqli_query($con,$sqlDireccionCompleta);
  $rowsDireccionCompleta = mysqli_fetch_assoc($resultadoDireccionCompleta);
  $sqlDireccion = "SELECT * FROM Direccion WHERE idDireccion = '".$_GET['id']."'";
  $resultadoDireccion = mysqli_query($con,$sqlDireccion);
  $rowsDireccion = mysqli_fetch_assoc($resultadoDireccion);
  $sqlProvincias="SELECT * FROM provincias";
  $resultadoProvincias = mysqli_query($con,$sqlProvincias);
}else{
  if (isset($_POST['id'])){
    $sqlHospedaje="SELECT * FROM hospedaje WHERE idHospedaje=".$_POST['idH'];
    $resultadoHospedaje = mysqli_query($con,$sqlHospedaje);
    $rowsHospedaje = mysqli_fetch_array($resultadoHospedaje);
    if (isset($_POST['provincia'])){
      $sqlLocalidad = "SELECT * FROM localidades WHERE id_provincia = '".$_POST['provincia']."'";
      $resultadoLocalidades = mysqli_query($con,$sqlLocalidad);

    }
    $sqlDireccionCompleta = "Select Direccion.idDireccion, Direccion.Direccion, localidades.localidad, provincias.provincia FROM ( Direccion INNER JOIN localidades ON ( Direccion.Localidad = localidades.id ) INNER JOIN provincias ON ( Direccion.Provincia = provincias.id ) ) WHERE Direccion.idDireccion =".$_POST['id'];
    $resultadoDireccionCompleta = mysqli_query($con,$sqlDireccionCompleta);
    $rowsDireccionCompleta = mysqli_fetch_assoc($resultadoDireccionCompleta);
    $sqlDireccion = "SELECT * FROM Direccion WHERE idDireccion = '".$_POST['id']."'";
    $resultadoDireccion = mysqli_query($con,$sqlDireccion);
    $rowsDireccion = mysqli_fetch_assoc($resultadoDireccion);
    $sqlLocalidad = "SELECT * FROM localidades WHERE id_provincia = '".$rowsDireccion['Provincia']."'";
    $resultadoLocalidad = mysqli_query($con,$sqlLocalidad);
    $sqlProvincias="SELECT * FROM provincias";
    $resultadoProvincias = mysqli_query($con,$sqlProvincias);
  }
}
?>

<nav class="navbar navbar-light bg-light static-top">
<div class="container">
  <a class="navbar-brand" href="../../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../../Logos/HSH-Complete.svg" width="200px"></a>
  <a class="btn btn-primary" href="modificar.php?id=<?php if (isset($_GET['id'])){echo $_GET['id'];} else{ if (isset($_POST['id'])){echo $_POST['id'];}}?>">Atras</a>
  <a class="btn btn-primary" href="../Index.php">Volver al Listado</a>
  <?php
      session_start();
      echo $_SESSION['apellido'].", ".$_SESSION['nombre'];?><a class="btn btn-danger" href="../../user/services/ServicesLogOut.php">Cerrar Sesion</a>
</div>
</nav>
 <div class="container-fluid">
    <h2> Edicion de Direccion </h2>
    <?php if(isset($_GET['error']))
{
switch ($_GET['error']) {
case 1:
?>
<script type="text/javascript">
alert('No puede ingresar campos vacios!');
</script>
<?php
  break;
case 2:
?>
<script type="text/javascript">
alert('Debe ingresar imagen (formato .JPG, .PNG, .SVG, .JPEG)');
</script>
<?php
  break;

case 3:
?>
<script type="text/javascript">
alert('Ya existe un hospedaje con el mismo nombre, por favor escoja otro');
</script>
<?php
  break;
}
} ?>
     <div class="content-wrapper">
 		<div class="item-container">
 			<div class="container">
          <div class="form-row">
            <div class="form-group col-md-6">
              <center>
                <img id="item-display" src="../../images/<?php echo $rowsHospedaje['imagenData'];?>" alt="Foto hospedaje" title="fotografia" width="283px"></img>
                <br />
                  <label for="direccion">Direccion:</label>
                  <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $rowsDireccionCompleta['Direccion'].', '.$rowsDireccionCompleta['localidad'].', '.$rowsDireccionCompleta['provincia'].', Argentina'; ?>" readonly>
                  <br />
                  <a class="btn btn-warning" href="modificar.php?id=<?php echo $_GET['idH'];?>">Cancelar</a>
                  </center>
                </div>

                <div class="form-group col-md-6">

                  <?php
                  if (isset($_POST['okeyLocalidad'])){?>
                    <form enctype="multipart/form-data" action="services/ServicesModificarDireccion.php" method="POST">
                      <?php
                      ?>
                      <?php
                    } else {

                      ?>
                      <form  enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <?php } ?>
                      <input type="hidden" name="id" value="<?php if (isset($_GET['id'])) { echo $_GET['id']; } else { echo $_POST['id']; } ?>">
                      <input type="hidden" name="idH" value="<?php if (isset($_GET['idH'])) { echo $_GET['idH']; } else { echo $_POST['idH']; } ?>">
                  <label for="cantidad">Ingrese Nueva Direccion</label>
                  <input type="text" class="form-control" id="direccion" name="direccion" <?php if(isset($_POST['direccion'])){ ?> value="<?php echo $_POST['direccion'];?>" <?php } ?> >
                  <label>Seleccione Provincia:
                    <select id="provincia" name="provincia" class="browser-default custom-select" onchange="cargarLocalidades()" >
                <?php
                while ($rowsProvincias = mysqli_fetch_array($resultadoProvincias)){
                  ?>
                    <option value="<?php echo $rowsProvincias['id'];?>"
                      <?php if (isset($_POST['provincia']) ) {
                        if ($_POST['provincia']==$rowsProvincias['id']){
                          echo "selected";
                        }
                    } ?>><?php echo utf8_encode($rowsProvincias['provincia']);?></option>
                  <?php
                }
                ?>
              </select>
              <br />
              <input type="submit" class="btn btn-light" value="Cargar Localidades">
              <br />
              <label>Selecciona Localidad:
              <select id="localidad" name="localidad" class="browser-default custom-select" >
                <?php if (isset($_POST['provincia'])){
                    while ($rowsLocalidades = mysqli_fetch_array($resultadoLocalidades)){
                    ?>
                      <option value="<?php echo $rowsLocalidades['id'];?>"
                        <?php if (isset($_POST['localidad']))
                        {
                          if ($_POST['localidad']==$rowsLocalidades['id']) {
                            echo "selected";
                          }
                        } ?>><?php echo utf8_encode($rowsLocalidades['localidad']);?></option>
                    <?php
                  }
                  ?>
                  <br />
                  <input type="submit" class="btn btn-light" name="okeyLocalidad" value="Ok">
                  <br />
                  <?php
                }
                ?>
              </select>
            <input type="submit" class="btn btn-success" name="guardar" value="Guardar Cambios">
          </form>
            </div>

 				<div class="col-md-7">
 					<!--para futuras puntuaciones!!!
          <div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>-->
 					<div class="btn-group cart">
            <a href="ABM/modificar.php?id=<?php echo $_GET['id'];?>">
          </a>
        </div>
 				</div>
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
