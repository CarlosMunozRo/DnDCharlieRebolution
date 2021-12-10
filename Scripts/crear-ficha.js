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
    $("#form"+formNum).append("<div id='forButton"+formNum+"' class='input_butoni'></div>")
    $("#forButton"+formNum).append("<a class='BTN_NoA_ST2_Pequeño icono-animation-delante' onclick='skill_points()'><i class='fas fa-arrow-right'></i></a>")
    formNum++;
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