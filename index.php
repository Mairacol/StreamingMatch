<?php
require_once("./templates/header.php")
?>
<br>

  <div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">Bienvenido al sistema</h1>
      <p class="col-md-8 fs-4">
        <?php echo $_SESSION['usuario']; ?>
      </p>
      <button class="btn btn-primary btn-lg" type="button">Example button</button>
    </div>
    </div>
    <?php require_once("./templates/footer.php") ?>