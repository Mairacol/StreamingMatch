<?php
require_once("../../bd.php");
if (isset($_GET["txtID"])) {
    // Recolectar los datos del metodo GET
    $txtID = (isset($_GET["txtID"]) ? $_GET["txtID"] : "");
    // Preparar la eliminación de los datos
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios` WHERE id=:id");
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $usuario = $registro['usuario'];
    $password = $registro['password'];
    $correo = $registro['correo'];
}
if ($_POST) {
    print_r($_POST);
    // Recolectar los datos del metodo POST
    $txtID = (isset($_POST["txtID"]) ? $_POST["txtID"] : "");
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
    // Preparar la inserción de los datos
    $sentencia = $conexion->prepare("UPDATE `tbl_usuarios` 
                                    SET `usuario`=:usuario,`password`=:password,`correo`=:correo 
                                    WHERE id=:id");
    // Asignamos los valores que vienen del metodo POST a la consulta
    $sentencia->bindValue(":usuario", $usuario);
    $sentencia->bindValue(":password", $password);
    $sentencia->bindValue(":correo", $correo);
    $sentencia->bindValue(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php?mensaje=Usuario editado");
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
        Usuarios
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="txtID" class="form-label"></label>
                <input type="hidden" class="form-control" name="txtID" id="txtID" aria-describedby="helpId"
                    value="<?php echo $txtID; ?>" placeholder="" readonly>
                <label for="usuario" class="form-label">Nombre del usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId"
                    value="<?php echo $usuario ?>">
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password"
                        value="<?php echo $password ?>">
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId"
                        value="<?php echo $correo ?>">
                </div>
            </div>
            <button type="submit" name="" id="" class="btn btn-primary" role="button">Editar registro</button>
            <a name="" id="" class="btn btn-danger" href="./index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>
<?php require_once("../../templates/footer.php") ?>