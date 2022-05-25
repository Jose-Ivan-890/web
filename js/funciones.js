function confirma(id,texto) {
    $.confirm({
        title:'Atencion!',
        type:'red',
        columnClass:'m',
        content: 'Esta seguro de eliminar'+texto,
        buttons:{
            confirm: function () {
$("#formDelete"+id).submit();
console.log("borrando"+id);
                
            },
            cancel:function () {},
        }
    })
}
///////
function alerta(titulo,texto,colum,color) {
    $.alert
({title:titulo,
   
    type:color,   
columnClass:colum,
    content: texto,

});
}
//incio de ajax
function ajax(pUrl,PFormulario,capa) {
    $.ajax
({type:"POST",
method: 'POST',
url: pUrl,
//data:{'datoA':a.value},
data:PFormulario,
beforeSend: function(){
//resultado.innerHTML="Procesando....";
$("#wait").html("Procesando....");
},
success: function(r){
$("#wait").html("");
$("#"+capa).html(r);
},

})
}