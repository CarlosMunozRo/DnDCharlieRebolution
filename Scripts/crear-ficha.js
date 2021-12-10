$(document).ready(function (){

    crearFormRazas();
    crearFormClases();


    $('.DIV_ERR_Message >div>span').click(()=>{
        $('.DIV_ERR_Message').hide();
    });
    create_sheet();

});


function crearFormRazas(){

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

function crearFormClases(){

    console.log(clases);

    $('form#formulario').append($('<div id="Div_Clases"></div>'));

    $('#Div_Clases').append($('<select id="clase" name="clase"></select>'));

    if(clases){
        clases.forEach(clase => {
            $('select#clase').append($('<option></option>').val(clase["Nombre"]).text(clase["Nombre"]));
        });
    }



}

function create_sheet(){
    var formNum=1;
    $("#autoForm").append("<div id='form"+formNum+"' class='form_input '></div>")
    $("#form"+formNum).append("<label for='sh_name'>Nom: </label>")
    $("#form"+formNum).append("<input id='sh_name'type='text'></input>")
    $("#form"+formNum).append("<div id='forButton'></div>")
    $("#forButton").append("<button class='BTN_NoA_ST2_Pequeño icono-animation-delante'><i class='fas fa-arrow-right'></i></button>")

    formNum++;
};
