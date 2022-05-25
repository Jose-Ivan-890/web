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
                $registro=  $this->saca_registro("SELECT  * from rondas where Id=".$_POST['Id']);
            case 'new':
                echo '  <form method="post">
                  
                <div class="form-group">
                  <label >Palabra</label>
                  <input name="Palabra"  class="form-control"   placeholder=" Palabra" value="'.((isset($registro))?$registro->Palabra:"").'">
                 
                </div>
                <div class="form-group">
                  <label >NumeRondas</label>
                  <input name="NumeRondas"  class="form-control"   placeholder="NumeRondas" value="'.((isset($registro))?$registro->NumeRondas:"").'">
                 
                </div>
                <div class="form-group">
                  <label >IdInscritos</label>
                  <input name="IdInscritos"  class="form-control"   placeholder="IdInscritos" value="'.((isset($registro))?$registro->IdInscritos:"").'">
                 
                </div>
                
                
                <div class="form-group">
                  <label >IdCategoria</label>
                  <input name="IdCategoria"  class="form-control"   placeholder="IdCategoria" value="'.((isset($registro))?$registro->IdCategoria:"").'">
                </div>
                

                

                <div class="form-group">
                  <label >'.((isset($registro))?"Editar Puntos":"Puntos").'Puntos</label>
                  <input name="Puntos"  class="form-control"   placeholder="Puntos" value="'.((isset($registro))?$registro->Puntos:"").'">
                
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
                $this->consulta("DELETE from rondas where Id=".$_POST['Id']);
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
                    $this->consulta("INSERT into rondas set Palabra='".$_POST['Palabra']."' , NumeRondas='".$_POST['NumeRondas']."',IdInscritos='".$_POST['IdInscritos']."',IdCategoria='".$_POST['IdCategoria']."',Puntos='".$_POST['Puntos']."'");
                    $this->accion("listar");
            break;    
            case 'listar':
                   echo $this->despTabla("Select r.Id, Palabra, NumeRondas, i.Fecha as Inscrito, c.Nombre  as Categoria, Puntos from rondas r join inscritos i on i.Id=r.IdInscritos join categoria c on r.IdCategoria=c.Id order by Nombre ","Rondas.php","table-success");
                break;
                case 'update':
                    $this->consulta("UPDATE rondas set Palabra='".$_POST['Palabra']."' , NumeRondas='".$_POST['NumeRondas']."',IdInscritos='".$_POST['IdInscritos']."',IdCategoria='".$_POST['IdCategoria']."',Puntos='".$_POST['Puntos']."' Where Id=".$_POST['Id']);
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