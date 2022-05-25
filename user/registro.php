<?php

session_start();
$v1=rand()%10;
$v2=rand()%10;
$v3=rand()%10;
$v5=rand()%10;
$s1=(rand()%100>75)?'+':((rand()%100>50)?"-":"*");
$s2=(rand()%100>75)?'+':((rand()%100>50)?"-":"*");
$cadena=$v1.$s1.$v2.$s2.$v3;

switch ($s1) {
    case '+': $resu=$v1+$v2; break;
    case '-': $resu=$v1-$v2; break;
    case '*': $resu=$v1*$v2; break;  
    default:
        # code...
        break;     
}
switch ($s2) {
    case '+': $resu+=$v3; break;
    case '-': $resu-=$v3; break;
    case '*': $resu*=$v3; break;  
     
}
$_SESSION['calculo']=$resu;

?>
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
<!--Inicio registro-->
      <form method="post" action="recursos\registrarse.php">
        
        <legend>
            Registro
        </legend>

        <div>
            <label for="nombre">Nombre:</label>
            <input name="nombre" type="text" class="form-control" autofocus="" placeholder="Escribe aqui tu nombre " 
                required="required" >
        </div>
        <div>
            <label for="nombre">Apellido:</label>
            <input name="apellidos" type="text" class="form-control" autofocus="" placeholder="Escribe aqui tu apellido" 
                required="required" >
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Email:</label>
            <input name="email" type="email" class="form-control" placeholder="abcd@abcd.com" id="exampleInputEmail1"  placeholder="Enter email">
            
          </div>

        <br/>
        <div>
            
            <input name= calculo type="text" placeholder="Cuanto es: <?  echo ($cadena); ?>   "> 
        </div>

    

    <button type="submit" class="btn btn-primary">
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;">Enviar</font>
        </font>
    </button>
    
</form>
<!--Finaliza el registro-->
</body>
</html>