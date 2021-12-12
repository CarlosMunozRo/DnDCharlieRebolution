var formNum=1;

$(document).ready(function (){

    

    $('.DIV_ERR_Message >div>span').click(()=>{
        $('.DIV_ERR_Message').hide();
    });
    create_sheet();


});
var formNum=0;


function create_sheet(){
    $("#autoForm").append("<div id='form1' class='form_input '></div>")
    $("#form1").append("<label for='sh_name'>Nom: </label>")
    $("#form1").append("<input id='sh_name'type='text'></input>")
    $("#form1").append("<div id='forButton'></div>")
    $("#forButton").append("<a class='BTN_A_ST2_Pequeño icono-animation-delante' onclick='crearFormRazas()'><i class='fas fa-arrow-right'></i></a>")
}

function crearFormRazas(){


    if(!$('#form2')){
        return;
    }

    if($('#form1 input').val()==''){
        return;
    }

    $('#form1 a').toggleClass('hidden');

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

    $('#form2 a').toggleClass('hidden');

    $('form#autoForm').append($('<div id="form3"></div>').addClass("form_input"));

    $('#form3').append($('<select id="clase" name="clase"></select>'));

    if(clases){
        clases.forEach(clase => {
            $('select#clase').append($('<option></option>').val(clase["Nombre"]).text(clase["Nombre"]));
        });
    }

    $('#form3').append("<a class='BTN_A_ST1_Pequeño icono-animation-atras' onclick='removeClases()'><i class='fas fa-undo-alt'></i></a>");

    $('#form3').append("<a class='BTN_A_ST2_Pequeño icono-animation-delante' onclick='skill_points()'><i class='fas fa-arrow-right'></i></a>");


}

function skill_points(){


    $('#form3 select').attr('disabled','true');

    $('#form3 a').toggleClass('hidden');

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
    $("#skillsform").append("<div id='forButton4' class='input_butoni'></div>")
    $("#forButton4").append("<a class='BTN_A_ST1_Pequeño icono-animation-atras' onclick='removeSkillPoints()'><i class='fas fa-undo-alt'></i></a>");

    $("#forButton4").append("<a class='BTN_A_ST2_Pequeño icono-animation-delante'><i class='fas fa-arrow-right'></i></a>")

}

function removeRazas(){

    $('#form1 input').removeAttr("readonly");
    $('#form1 a').toggleClass("hidden");

    $('#form2').remove();


}

function removeClases(){

    $('#form2 select').removeAttr("disabled");
    $('#form2 a').toggleClass("hidden");
    $('#form3').remove();

};

function removeSkillPoints(){

    $('#form3 select').removeAttr("disabled");
    $('#form3 a').toggleClass("hidden");
    $('#skillsform').remove();

}