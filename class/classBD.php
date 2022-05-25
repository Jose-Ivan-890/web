<?
$conexion=mysqli_connect("localhost","userBasta","12345","basta");
class baseDatos 
{
    var $conexion;   //atributo para llamarlo en las funciones es con la palabra this
    var $bloque;
    var $numeRegistros;
    

    function conecta() //paso 1
    {
        $this->conexion=mysqli_connect("localhost","userBasta","12345","basta");
    }
    function consulta($query) //paso 2 Realizar la consulta
    {
        $this->conecta();//aqui manda llamar una funcion
        $this->bloque= mysqli_query($this->conexion,$query);
        if (strpos(strtoupper($query),"SELECT")!==false) {
            $this->numeRegistros=mysqli_num_rows($this->bloque);
        }
        else {
           $this->numeRegistros=0;
        }
        $this->cerrar($this->conexion);
        return $this->bloque;
    }


    function cerrar()//paso 4 Cerrar la conexion
    {
        mysqli_close($this->conexion);
    }
    function saca_registro($query)
    {
        $this->consulta($query);
        return mysqli_fetch_object($this->bloque);
    }
    function insertdato($query)
    {
        $this->bloque= mysqli_query($this->conexion,$query);
    }
    
    function despTabla($query,$control,$pColor="")
    {
        
        $this->consulta($query);
        $anchoIcon="5%";
        $html='<div class="container" ><table class="table table-hover '.$pColor.'">';
        //cabeceras
        $html.='<tr class="table-dark"> ';
    
        
        $html.= '<td colspan="2">
   <form method= "post" action="'.$control.'" >
   
   <input type="hidden" name="tipo" value="new"/>
   <input type="image" src="../imagenes/add.png"/ >
   
</form>
   </td>';
        for ($i=0; $i < mysqli_num_fields($this->bloque); $i++) { 
            $campo=mysqli_fetch_field_direct($this->bloque,$i);
            $html.='<th>'.$campo->name.'</th>';
     
        }
            $html.='</tr >';
        //fin Cabeceras
        
        for ($i=0; $i < $this->numeRegistros;  $i++) { 
           $registro=mysqli_fetch_array($this->bloque);
           $html.='<tr class="">';
           $html.= '<td width="5%">
           <form method= "post" action="'.$control.'">
           <input type="hidden" name="Id" value="'.$registro['Id'].'">
           <input type="hidden" name="tipo" value="edit">
           <input type="image" src="../imagenes/editar.png">
           </form>
           </td>';
           $html.= '<td width="5%">
           <form method= "post" id="formDelete'.$registro['Id'].'" action="'.$control.'">
           <input type="hidden" name="Id" value="'.$registro['Id'].'">
           <input type="hidden" name="tipo" value="delete">
           <img  src="../imagenes/delete.png" alt="" onclick="confirma('.$registro['Id'].',\''.$registro['Id'].'\')" />
           </form>
           ';
           
           if ($control=='Inscritos.php') {
            $html.= '
            <form method= "post" action="facturar.php" target="_blank" >
            <input type="hidden" name="Id" value="'.$registro['Id'].'">
            
            <input type="image" src="../imagenes/pdf.png" )">
            </form>
            ';
           }
           '</td>';
           
          
           
           for ($c=0; $c < count($registro)/2; $c++) { 
            $html.='<td>'.$registro[$c].'</td>';
            
           }
           
           $html.='</tr>';
        }
        return $html.'</table> </div>';
    }
    
    function createSelect($tablaForanea,$pk,$campDesplegar,$nombCampFormulario,$seleccionado)
    {
        
        $html='<select name="'.$nombCampFormulario.'" class="form-control">';
        $registros=$this->consulta("SELECT * from " .$tablaForanea. " order by " .$campDesplegar);
        foreach ($registros as $registro) {
            $html.= '<option '.(($seleccionado==$registro['Id'])?'selected':'').' value="'.$registro['Id'].'">'.$registro['Nombre'].'</option>';
        }
        
$html.='</select>';
return $html;
    }
    function createSelectFecha($tablaForanea,$pk,$campDesplegar,$nombCampFormulario,$seleccionado)
    {
        
        $html='<select name="'.$nombCampFormulario.'" class="form-control">';
        $registros=$this->consulta("SELECT * from " .$tablaForanea. " order by " .$campDesplegar);
        foreach ($registros as $registro) {
            $html.= '<option '.(($seleccionado==$registro['Id'])?'selected':'').' value="'.$registro['Id'].'">'.$registro['Fecha'].'</option>';
        }
        
$html.='</select>';
return $html;
    }
}

//los arreglos se llaman asiosativos

?>