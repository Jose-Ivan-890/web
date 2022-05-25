<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/Cosmo.css">
</head>
<body>
<?php
   include "cabecera.php"

?>

      <form >
        <fieldset>
            <legend> Cambiar contraseña</legend>
           <div class="form-group">
          <label for="exampleInputEmail1">Email:</label>
          <input type="email" class="form-control"placeholder="abcd@abcd.com" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          
        </div>
        </fieldset>
  
        
  
    <!--Cierre del registro formulario-->
    <form id='demo-form' action="?" method="POST">
        <button class="g-recaptcha" data-sitekey="your_site_key" data-callback='onSubmit'>Submit</button>
        <br/>
      </form>
</body>
</html>