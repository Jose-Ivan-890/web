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
                $registro=  $this->saca_registro("SELECT  * from usuario where Id=".$_POST['Id']);
            case 'new':
                echo '  <form method="post">
                  
                <div class="form-group">
                  <label >nombre</label>
                  <input name="Nombre"  class="form-control"   placeholder=" Nombre" value="'.((isset($registro))?$registro->Nombre:"").'">
                 
                </div>
                <div class="form-group">
                  <label >apellido</label>
                  <input name="Apellido"  class="form-control"   placeholder="Apellido" value="'.((isset($registro))?$registro->Apellido:"").'">
                 
                </div>
                <div class="form-group">
                  <label >Email</label>
                  <input name="Email"  class="form-control"   placeholder="Email" value="'.((isset($registro))?$registro->Email:"").'">
                 
                </div>
                
                <div class="form-check">
                <input class="form-check-input" type="radio" name="Genero"  '.((isset($registro)&&$registro->Genero==="F")?"checked":"").' value="F">
                <label class="form-check-label" for="F1">  Femenino </label>
                </div>

                <div class="form-check">
                <input class="form-check-input" type="radio" name="Genero"  '.((isset($registro)&&$registro->Genero==='M')?"checked":"").' value="M" >
                <label class="form-check-label" for="M1">
                  Masculino
                </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="Genero"  '.((isset($registro)&&$registro->Genero==="O")?"checked":"").' value="O">
                  <label class="form-check-label" for="O1">Otre </label>
                </div>
                <!--
                <div class="form-group">
                  <label >Genero</label>
                  <input name="Genero"  class="form-control"   placeholder="Genero" value="'.((isset($registro))?$registro->Genero:"").'">
                </div>
                -->

                <div class="form-group">
                  <label >Foto</label>
                  '.((isset($registro)&& is_file("../fotosUsuarios/".$registro->Id.".".$registro->Foto))?'<img src="'."../fotosUsuarios/".$registro->Id.".".$registro->Foto.'"  class="foto">':'<img src="../fotosUsuarios/userX.png" class="foto" />').'            
                </div>

                <div class="form-group">
                  <label >TipoUsuario</label>
                  <!-- <input name="IdTipo"  class="form-control"   placeholder="TipoUsuario" value="'.((isset($registro))?$registro->IdTipo:"").'"> -->
                '.$this->createSelect("tipoUsuario","Id","Nombre","IdTipo",isset($registro)?$registro->IdTipo:0).
               '
                </div>
                <div class="form-group">
                  <label >'.((isset($registro))?"Editar Password":"Nuevo Password").'</label>
                  <input name="Clave" required class="form-control"   placeholder="Contraseña" value="">
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
                            $cadena.=$campo."=password('".$valor."'),";
                        }
                        else {
                            $cadena.=$campo."='".$valor."',";
                        }
                        $cadena=substr($cadena,0,-1);
                        $this->consulta($cadena);
                         $this->accion("listar");
                    }
                }
                */
                    $this->consulta("INSERT into usuario set Nombre='".$_POST['Nombre']."' , Apellido='".$_POST['Apellido']."',Email='".$_POST['Email']."',Genero='".$_POST['Genero']."',IdTipo='".$_POST['IdTipo']."', Clave=password('".$_POST['Clave']."')");
                    $this->accion("listar");
            break;    
            case 'listar':
                   echo $this->despTabla("Select U.Id,Email,concat(U.Nombre,' ',U.Apellido) as Usuario,Genero,FechaUltiAcceso,TP.Nombre from usuario U join tipousuario TP on Tp.Id=U.IdTipo order by Nombre ","Usuario.php","table-success");
                break;
                case 'update':
                    $this->consulta("UPDATE usuario set Nombre='".$_POST['Nombre']."', Apellido='".$_POST['Apellido']."',Email='".$_POST['Email']."',Genero='".$_POST['Genero']."',IdTipo='".$_POST['IdTipo']."', Clave=password('".$_POST['Clave']."') Where Id=".$_POST['Id']);
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