<?php
if (!isset($_SESSION['nombre'])) {
    session_start();
}
include "classBD.php";
class Rank extends baseDatos
{
    
    function __construct()
    {
        # code...
    }
    function procesa($accion)
    {
        $html='';
        switch ($accion) {
            case 'miRanking':
           $html=$this->listado("SELECT sum(puntos) as Puntos ,concat(Nombre,' ',Apellido) 
           as Persona from rondas R join inscritos I on R.IdInscritos=I.Id join Usuario U 
           on U.Id=R.IdInscritos group by Persona order by Puntos desc limit 10;");
                break;
            case 'perfil':
                $Rondas=  $this->saca_registro("SELECT  * from Rondas where email='".$_SESSION['email']."'");
                $html.='<div class="container">
                <form id="formRank">
                <div class="row"><h3>Perfil de usuarios</h3></div>
                <div class="row"><label class="col-4">Nombre</label><div class="col-8">
                <input type="text" class="form-control" value="'.$Rondas->Nombre.'" name="Nombre" id="Nombre" />
                </div>
                <label class="col-4">Apellidos</label><div class="col-8">
                <input type="text" class="form-control" value="'.$Rondas->Apellido.'" name="Apellidos" id="Apellidos" />
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="Genero"  '.((isset($Rondas)&&$Rondas->Genero==="F")?"checked":"").' value="F">
                <label class="form-check-label" for="F1">  Femenino </label>
                </div>

                <div class="form-check">
                <input class="form-check-input" type="radio" name="Genero"  '.((isset($Rondas)&&$Rondas->Genero==='M')?"checked":"").' value="M" >
                <label class="form-check-label" for="M1">
                  Masculino
                </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="Genero"  '.((isset($Rondas)&&$Rondas->Genero==="O")?"checked":"").' value="O">
                  <label class="form-check-label" for="O1">Otre </label>
                </div>
                <div class="row mt-4"><button type="button" class="btn btn-sm btn-success" onclick="usuarios(\'update\')">Actualizar</button></div>
 </form></div>';    
                break;
            case 'update':
                $this->consulta("UPDATE Rondas set Nombre='".$_POST['Nombre']."', Apellido='".$_POST['Apellidos']."',Genero='".$_POST['Genero']."' Where email='".$_SESSION['email']."'");
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
function listado($query,$pColor="")
    {
        
        $this->consulta($query);
        $anchoIcon="5%";
        $html='<div class="container" ><table class="table table-hover '.$pColor.'">';
        //cabeceras
        $html.='<tr class="table-dark"> ';
    
        
       
        for ($i=0; $i < mysqli_num_fields($this->bloque); $i++) { 
            $campo=mysqli_fetch_field_direct($this->bloque,$i);
            $html.='<th>'.$campo->name.'</th>';
     
        }
            $html.='</tr >';
        //fin Cabeceras
        
        for ($i=0; $i < $this->numeRegistros;  $i++) { 
           $registro=mysqli_fetch_array($this->bloque);
           $html.='<tr class="">';
           $html.= '';
           $html.= '<td width="5%">
           
         ';        
           '</td>';
           
          
           
           for ($c=0; $c < count($registro)/2; $c++) { 
            $html.='<td>'.$registro[$c].'</td>';
            
           }
           
           $html.='</tr>';
        }
        return $html.'</table> </div>';
    }

}

if (isset($_REQUEST['accion'])) {
    $oRank=new Rank();
    echo $oRank->procesa($_REQUEST['accion']);
}else {
   echo "NO HAY ACCION";
}
?>