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
<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template -->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../../vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
  <link href="../css/landing-page.min.css" rel="stylesheet">
    </head>
  <body>
      <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="../../index.php"><img class="logo" title="Home Switch Home" alt="Home Switch Home" src="../../Logos/HSH-Complete.svg" width="200px"></a>
      <a href="../Index.php" class="btn btn-primary">
        <span class="glyphicon glyphicon-chevron-left"></span> Volver al Listado
      </a>
      <?php
          session_start();?>
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
          <a class="btn btn-danger" href="../../user/services/ServicesLogOut.php">Cerrar Sesion</a>
        </div>
      </nav>
      <div id="condenido" style="padding-left:35px;padding-right:35px">
        <h2> Nuevo Hospedaje </h2>
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
require_once("../controlador/dbConfig.php");
$sqlProvincias="SELECT * FROM provincias";
$resultadoProvincias=mysqli_query($con,$sqlProvincias);
?>
<form enctype="multipart/form-data" action="services/ServicesAlta.php" method="POST">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="titulo">Ingrese Titulo</label>
              <input type="text" <?php if (isset($_GET['error'])){ if($_GET['error']==3) { echo "style= border-color:red"; } } ?> class="form-control" id="titulo" name="titulo" <?php if(isset($_POST['titulo'])){ ?> value="<?php echo $_POST['titulo'];?>" <?php } ?> required>
              <label for="cantidad">Ingrese Cantidad de Personas</label>
              <input type="number" class="form-control" id="cantidad" name="cantPersonas" <?php if(isset($_POST['cantPersonas'])){ ?> value="<?php echo $_POST['cantPersonas'];?>" <?php } ?> required>
              <label for="cantidad">Ingrese Direccion</label>
              <input type="text" class="form-control" id="direccion" name="direccion" <?php if(isset($_POST['direccion'])){ ?> value="<?php echo $_POST['direccion'];?>" <?php } ?> required>
              <label for="cantidad">Ingrese Ciudad</label>
              <input type="text" class="form-control" id="ciudad" name="ciudad" <?php if(isset($_POST['ciudad'])){ ?> value="<?php echo $_POST['ciudad'];?>" <?php } ?> required>
              <label>Seleccione Provincia:
              <select id="provincia" name="provincia" class="browser-default custom-select" required>
                <option value="">Elegir Opción</option>
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
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="descripcion">Ingrese Descripcion</label>
              <textarea class="form-control" id="descripcion" name="descripcion" rows="4" cols="50" required><?php if(isset($_POST['descripcion'])){ echo $_POST['descripcion'];} ?></textarea>
            </div>
            <div id="custom-file" class="custom-file">
              <input type="file" id="imagen" name="imagen" required>
            </div>
            <div class="form-group col-md-6">
              <label for="descripcion">Ingrese Cantidad de Semanas (Opcional)</label>
              <input type="number" class="form-control" id="semanas" name="semanas" placeholder="Cantidad de Semanas">
              <button type="button" class="btn btn-warning">Agregar Semanas</button>
            </div>
            <div id="sem" class"form-group col-md-6"></div>
            <script >

                const button = document.querySelector("button");
                const semanas = document.getElementById("semanas");
                var i;
                button.addEventListener('click', agregarSemanas);
                function agregarSemanas() {
                  document.getElementById("sem").innerHTML="";
                  for (i=0;i<semanas.value;i++){
                     document.getElementById("sem").innerHTML += '<br /> Ingrese Inicio de semana: <input type="date" onChange="return validarFechas('+i+')" id="semana'+i+'" name="semana'+i+'" required />';
                     document.getElementById("sem").innerHTML += '<br /> Ingrese Precio de la semana: $<input type="number" id="precio'+i+'" name="precio'+i+'" required />';
                  }
                }
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
            <div class="custom-file">
              <input type="submit" class="btn btn-success" value="Agregar Hospedaje">
          </div>
        </div>
        </form>
      <div id="pie">
        <p> Desarrollado por <strong>FAA</strong> - 2019 - copyrigth</p>
      </div>
    </div>
  </body>
</html>
