<?php
require_once("../../bd.php");

if (isset($_GET["txtID"])) {
    // Recolectar los datos del metodo GET
    $txtID = (isset($_GET["txtID"]) ? $_GET["txtID"] : "");
    // Preparar la edición de los datos

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_series` WHERE id=:id");
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombre = $registro['nombre'];
    $foto = $registro['foto'];
    $puntaje = $registro['puntaje'];
    $estreno = $registro['estreno'];
    $director = $registro['director'];
    $genero = $registro['genero'];
    $pais = $registro['pais'];
}
if ($_POST) {
    // Recolectar los datos del metodo POST
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");
    if ($foto != "") {
        // Preparar la eliminación de la foto
        $sentencia = $conexion->prepare("SELECT foto FROM `tbl_series` WHERE `id`=:id");
        $sentencia->bindValue(":id", $txtID);
        $sentencia->execute();
        $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);
        if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != "") {
            if (file_exists("./img/" . $registro_recuperado["foto"])) {
                unlink("./img/" . $registro_recuperado["foto"]);
            }
        }
    }
    $puntaje = (isset($_POST["puntaje"]) ? $_POST["puntaje"] : "");
    $estreno = (isset($_POST["estreno"]) ? $_POST["estreno"] : "");
    $director = (isset($_POST["director"]) ? $_POST["director"] : "");
    $genero = (isset($_POST["genero"]) ? $_POST["genero"] : "");
    $pais = (isset($_POST["pais"]) ? $_POST["pais"] : "");
    
    // Preparar la inserción de los datos
    $sentencia = $conexion->prepare("UPDATE `tbl_series` 
        SET 
    nombre=:nombre, 
    foto=:foto,
    puntaje=:puntaje, 
    estreno=:estreno,
    director=:director,
    genero=:genero,
    pais=:pais
    WHERE id=:id");
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
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php?mensaje=serie editada");
}
$sentencia = $conexion->prepare("SELECT * FROM `tbl_series`");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


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
        Datos de la serie
    </div>
    <div class="card-body">
       <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" value="<?php echo $nombre; ?>">
        
          <label for="foto" class="form-label">Foto</label>
                <img width="50" class="img-fluid rounded" src="./img/<?php echo $registro['foto']; ?>" />
                <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" value="">
        
                <div class="mb-3">
    <label for="puntaje" class="form-label">Puntaje</label>
    <select class="form-select form-select-lg" name="puntaje" id="puntaje">
        <option value="1" <?php echo ($puntaje == 1) ? 'selected' : ''; ?>>1</option>
        <option value="2" <?php echo ($puntaje == 2) ? 'selected' : ''; ?>>2</option>
        <option value="3" <?php echo ($puntaje == 3) ? 'selected' : ''; ?>>3</option>
        <option value="4" <?php echo ($puntaje == 4) ? 'selected' : ''; ?>>4</option>
        <option value="5" <?php echo ($puntaje == 5) ? 'selected' : ''; ?>>5</option>
        <option value="6" <?php echo ($puntaje == 6) ? 'selected' : ''; ?>>6</option>
        <option value="7" <?php echo ($puntaje == 7) ? 'selected' : ''; ?>>7</option>
        <option value="8" <?php echo ($puntaje == 8) ? 'selected' : ''; ?>>8</option>
        <option value="9" <?php echo ($puntaje == 9) ? 'selected' : ''; ?>>9</option>
        <option value="10" <?php echo ($puntaje == 10) ? 'selected' : ''; ?>>10</option>
    </select>
</div>
        
          <label for="estreno" class="form-label">estreno</label>
          <input type="number" class="form-control" name="estreno" id="estreno" aria-describedby="helpId" value="<?php echo $estreno; ?>">
        
          <label for="director" class="form-label">director</label>
          <input type="text" class="form-control" name="director" id="director" aria-describedby="helpId" value="<?php echo $director; ?>">
        
          <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select class="form-select form-select-lg" name="genero" id="genero">
        <option value="Acción" <?php echo ($genero == 'Acción') ? 'selected' : ''; ?>>Acción</option>
        <option value="Aventura" <?php echo ($genero == 'Aventura') ? 'selected' : ''; ?>>Aventura</option>
        <option value="Comedia" <?php echo ($genero == 'Comedia') ? 'selected' : ''; ?>>Comedia</option>
        <option value="Drama" <?php echo ($genero == 'Drama') ? 'selected' : ''; ?>>Drama</option>
        <option value="Fantasía" <?php echo ($genero == 'Fantasía') ? 'selected' : ''; ?>>Fantasía</option>
        <option value="Horror" <?php echo ($genero == 'Horror') ? 'selected' : ''; ?>>Terror</option>
        <option value="Misterio" <?php echo ($genero == 'Misterio') ? 'selected' : ''; ?>>Misterio</option>
        <option value="Romance" <?php echo ($genero == 'Romance') ? 'selected' : ''; ?>>Romance</option>
        <option value="Ciencia Ficción" <?php echo ($genero == 'Ciencia Ficción') ? 'selected' : ''; ?>>Ciencia Ficción</option>
        <option value="Thriller" <?php echo ($genero == 'Thriller') ? 'selected' : ''; ?>>Thriller</option>
        <option value="Animación" <?php echo ($genero == 'Animación') ? 'selected' : ''; ?>>Animación</option>
        <option value="Crimen" <?php echo ($genero == 'Crimen') ? 'selected' : ''; ?>>Crimen</option>
        <option value="Documental" <?php echo ($genero == 'Documental') ? 'selected' : ''; ?>>Documental</option>
        <option value="Familia" <?php echo ($genero == 'Familia') ? 'selected' : ''; ?>>Familia</option>
        <option value="Fantástico" <?php echo ($genero == 'Fantástico') ? 'selected' : ''; ?>>Fantástico</option>
        <option value="Guerra" <?php echo ($genero == 'Guerra') ? 'selected' : ''; ?>>Guerra</option>
        <option value="Histórico" <?php echo ($genero == 'Histórico') ? 'selected' : ''; ?>>Histórico</option>
        <option value="Musical" <?php echo ($genero == 'Musical') ? 'selected' : ''; ?>>Musical</option>
        <option value="Suspense" <?php echo ($genero == 'Suspense') ? 'selected' : ''; ?>>Suspense</option>
        <option value="Western" <?php echo ($genero == 'Western') ? 'selected' : ''; ?>>Western</option>
    </select>
          </div>
        
          <div class="mb-3">
    <label for="pais" class="form-label">País</label>
    <select class="form-select form-select-lg" name="pais" id="pais">
        <option value="Afganistán" <?php echo ($pais == 'Afganistán') ? 'selected' : ''; ?>>Afganistán</option>
        <option value="Albania" <?php echo ($pais == 'Albania') ? 'selected' : ''; ?>>Albania</option>
    </select>
</div>

        </div>        
        <button type="submit" name="" id="" class="btn btn-primary" role="button">Agregar registro</button>

        <a name="" type="submit" id="" class="btn btn-danger" href="./index.php" role="button">Cancelar</a>

       </form>
    </div>
</div>

<?php require_once("../../templates/footer.php") ?>