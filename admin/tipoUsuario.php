<?php
session_start();
//var_dump($_SESSION);
//exit;
if (!isset($_SESSION['nombre'])) {
    header("location: login.php?e=20");
}
else {
    if (!$_SESSION['isAdmin']) {
        header("location: login.php?e=21");       
    }      
}
include "./cabecera.php";
include "../class/classBD.php";

class Usuario extends baseDatos{
    function accion($tipo)
    {
        switch ($tipo) {

            case 'edit':
              $registro=  $this->saca_registro("SELECT  * from tipousuario where Id=".$_POST['Id']);
            case 'new':
                echo '  <form method="post" >
                  
                <div class="form-group">
                  <label >'.((isset($registro))?"Editar Registro":"Nuevo Tipo Usuario").'</label>
                  <input name="Nombre"  class="form-control"   placeholder="Enter Nombre" value="'.((isset($registro))?$registro->Nombre:"").'">
                 
                </div>
                
                <input type="submit" class="btn btn-primary" value="'.((isset($registro))?"Actualizar":"Ingresar").'">
                <input type="hidden" name="tipo" value="'.((isset($registro))?"update":"insert").'">
                ';
                if (isset($registro)) {
                    echo '<input type="hidden" name="Id" value="'.$registro->Id.'"/>';
                }
                echo'</form>';
                break;
            case 'delete':
                $this->consulta("DELETE from tipousuario where Id=".$_POST['Id']);
                $this->accion("listar");   
                break;
            case 'insert':
                   $this->consulta("INSERT into tipousuario set Nombre='".$_POST['Nombre']."'");
                   $this->accion("listar");
                break;
            case 'listar':
                   echo $this->despTabla("SELECT * from tipousuario order by Nombre ","tipoUsuario.php","table-danger");
                break;
                case 'update':
                   $this->consulta("UPDATE tipousuario set Nombre='".$_POST['Nombre']."' Where Id=".$_POST['Id']);
                   $this->accion("listar");      

                 break;
            
            default:
                echo "dapodioadiajdc";
                break;
        }
    }
   
}
$oUser = new Usuario();
if (isset($_POST['tipo'])) {
   $oUser->accion($_POST['tipo']);}
 else  {$oUser->accion('listar');}



include "./footer.php";

?>


<?php
//echo "Bienvenido".$_SESSION['nombre']." gracias";
?>