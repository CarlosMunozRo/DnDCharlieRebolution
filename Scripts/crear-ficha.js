$(document).ready(function (){

    crearFormRazas();

});


function crearFormRazas(){

    console.log(razas);

    $('<div id="Div_Razas"></div>').append($('<select id="raza" name="raza"></select>'));
    

    for(var i=0; i<razas.length;i++){
        $('<option></option>').val(razas[i]["NombreRaza"]).text(razas[i]["NombreRaza"]).append($('select#raza'));
    }

    

}