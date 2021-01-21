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
  <body>
    <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../../Logos/HSH-Complete.svg" width="200px"></a>
      <a class="btn btn-primary" href="../detalle.php?id=<?php echo $_GET['id'];?>">Atras</a>
      <a class="btn btn-primary" href="../Index.php">Volver al Listado</a>
      <?php
          session_start();
          ?>
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
          <a class="btn btn-danger" href="../../user/services/ServicesLogOut.php">Cerrar Sesion</a>    </div>
  </nav>
<?php

require_once("../controlador/dbConfig.php");
if (isset($_GET['id'])){
    $sqlHospedaje="SELECT * FROM hospedaje WHERE idHospedaje=".$_GET['id'];
    $sqlFechas="SELECT idFecha,inicioSemana FROM fechasDisponibles WHERE idHospedaje=".$_GET['id']." ORDER BY inicioSemana DESC";
    $resultadoHospedaje = mysqli_query($con,$sqlHospedaje);
    $resultadoFechas = mysqli_query($con,$sqlFechas);
    $rowsHospedaje = mysqli_fetch_assoc($resultadoHospedaje);
    $sqlDireccion = "SELECT * FROM Direccion WHERE idDireccion = '".$rowsHospedaje['idDireccion']."'";
    $resultadoDireccion = mysqli_query($con,$sqlDireccion);
    $rowsDireccion = mysqli_fetch_assoc($resultadoDireccion);
    $sqlLocalidad = "SELECT * FROM localidades WHERE id_provincia = '".$rowsDireccion['Provincia']."'";
    $resultadoLocalidad = mysqli_query($con,$sqlLocalidad);
    $sqlProvincias="SELECT * FROM provincias";
    $resultadoProvincias=mysqli_query($con,$sqlProvincias);
    $sqlDireccionCompleta = "Select Direccion.idDireccion, Direccion.Direccion, Direccion.ciudad, provincias.provincia, provincias.id FROM ( Direccion INNER JOIN provincias ON ( Direccion.Provincia = provincias.id ) ) WHERE Direccion.idDireccion =".$rowsHospedaje['idDireccion'];
    $resultadoDireccionCompleta = mysqli_query($con,$sqlDireccionCompleta);
    $rowsDireccionCompleta = mysqli_fetch_assoc($resultadoDireccionCompleta);
    $sqlCantidadPersonas = "Select idHospedaje from Subasta WHERE idHospedaje = ".$_GET['id']." AND estado = 1";
    $resultadoCantidadPersonas = mysqli_query($con,$sqlCantidadPersonas);

    if ( mysqli_num_rows($resultadoCantidadPersonas) > 0){
      $enSubasta = true;
    }
    else {
      $enSubasta = false;
    }
  }

 ?>
 <div class="container-fluid">
    <h2> Edicion de Hospedaje </h2>
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
}
?>
     <div class="content-wrapper">
       <?php
       if  (isset($_GET['mod'])){
       ?> <div id="exito">
         <label>El hospedaje se Modificó con <strong>éxito</strong></label>
         </div> <?php
       }?>
 		<div class="item-container">
 			<div class="container">
          <div class="form-row">
            <div class="form-group col-md-6">
              <center>
                <img id="item-display" src="../../images/<?php echo $rowsHospedaje['imagenData'];?>" alt="Foto hospedaje" title="fotografia" width="283px"></img>
                <br />
                <form enctype="multipart/form-data" action="services/ServicesModificar.php" method="POST">
                  <div id="custom-file" class="custom-file">
                    <input type="file" id="imagen" name="imagen">
                  </div>

                </center>
            </div>
            <div class="form-group col-md-6">
              <label for="titulo">Ingrese Titulo</label>
              <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
              <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $rowsHospedaje['titulo'];?>" required>
              <label for="cantidad">Ingrese Cantidad de Personas</label>
              <input type="number" class="form-control" id="cantidad" name="cantPersonas" value="<?php echo $rowsHospedaje['cantidadPersonas'];?>" <?php if ( $enSubasta ){ echo 'readonly'; } ?> required>

              <?php
              if ($enSubasta) { ?>
                <small class="form-text text-muted">No se puede modificar la cantidad de personas cuando el hospedaje se encuentra con subastas activas</small>
<?php
              }
                ?>
                <label for="direccion">Direccion:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" <?php if(isset($rowsDireccionCompleta['Direccion'])){ ?> value="<?php echo $rowsDireccionCompleta['Direccion'];?>" <?php } ?> required>
                <label for="cantidad">Ciudad:</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" <?php if(isset($rowsDireccionCompleta['ciudad'])){ ?> value="<?php echo $rowsDireccionCompleta['ciudad'];?>" <?php } ?> required>
                <label>Seleccione Provincia:
                <select id="provincia" name="provincia" required>
                  <option value="">Elegir Opción</option>
                  <?php
                  while ($rowsProvincias = mysqli_fetch_array($resultadoProvincias)){
                    ?>
                      <option value="<?php echo $rowsProvincias['id'];?>"
                        <?php if (isset($rowsDireccionCompleta['id']) ) {
                          if ($rowsDireccionCompleta['id']==$rowsProvincias['id']){
                            echo "selected";
                          }
                      } ?>><?php echo utf8_encode($rowsProvincias['provincia']);?></option>
                    <?php
                  }
                  ?>
                </select>
                <br />
              <label for="descripcion">Descripcion:</label>
              <textarea class="form-control" id="descripcion" name="descripcion" rows="4" cols="50" required><?php echo $rowsHospedaje['descripcion'];?></textarea>
              <input type="submit" class="btn btn-success" name="Guardar Cambios" value="Guardar Cambios">
            </div>
            </div>
        </form>

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
