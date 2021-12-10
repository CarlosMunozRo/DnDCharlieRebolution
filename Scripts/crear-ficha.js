$(document).ready(function (){
    $('.DIV_ERR_Message >div>span').click(()=>{
        $('.DIV_ERR_Message').hide();
    });
    create_sheet();
});

function create_sheet(){
    var formNum=1;
    $("#autoForm").append("<div id='form"+formNum+"' class='form_input '></div>")
    $("#form"+formNum).append("<label for='sh_name'>Nom: </label>")
    $("#form"+formNum).append("<input id='sh_name'type='text'></input>")
    $("#form"+formNum).append("<div id='forButton'></div>")
    $("#forButton").append("<button class='BTN_NoA_ST2_Pequeño icono-animation-delante'><i class='fas fa-arrow-right'></i></button>")

    formNum++;
};