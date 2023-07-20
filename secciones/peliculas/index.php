<?php
require_once("../../bd.php");

// Obtener los datos de la tabla tbl_peliculas
$sentencia = $conexion->prepare("SELECT * FROM `tbl_peliculas`");
$sentencia->execute();
$lista_tbl_peliculas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["txtID"])) { // lógica para eliminar una pelicula
    // Recolectar los datos del metodo GET
    $txtID = (isset($_GET["txtID"]) ? $_GET["txtID"] : "");
    // Preparar la eliminación de la foto
    $sentencia = $conexion->prepare("SELECT foto FROM `tbl_peliculas` WHERE `id`=:id");
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();
    $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);
    if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != "") {
        if (file_exists("./img/" . $registro_recuperado["foto"])) {
            unlink("./img/" . $registro_recuperado["foto"]);
        }
    }

    $sentencia = $conexion->prepare("DELETE FROM `tbl_peliculas` WHERE `id`=:id");
    // Asignamos los valores que vienen del metodo GET a la consulta
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();
    $sentencia->execute();
    header("Location:index.php?mensaje=Pelicula eliminada");
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


<h1>Peliculas</h1>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="./crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th><!-- 1er y 2do nombre y 1er y 2do apellido -->
                        <th scope="col">Foto</th>
                        <th scope="col">Puntaje</th>
                        <th scope="col">Estreno</th>
                        <th scope="col">Director</th>
                        <th scope="col">Género</th>
                        <th scope="col">País</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_tbl_peliculas as $registro) { ?>
                        <tr class="">
                            <td scope="row">
                                <?php echo $registro['id']; ?>
                            </td>
                            <td>
                                <?php echo $registro['nombre']; ?>
                            </td>
                            <td>
                                <img width="50" class="img-fluid rounded" src="./img/<?php echo $registro['foto']; ?>" />
                            </td>
                            <td>
                                <?php echo $registro['puntaje']; ?>
                            </td>
                            <td>
                                <?php echo $registro['estreno']; ?>
                            </td>
                            <td>
                                <?php echo $registro['director']; ?>
                            </td>
                            <td>
                                <?php echo $registro['genero']; ?>
                            </td>
                            <td>
                                <?php echo $registro['pais']; ?>
                            </td>
                            <td>
                                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']; ?>"
                                    role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger"
                                    href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    <script>
function borrar(id){
    Swal.fire({
        title: '¿Desea eliminar el registro?',
        showCancelButton: true,
        confirmButtonText: 'Si, Eliminar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location="index.php?txtID="+id;
        }
    })

}
</script>

</div>
<?php require_once("../../templates/footer.php") ?>