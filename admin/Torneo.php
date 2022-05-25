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
                $registro=  $this->saca_registro("SELECT  * from torneo where Id=".$_POST['Id']);
            case 'new':
                echo '  <form method="post">
                  
                <div class="form-group">
                  <label >Fecha</label>
                  <input name="Fecha" type="date" class="form-control"   placeholder=" Fecha" value="'.((isset($registro))?$registro->Fecha:"").'">
                 
                </div>
                <div class="form-group">
                  <label >Fecha Limite</label>
                  <input name="FechaLimite" type="date"  class="form-control"   placeholder="FechaLimite" value="'.((isset($registro))?$registro->FechaLimite:"").'">
                 
                </div>
                <div class="form-group">
                  <label >Costo</label>
                  <input name="Costo"  class="form-control"   placeholder="Email" value="'.((isset($registro))?$registro->Costo:"").'">
                 
                </div>
                
              
                <div class="form-group">
                  <label >Tiempo Ronda</label>
                  <input name="TiemRonda" type="time" class="form-control"   placeholder="TiemRonda" value="'.((isset($registro))?$registro->TiemRonda:"").'">
                </div>
                
                <div class="form-group">
                <label >Premio</label>
                <input name="Premio"  class="form-control"   placeholder="Premio" value="'.((isset($registro))?$registro->Premio:"").'">               
              </div>

              <div class="form-group">
              <label >Hora Inicio</label>
              <input name="HoraInicio" type="time"  class="form-control"   placeholder="HoraInicio" value="'.((isset($registro))?$registro->HoraInicio:"").'">
              </div>
                

                <div class="form-group">
                  <label >Rondas Maximas</label>
                  <input name="NumeRondasMaximas"  class="form-control"   placeholder="NumeRondasMaximas" value="'.((isset($registro))?$registro->NumeRondasMaximas:"").'">
                 
                </div>

                <div class="form-group">
                  <label >'.((isset($registro))?"Editar PuntosMeta":"Puntos Meta").'</label>
                  <input name="PuntosMeta"  class="form-control"   placeholder="PuntosMeta" value="'.((isset($registro))?$registro->PuntosMeta:"").'">
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
                $this->consulta("DELETE from torneo where Id=".$_POST['Id']);
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
                    $this->consulta("INSERT into torneo set FechaLimite='".$_POST['FechaLimite']."', Fecha='".$_POST['Fecha']."',Costo='".$_POST['Costo']."',TiemRonda='".$_POST['TiemRonda']."',Premio='".$_POST['Premio']."', HoraInicio='".$_POST['HoraInicio']."',NumeRondasMaximas='".$_POST['NumeRondasMaximas']."',PuntosMeta='".$_POST['PuntosMeta']."'");
                    $this->accion("listar");
            break;    
            case 'listar':
                   echo $this->despTabla("Select * from torneo  ","Torneo.php","table-success");
                break;
                case 'update':
                    $this->consulta("UPDATE torneo set FechaLimite='".$_POST['FechaLimite']."', Fecha='".$_POST['Fecha']."',Costo='".$_POST['Costo']."',TiemRonda='".$_POST['TiemRonda']."',Premio='".$_POST['Premio']."', HoraInicio='".$_POST['HoraInicio']."',NumeRondasMaximas='".$_POST['NumeRondasMaximas']."',PuntosMeta='".$_POST['PuntosMeta']."' Where Id=".$_POST['Id']);
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