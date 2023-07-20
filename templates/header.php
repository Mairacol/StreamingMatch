<?php 
session_start();

if(!isset($_SESSION ['usuario'])){
  header("Location:" . "http://localhost/StreamingMatch/login.php");
}
?>

<!doctype html>
<html lang="en">

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
  <header>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="http://localhost/StreamingMatch/login.php/" aria-current="page">Sistema 
                  <span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/StreamingMatch/secciones/peliculas/">Peliculas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/StreamingMatch/secciones/series/">Series</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/StreamingMatch/secciones/usuarios/">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/StreamingMatch/cerrar.php">Cerrar sesion</a>
            </li>
        </ul>
    </nav>
  </header>
  <main class="container">
    <br>