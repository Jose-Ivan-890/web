function rank(accion,Id,texto) {
    switch (accion) {
        case 'insert':
            
            break;
        case 'miRanking':
            ajax("../class/classRank.php",{'accion':accion},"areaTrabajo");
            break

        case 'perfil':
            ajax("../class/classRank.php",{'accion':accion},"areaTrabajo");
            break
        
    case 'update':
                
           
                formulario=$("#formRank").serialize()+"&accion="+accion;
                ajax("../class/classRank.php",formulario,"areaTrabajo");
                break
        default:
            alerta("Aviso","Esa opion no esta programado en usuarios en rank.js");
            break;
    }
}