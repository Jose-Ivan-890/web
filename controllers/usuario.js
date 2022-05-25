function usuarios(accion,Id,texto) {
    switch (accion) {
        case 'insert':
            
            break;
        case 'delete':
            break

        case 'perfil':
            ajax("../class/classUsuario.php",{'accion':accion},"areaTrabajo");
            break
        
    case 'update':
                
           
                formulario=$("#formUsuario").serialize()+"&accion="+accion;
                ajax("../class/classUsuario.php",formulario,"areaTrabajo");
                break
        default:
            alerta("Aviso","Esa opion no esta programado en usuarios");
            break;
    }
}