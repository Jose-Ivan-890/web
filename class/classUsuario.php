<?php
if (!isset($_SESSION['nombre'])) {
    session_start();
}
include "classBD.php";
class Usuario extends baseDatos
{
    
    function __construct()
    {
        # code...
    }
    function procesa($accion)
    {
        $html='';
        switch ($accion) {
            case 'perfil':
                $usuario=  $this->saca_registro("SELECT  * from usuario where email='".$_SESSION['email']."'");
                $html.='<div class="container">
                <form id="formUsuario">
                <div class="row"><h3>Perfil de usuarios</h3></div>
                <div class="row"><label class="col-4">Nombre</label><div class="col-8">
                <input type="text" class="form-control" value="'.$usuario->Nombre.'" name="Nombre" id="Nombre" />
                </div>
                <label class="col-4">Apellidos</label><div class="col-8">
                <input type="text" class="form-control" value="'.$usuario->Apellido.'" name="Apellidos" id="Apellidos" />
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="Genero"  '.((isset($usuario)&&$usuario->Genero==="F")?"checked":"").' value="F">
                <label class="form-check-label" for="F1">  Femenino </label>
                </div>

                <div class="form-check">
                <input class="form-check-input" type="radio" name="Genero"  '.((isset($usuario)&&$usuario->Genero==='M')?"checked":"").' value="M" >
                <label class="form-check-label" for="M1">
                  Masculino
                </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="Genero"  '.((isset($usuario)&&$usuario->Genero==="O")?"checked":"").' value="O">
                  <label class="form-check-label" for="O1">Otre </label>
                </div>
                <div class="row mt-4"><button type="button" class="btn btn-sm btn-success" onclick="usuarios(\'update\')">Actualizar</button></div>
 </form></div>';    
                break;
            case 'update':
                $this->consulta("UPDATE usuario set Nombre='".$_POST['Nombre']."', Apellido='".$_POST['Apellidos']."',Genero='".$_POST['Genero']."' Where email='".$_SESSION['email']."'");
                $_SESSION['nombre']=$_POST['Nombre']." ".$_POST['Apellidos'];
                $html="<script>
                $('#lblNombre').html('".$_POST['Nombre']." ".$_POST['Apellidos']."');
                alerta('Aviso','Datos Actualizados','m','green')</script>";
                break;
            default:
               $html.="classUsuario".$accion." no esta programada";
                break;
        }
        return $html;
    }
    
}

if (isset($_REQUEST['accion'])) {
    $oUsuarios=new Usuario();
    echo $oUsuarios->procesa($_REQUEST['accion']);
}else {
   echo "NO HAY ACCION";
}
?>