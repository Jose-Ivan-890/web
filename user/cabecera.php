<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css?v=1.0">
    <link rel="stylesheet" href="../css/jquery-confirm.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery-confirm.js"></script>
    <script src=" ../js/funciones.js?1.00"></script>
    <script src="../controllers/usuario.js?v=1.01"></script>
    <script src="../controllers/rank.js?v=1.00"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="./index.php">Barra de navegación</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="./home.php">home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../index.php">cerrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:usuarios('perfil')">Perfil</a>
        </li>
        
      </ul> 

      <span class=" text-white lead" id="lblNombre" ><?php echo $_SESSION['nombre']; ?></span>
        </div>
      </nav>