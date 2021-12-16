$(document).ready(function (){
    click();
    editMenu();    
});

function click(){
    $(".img").click(function(e){  
        console.log("hola");
        var nombre = ($(e.target).parent().parent().find(".info").children("p:first").text())
        if($(".addImagen").length==0){
            añadirImagen(nombre);
            clickCerrar();
            
        }else {
            eliminarImagen()
        }
    })

    
}
function editMenu(){
    $(".img").mouseenter(function(e){
        $(e.target).parent().append("<div class='edit'></div>")
    });

    $(".img").mouseleave(function(){
        $('.edit').remove();
    });
    
}
function clickCerrar(){
    $("#cierras").click(function(){
        eliminarImagen()
    })
}

//Select nombre de la carta
//$(".img").parent().find(".info").children("p").eq(0)

function añadirImagen(nombre){
    $("body").append("<div class='addImagen'></div>")

    $(".addImagen").append("<h3 style='color:white;'>Cambiar Imagen</h3>")
    $(".addImagen").append("<form action='' method='post' name='subida-imagenes' enctype='multipart/form-data'>")
    $("form[name=subida-imagenes]").append("<input class='imagen_inpt' type='file' name='imagen1'/>")
    $("form[name=subida-imagenes]").append("<input hidden type='text' name='personaje' value='"+nombre+"'/>")
    $("form[name=subida-imagenes]").append("<input class='enviarFoto' action='enviarNombre' type='submit' name='subir-imagen' value='Enviar imagen' />")
    $(".addImagen").append("<p id=cierras class='esquinacierre'>X</p>")
}
function eliminarImagen(){
    $(".addImagen").remove()
}
function enviarNombre(){
    cument.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
    
}