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
                $registro=  $this->saca_registro("SELECT  * from Categoria where Id=".$_POST['Id']);
            case 'new':
                echo '  <form method="post">
                  
                <div class="form-group">
                  <label >nombre</label>
                  <input name="Nombre"  class="form-control"   placeholder=" Nombre" value="'.((isset($registro))?$registro->Nombre:"").'">
                 
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
                $this->consulta("DELETE from categoria where Id=".$_POST['Id']);
                $this->accion("listar");
                break;
            case 'insert':
                /*
                $cadena="INSERT Usuario set"; //update $cadena="UPDATE Usuario set"; 
                foreach ($_POST as $campo => $valor) {
                    if (!in_array($campo,array("tipo"))) { //update if (!in_array($campo,array("tipo","Id","boton"))) { el boton tambien se omite si utilizamos input en name
                        if ($campo =='Clave') {
                            $cadena.=$campo."=password('".$valor."')";
                        }
                        else {
                            $cadena.=$campo."='".$valor."',";
                        }
                        $cadena=substr($cadena,-1);
                        $this->consulta($consulta."where Id=".$_POST['Id']);
                    }
                }
                */
                    $this->consulta("INSERT into categoria set Nombre='".$_POST['Nombre']."' ");
                    $this->accion("listar");
            break;    
            case 'listar':
                   echo $this->despTabla("Select * from categoria  order by Nombre ","Categoria.php","table-success");
                break;
                case 'update':
                    $this->consulta("UPDATE categoria set Nombre='".$_POST['Nombre']."' Where Id=".$_POST['Id']);
                    $this->accion("listar");      
 
                  break;
            default:
                # code...
                break;
        }
    }
   
}
$oUser = new Usuario();
if (isset($_POST['tipo'])) {
   $oUser->accion($_POST['tipo']);
}
else {
    $oUser->accion('listar');
}



include "./footer.php";

?>


<?php
//echo "Bienvenido".$_SESSION['nombre']." gracias";
?>