var formNum=1;

$(document).ready(function (){

    

    $('.DIV_ERR_Message >div>span').click(()=>{
        $('.DIV_ERR_Message').hide();
    });
    create_sheet();


});
var formNum=0;


function create_sheet(){
    $("#autoForm").append("<div id='form"+formNum+"' class='form_input '></div>")
    $("#form"+formNum).append("<label for='sh_name'>Nom: </label>")
    $("#form"+formNum).append("<input id='sh_name'type='text'></input>")
    $("#form"+formNum).append("<div id='forButton'></div>")
    $("#forButton").append("<a class='BTN_A_ST2_Pequeño icono-animation-delante' onclick='crearFormRazas()'><i class='fas fa-arrow-right'></i></a>")

    formNum++;
}

function crearFormRazas(){


    if(!$('#form2')){
        return;
    }

    

    $('#form1 input').attr('readonly','true');


    razas.sort(function(a, b) {
        var keyA = new Date(a.updated_at),
          keyB = new Date(b.updated_at);
        if (keyA < keyB) return -1;
        if (keyA > keyB) return 1;
        return 0;
      });
    

    $('form#autoForm').append($('<div id="form2"></div>').addClass("form_input"));
    $('#form2').append($('<select id="raza" name="raza"></select>'));

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

    $('#form2').append("<a class='BTN_A_ST1_Pequeño icono-animation-atras' onclick='removeRazas()'><i class='fas fa-undo-alt'></i></a>");


    $('#form2').append("<a class='BTN_A_ST2_Pequeño icono-animation-delante' onclick='crearFormClases()'><i class='fas fa-arrow-right'></i></a>");



}

function crearFormClases(){

    $('#form2 select').attr('disabled','true');

    $('form#autoForm').append($('<div id="form3"></div>').addClass("form_input"));

    $('#form3').append($('<select id="clase" name="clase"></select>'));

    if(clases){
        clases.forEach(clase => {
            $('select#clase').append($('<option></option>').val(clase["Nombre"]).text(clase["Nombre"]));
        });
    }

    $('#form3').append("<a class='BTN_A_ST1_Pequeño icono-animation-atras' onclick='removeClases()'><i class='fas fa-undo-alt'></i></a>");

    $('#form3').append("<a class='BTN_A_ST2_Pequeño icono-animation-delante' onclick='crearFormRazas()'><i class='fas fa-arrow-right'></i></a>");


}


function removeRazas(){

    $('#form1 input').removeAttr("readonly");

    $('#form2').remove();


}

function removeClases(){

    $('#form2 select').removeAttr("disabled");

    $('#form3').remove();

};

function skill_points(){
    $("#autoForm").append("<div id='skillsform' class='form_input '></div>")
    $("#skillsform").append("<p id='puntosres'>27</p>")
    $("#skillsform").append("<label for='d_fuerza'>Fuerza</label>")
    $("#skillsform").append("<input id='d_fuerza'type='number' value='8' min='8' max='15'></input>")
    $("#skillsform").append("<label for='d_destreza'>Destreza</label>")
    $("#skillsform").append("<input id='d_destreza'type='number' value='8' min='8' max='15'></input>")
    $("#skillsform").append("<label for='d_const'>Constitucion</label>")
    $("#skillsform").append("<input id='d_const'type='number' value='8' min='8' max='15'></input>")
    $("#skillsform").append("<label for='d_intel'>Inteligencia</label>")
    $("#skillsform").append("<input id='d_intel'type='number' value='8' min='8' max='15'></input>")
    $("#skillsform").append("<label for='d_sabi'>Sabiduria</label>")
    $("#skillsform").append("<input id='d_sabi'type='number' value='8' min='8' max='15'></input>")
    $("#skillsform").append("<label for='d_carism'>Carisma</label>")
    $("#skillsform").append("<input id='d_carism'type='number' value='8' min='8' max='15'></input>")
    
    $("#skillsform").append("<div id='forButton"+formNum+"' class='input_butoni'></div>")
    $("#forButton"+formNum).append("<a class='BTN_NoA_ST2_Pequeño icono-animation-delante'><i class='fas fa-arrow-right'></i></a>")
    formNum++;
}