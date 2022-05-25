<?php
session_start();

if (!isset($_SESSION['nombre'])) {
    header('location: login.php?e=20' );
}
elseif (!$_SESSION['isAdmin']) {
    header('location: login.php?e=21' );
}

include '../class/classBD.php';
include './cabecera.php';

class Usuario extends baseDatos{
    function accion($tipo)
    {
        switch ($tipo) {
            case 'edit':
                $registro=  $this->saca_registro("SELECT  * from palabras where Id=".$_POST['Id']);
            case 'new':
                echo '  <form method="post">
                  
                <div class="form-group">
                  <label >'.((isset($registro))?"Editar Palabra":"Nueva Palabra").'</label>
                  <input name="Palabra"  class="form-control"   placeholder=" Palabra" value="'.((isset($registro))?$registro->Palabra:"").'">
                 
                 

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
                $this->consulta("DELETE from palabras where Id=".$_POST['Id']);
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
                    $this->consulta("INSERT into palabras set Palabra='".$_POST['Palabra']."' ");
                    $this->accion("listar");
            break;    
            case 'listar':
                   echo $this->despTabla("Select Id, palabra   from palabras   order by palabra ","Palabras.php","table-success");
                break;
                case 'update':
                    $this->consulta("UPDATE palabras set Palabra='".$_POST['Palabra']."' ,IdCategoria='".$_POST['IdCategoria']."' Where Id=".$_POST['Id']);
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