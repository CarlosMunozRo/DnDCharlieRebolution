$(document).ready(function (){

    crearFormRazas();

});


function crearFormRazas(){

    console.log(razas);

    $('form#formulario').append($('<div id="Div_Razas"></div>'));
    $('#Div_Razas').append($('<select id="raza" name="raza"></select>'));

    for(var i=0; i<razas.length;i++){
        $('select#raza').append($('<option></option>').val(razas[i]["NombreRaza"]).text(razas[i]["NombreRaza"]));
    }

    

}