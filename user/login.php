<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Cosmo.css">
</head>
<body>
<?php
   include "cabecera.php"
 
?>
    <!--inicio Login-->
    <form  class="formcentrado"  action="validar.php" method="post">
                  
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">Ejemplo : 12344567@hotmail.com</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input name="clave" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <input type="submit" value="Enviar">
    </form>
    <?php
    
    ?>
</body>
</html>