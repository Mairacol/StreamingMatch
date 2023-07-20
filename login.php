<?php 

if ($_POST) {
    require_once("./bd.php");
    $sentencia = $conexion->prepare("SELECT *
    FROM tbl_usuarios
    WHERE usuario=:usuario
    AND password=:password");

    $sentencia->bindValue(":usuario", $_POST['usuario']);
    $sentencia->bindValue(":password", $_POST['password']);

    $sentencia->execute();

    $usuario = $sentencia->fetch(PDO::FETCH_LAZY);
    session_start();
    if($usuario){
        $_SESSION['usuario'] = $usuario ["usuario"];
        $_SESSION['logueado'] = true;
        header("Location:index.php");
    } else {
        $mensaje = "Clave o usuario incorrecto";
    }
}

?>

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- JQuery 3.7.0 -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <!-- DataTables 1.13.5 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
  <script script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>

<!-- SweetAlert 2.11 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body>
<main class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">
                    <?php if(isset($mensaje)) {?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      <strong>
                        <?php echo $mensaje ?>
                      </strong>
                    </div>
  <?php } ?>   


                    <script>
                      var alertList = document.querySelectorAll('.alert');
                      alertList.forEach(function (alert) {
                        new bootstrap.Alert(alert)
                      })
                    </script>
                    
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text"class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="">

                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password"class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar al sistema</button>
                    </form>
                </div>
                <div class="card-footer text-muted">
                </div>
            </div>
        </div>
    </div>
</main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>
<?php require_once("./templates/footer.php")?>

