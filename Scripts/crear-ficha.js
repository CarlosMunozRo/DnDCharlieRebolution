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
    $("#autoForm").append("<div id='form4' class='form_input '></div>")
    $("#form4").append("<p id='puntosres'>27</p>")
    $("#form4").append("<label for='d_fuerza'>Fuerza</label>")
    $("#form4").append("<div id='d_fuerza'></div>")
    skill_dropdownmenu("d_fuerza")
    $("#form4").append("<label for='d_destreza'>Destreza</label>")
    $("#form4").append("<div id='d_destreza'></div>")
    skill_dropdownmenu("d_destreza")    
    $("#form4").append("<label for='d_const'>Constitucion</label>")
    $("#form4").append("<div id='d_const'></div>")
    skill_dropdownmenu("d_const")    
    $("#form4").append("<label for='d_intel'>Inteligencia</label>")
    $("#form4").append("<div id='d_intel'></div>")
    skill_dropdownmenu("d_intel")   
     $("#form4").append("<label for='d_sabi'>Sabiduria</label>")
    $("#form4").append("<div id='d_sabi'></div>")
    skill_dropdownmenu("d_sabi")    
    $("#form4").append("<label for='d_carism'>Carisma</label>")
    $("#form4").append("<div id='d_carism'></div>")
    skill_dropdownmenu("d_carism")    
    $("#form4").append("<div id='forButton4' class='input_butoni'></div>")
    $("#forButton4").append("<a class='BTN_NoA_ST2_Pequeño icono-animation-delante'><i class='fas fa-arrow-right'></i></a>")

    $("#form4 select").change(function (e){

        console.log($(e.target).val());
        console.log($(e.target).find(':selected').text());

        $("#puntosres").text($("#puntosres").text()-$(e.target).val())

        $("#form4 select").each(function(){
            console.log($(this).val());
       
        });


    });

}
function skill_dropdownmenu(id){
    var pnt=$("#puntosres").text()

    menu = generate_menu(pnt)
    $("#"+id).append(menu)

}
function generate_menu(pnt){
    var menu = $("<select class='points'></select>")
    $(menu).append("<option value='0'>8</option>")
    $(menu).append("<option value='1'>9</option>")
    $(menu).append("<option value='2'>10</option>")
    $(menu).append("<option value='3'>12</option>")
    $(menu).append("<option value='4'>12</option>")
    $(menu).append("<option value='5'>13</option>")
    $(menu).append("<option value='7'>14</option>")
    $(menu).append("<option value='9'>15</option>")
    return menu;
}