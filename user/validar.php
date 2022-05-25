<?php
session_start();   //VAS A COMENSAR UNA SESION
include "class/classBD.php";
//hay varias formas de incluir {include require}
if (isset($_POST['email']) and isset( $_POST['clave'])) {
    $oBD = new baseDatos();  //aqui llamammos a una clse  debe estar igual su nombre
    $registro= $oBD->saca_registro("Select * from usuario where Email='".$_POST['email']."' and Clave=password('".$_POST['clave']."') ;");
    if ($oBD->numeRegistros==1) {
        
        //SE GENERA  Y ALMACENA LAS VARIABLES DE SESION PERTINENTES 
        
        $_SESSION['nombre']=$registro->Nombre." ".$registro->Apellido; //aqui tomamos el nombre y apellido
        $_SESSION['email']=$_POST['email']; //tomamos el valor de email
        $_SESSION['isAdmin']=false;
       
       
        if ($registro->IdTipo==1) {
            $_SESSION['isAdmin']=true;
            header("location: admin/home.php");
        }
      
        else {
            header("location: user/home.php");
        }
           
    }
    else {
       
        header("location: login.php?e=1");

    }

}
else {
    
    header("location: index.php?e=11"); //el espacio entre location y index es indispensable en algunas verciones
}



//Nivel de seguridad 
//Nivel 1 {usuario y contraseña}
//Nivel 2 {evita inyecciones SQL} or '1'='1'
//Nivel 3 {contraseñas cifradas}
//Nivel 4 Servidor Protegido contra ataques

?>