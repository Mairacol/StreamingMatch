<?php
require_once("../../bd.php");
if ($_POST) {
   // Recolectar los datos del metodo POST
   $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
   $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");
   $puntaje = (isset($_POST["puntaje"]) ? $_POST["puntaje"] : "");
   $estreno = (isset($_POST["estreno"]) ? $_POST["estreno"] : "");
   $director = (isset($_POST["director"]) ? $_POST["director"] : "");
   $genero = (isset($_POST["genero"]) ? $_POST["genero"] : "");
   $pais = (isset($_POST["pais"]) ? $_POST["pais"] : "");

   // Preparar la inserción de los datos
    $sentencia = $conexion->prepare("INSERT INTO `tbl_peliculas`(`id`, `nombre`, `foto`, `puntaje`, `estreno`, `director`, `genero`, `pais`) 
    VALUES (null, :nombre, :foto, :puntaje, :estreno, :director, :genero, :pais)");

   // Asignamos los valores que vienen del metodo POST a la consulta
  $sentencia->bindValue(":nombre", $nombre);

  $fecha_ = new DateTime();
  $nombreArchivo_foto = ($foto != '') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
  $tmp_foto = $_FILES["foto"]['tmp_name'];
  if ($tmp_foto != '') {
      move_uploaded_file($tmp_foto, "./img/" . $nombreArchivo_foto);
  }
  $sentencia->bindValue(":foto", $nombreArchivo_foto);

  $sentencia->bindValue(":puntaje", $puntaje);
  $sentencia->bindValue(":estreno", $estreno);
  $sentencia->bindValue(":director", $director);
  $sentencia->bindValue(":genero", $genero);
  $sentencia->bindValue(":pais", $pais);

  $sentencia->execute();

  header("Location:index.php?mensaje=Pelicula agregada");
}

require_once("../../templates/header.php"); 

if (isset($_GET["mensaje"])) { ?>

    <script>
    Swal.fire({
        icon: "success",
        title: "<?php echo $_GET['mensaje']; ?>"
    });
    </script>
    
    <?php } ?>



<div class="card">
    <div class="card-header">
        Datos de la pelicula
    </div>
    <div class="card-body">
       <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="">
        
          <label for="foto" class="form-label">Foto</label>
          <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="">
        
          <div class="mb-3">
            <label for="puntaje" class="form-label">Puntaje</label>
            <select class="form-select form-select-lg" name="puntaje" id="puntaje">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
          </div>
        
          <label for="estreno" class="form-label">estreno</label>
          <input type="number" class="form-control" name="estreno" id="estreno" aria-describedby="helpId" placeholder="">
        
          <label for="director" class="form-label">Director</label>
          <input type="text" class="form-control" name="director" id="director" aria-describedby="helpId" placeholder="">
        
          <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select form-select-lg" name="genero" id="genero">
                <option value="Acción">Acción</option>
                <option value="Aventura">Aventura</option>
                <option value="Comedia">Comedia</option>
                <option value="Drama">Drama</option>
                <option value="Fantasía">Fantasía</option>
                <option value="Horror">Terror</option>
                <option value="Misterio">Misterio</option>
                <option value="Romance">Romance</option>
                <option value="Ciencia Ficción">Ciencia Ficción</option>
                <option value="Thriller">Thriller</option>
                <option value="Animación">Animación</option>
                <option value="Crimen">Crimen</option>
                <option value="Documental">Documental</option>
                <option value="Familia">Familia</option>
                <option value="Fantástico">Fantástico</option>
                <option value="Guerra">Guerra</option>
                <option value="Histórico">Histórico</option>
                <option value="Musical">Musical</option>
                <option value="Suspense">Suspense</option>
                <option value="Western">Western</option>
            </select>
          </div>
        
          <div class="mb-3">
            <label for="pais" class="form-label">País</label>
            <select class="form-select form-select-lg" name="pais" id="pais">
                <option value="Afganistán">Afganistán</option>
                <option value="Albania">Albania</option>

            </select>
          </div>

        </div>        
        <button type="submit" name="" id="" class="btn btn-primary" role="button">Agregar registro</button>

        <a name="" type="submit" id="" class="btn btn-danger" href="./index.php" role="button">Cancelar</a>

       </form>
    </div>
</div>

<?php require_once("../../templates/footer.php")?>