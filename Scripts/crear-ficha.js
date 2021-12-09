$(document).ready(function (){

    crearFormRazas();

});


function crearFormRazas(){

    console.log(razas);

    razas.sort(function(a, b) {
        var keyA = new Date(a.updated_at),
          keyB = new Date(b.updated_at);
        if (keyA < keyB) return -1;
        if (keyA > keyB) return 1;
        return 0;
      });
    

    $('form#formulario').append($('<div id="Div_Razas"></div>'));
    $('#Div_Razas').append($('<select id="raza" name="raza"></select>'));

    var tieneHijos=false;
    for(var i=0; i<razas.length;i++){
        $('select#raza').append($('<option></option>').val(razas[i]["NombreRaza"]).text(razas[i]["NombreRaza"]));

        if(razas[i]["HasRazaPadre"]=="0"){
            tieneHijos=false;
            razas.forEach(raza => {
                if (raza["RazaPadre"]==razas[i]["NombreRaza"]){
                    tieneHijos=true;
                }
            });

            if(tieneHijos){
                hijos=[];
                razas.forEach(raza => {
                    if(raza["RazaPadre"]==razas[i]["NombreRaza"]){
                        hijos.push(raza);
                    }
                });

                console.log(razas[i]["NombreRaza"]+" Tiene Hijos -> "+hijos);

                $('select#raza').append($('<optgroup></optgroup>').attr("label",razas[i]["NombreRaza"]));

                hijos.forEach(hijo => {
                    $('optgroup[label="'+razas[i]["NombreRaza"]+'"]').append($('<option></option>').val(hijo["NombreRaza"]).text(hijo["NombreRaza"]))
                });

            }else{
                $('select#raza').append($('<option></option>').val(razas[i]["NombreRaza"]).text(razas[i]["NombreRaza"]));
            }

        }
    }

}