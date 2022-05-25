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
//include "../fpdf/fpdf.php";

class Usuario extends baseDatos{
    function accion($tipo)
    {
        switch ($tipo) {
            case 'edit':
                $registro=  $this->saca_registro("SELECT  * from inscritos where Id=".$_POST['Id']);
            case 'new':
                echo '  <form method="post">
                  
                <div class="form-group">
                  <label >'.((isset($registro))?"Editar Fecha":"Nueva Fecha").'</label>
                  <input name="Fecha" type="date" class="form-control"   placeholder=" Fecha" value="'.((isset($registro))?$registro->Fecha:"").'">
                 
                  </div>
                <div class="form-group">
                  <label >'.((isset($registro))?"Editar Pago":"Pago").'</label>
                  <input name="Pago"  class="form-control"   placeholder="IdUsuario" value="'.((isset($registro))?$registro->Pago:"").'">
               
                </div>

                </div>
                <div class="form-group">
                  <label >'.((isset($registro))?"Editar Usuario":" Usuario").'</label>
                  '.$this->createSelect("Usuario","Id","Nombre","IdUsuario",isset($registro)?$registro->IdUsuario:0).
                  '
                </div>
                <div class="form-group">
                  <label >'.((isset($registro))?"Editar Torneo":"Torneo").'</label>
                  
                  '.$this->createSelectFecha("Torneo","Id","FechaLimite","IdTorneo",isset($registro)?$registro->IdTorneo:0).
                  '
                </div>

                <div class="form-group">
                  <label >'.((isset($registro))?"Editar Factura":"Factura").'</label>
                  <input name="Factura"  class="form-control"   placeholder="Factura" value="'.((isset($registro))?$registro->Factura:"").'">
               
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
                $this->consulta("DELETE from usuario where Id=".$_POST['Id']);
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
                    $this->consulta("INSERT into inscritos set Fecha='".$_POST['Fecha']."' ,Pago='".$_POST['Pago']."' ,IdUsuario='".$_POST['IdUsuario']."',IdTorneo='".$_POST['IdTorneo']."'");
                    $this->accion("listar");
            break;    
            case 'listar':
                
                   echo $this->despTabla("Select i.Id, i.Fecha, Pago, t.Fecha as FechaTorneo, u.Nombre as Usuario  from inscritos i join Usuario u on i.IdUsuario=u.Id join Torneo t on t.Id=i.IdTorneo order by Nombre ","Inscritos.php","table-success");
                break;
            case 'update':
                    $this->consulta("UPDATE inscritos set Fecha='".$_POST['Fecha']."' , Pago='".$_POST['Pago']."' ,IdUsuario='".$_POST['IdUsuario']."',IdTorneo='".$_POST['IdTorneo']."' Where Id=".$_POST['Id']);
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