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
    $("#form4").append("<div id='m_fuerza'></div>")
    skill_dropdownmenu("d_fuerza")
    $("#form4").append("<label for='d_destreza'>Destreza</label>")
    $("#form4").append("<div id='m_destreza'></div>")
    skill_dropdownmenu("d_destreza")    
    $("#form4").append("<label for='d_consti'>Constitucion</label>")
    $("#form4").append("<div id='m_consti'></div>")
    skill_dropdownmenu("d_consti")    
    $("#form4").append("<label for='d_intel'>Inteligencia</label>")
    $("#form4").append("<div id='m_intel'></div>")
    skill_dropdownmenu("d_intel")   
     $("#form4").append("<label for='d_sabi'>Sabiduria</label>")
    $("#form4").append("<div id='m_sabi'></div>")
    skill_dropdownmenu("d_sabi")    
    $("#form4").append("<label for='d_carism'>Carisma</label>")
    $("#form4").append("<div id='m_carism'></div>")
    skill_dropdownmenu("d_carism")    
    $("#form4").append("<div id='forButton4' class='input_butoni'></div>")
    $("#forButton4").append("<a class='BTN_NoA_ST2_Pequeño icono-animation-delante'><i class='fas fa-arrow-right'></i></a>")
    var fuerza = 8;
    var destreza = 8;
    var consti = 8;
    var intel = 8;
    var sabi = 8;
    var carism = 8;
    //console.log(fuerza, destreza,consti,intel,sabi,carism)

    $("#form4 select").change(function (e){
        idselect=$(e.target).attr('id');
        formActual = $(e.target).attr('id').substr(2);
        var habilidad;
        if (formActual=="fuerza"){
            habilidad = fuerza;
        }else if(formActual=="destreza"){
            habilidad = destreza;
        }else if(formActual=="consti"){
            habilidad = consti;
        }else if(formActual=="intel"){
            habilidad = intel;
        }else if(formActual=="sabi"){
            habilidad = sabi;
        }else if(formActual=="carism"){
            habilidad = carism;
        }
            if((parseInt($(e.target).find(':selected').text()))>parseInt(habilidad)){
                perdida = resta($(e.target).val(),$("#"+idselect+" option:contains("+habilidad+")").val())
                $("#puntosres").text($("#puntosres").text()-perdida)
                habilidad = ($("#"+idselect+" option:selected").text())
            }else if((parseInt($(e.target).find(':selected').text()))<parseInt(habilidad)){
                ganancia = resta($("#"+idselect+" option:contains("+habilidad+")").val(),$(e.target).val())
                resultado = suma($("#puntosres").text(),ganancia)
                $("#puntosres").text(resultado)
                habilidad = ($("#"+idselect+" option:selected").text())
            }
        if (formActual=="fuerza"){
            fuerza = habilidad;
        }else if(formActual=="destreza"){
            destreza = habilidad;
        }else if(formActual=="consti"){
            consti = habilidad;
        }else if(formActual=="intel"){
            intel = habilidad;
        }else if(formActual=="sabi"){
            sabi  = habilidad;
        }else if(formActual=="carism"){
            carism  = habilidad;
        }
        //console.log(fuerza, destreza,consti,intel,sabi,carism)

        

        $("#form4 select").each(function(){
            var inpval = ($(this).val())
            var idform = ($(this).attr('id'))
            var pnt = $("#puntosres").text()
            updatemenu(pnt,inpval,idform);
       
        });
        

    });

}
function skill_dropdownmenu(id){

    menu = generate_menu(id)
    $("#m"+id.substr(1)).append(menu)

}
function generate_menu(id){
    var menu = $("<select id='"+id+"' class='points'></select>")
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
function updatemenu(pnt,inpval,idform){
    var total = parseInt(pnt)
    if(total>=9){
        if($("#"+idform+" option[value=9]").length ==0){
            $("#"+idform).append("<option value='1'>9</option>")
            $("#"+idform).append("<option value='2'>10</option>")
            $("#"+idform).append("<option value='3'>11</option>")
            $("#"+idform).append("<option value='4'>12</option>")
            $("#"+idform).append("<option value='5'>13</option>")
            $("#"+idform).append("<option value='7'>14</option>")
            $("#"+idform).append("<option value='9'>15</option>")

        } 
    }
    if(total<=9 && inpval<=total){
        if(total==8){
            $("#"+idform+" option[value=9]").remove()
            if($("#"+idform+" option[value=7]").length ==0){
                $("#"+idform).append("<option value='1'>9</option>")
                $("#"+idform).append("<option value='2'>10</option>")
                $("#"+idform).append("<option value='3'>11</option>")
                $("#"+idform).append("<option value='4'>12</option>")
                $("#"+idform).append("<option value='5'>13</option>")
                $("#"+idform).append("<option value='7'>14</option>")

            }
            
        }else if(total==6){
            $("#"+idform+" option[value=9]").remove()
            $("#"+idform+" option[value=7]").remove()
            if($("#"+idform+" option[value=5]").length ==0){
                $("#"+idform).append("<option value='1'>9</option>")            
                $("#"+idform).append("<option value='2'>10</option>")
                $("#"+idform).append("<option value='3'>11</option>")
                $("#"+idform).append("<option value='4'>12</option>")
                $("#"+idform).append("<option value='5'>13</option>")
            }

        }else if(total==4){
            $("#"+idform+" option[value=9]").remove()
            $("#"+idform+" option[value=7]").remove()
            $("#"+idform+" option[value=5]").remove()
            if($("#"+idform+" option[value=4]").length ==0){
                $("#"+idform).append("<option value='1'>9</option>")            
                $("#"+idform).append("<option value='2'>10</option>")
                $("#"+idform).append("<option value='3'>11</option>")
                $("#"+idform).append("<option value='4'>12</option>")
            }
        }else if(total==3){
            $("#"+idform+" option[value=9]").remove()
            $("#"+idform+" option[value=7]").remove()
            $("#"+idform+" option[value=5]").remove()
            $("#"+idform+" option[value=4]").remove()
            if($("#"+idform+" option[value=3]").length ==0){
                $("#"+idform).append("<option value='1'>9</option>")    
                $("#"+idform).append("<option value='2'>10</option>")
                $("#"+idform).append("<option value='3'>11</option>")
            }

        }else if(total==2){
            $("#"+idform+" option[value=9]").remove()
            $("#"+idform+" option[value=7]").remove()
            $("#"+idform+" option[value=5]").remove()
            $("#"+idform+" option[value=4]").remove()
            $("#"+idform+" option[value=3]").remove()
            if($("#"+idform+" option[value=2]").length ==0){
                $("#"+idform).append("<option value='1'>9</option>")          
                $("#"+idform).append("<option value='2'>10</option>")
            }

        }else if(total==1){
            $("#"+idform+" option[value=9]").remove()
            $("#"+idform+" option[value=7]").remove()
            $("#"+idform+" option[value=5]").remove()
            $("#"+idform+" option[value=4]").remove()
            $("#"+idform+" option[value=3]").remove()
            $("#"+idform+" option[value=2]").remove()
            if($("#"+idform+" option[value=1]").length ==0){
                $("#"+idform).append("<option value='1'>9</option>")
            }
            
            
        }else if(total==0){
            $("#"+idform+" option[value=9]").remove()
            $("#"+idform+" option[value=7]").remove()
            $("#"+idform+" option[value=5]").remove()
            $("#"+idform+" option[value=4]").remove()
            $("#"+idform+" option[value=3]").remove()
            $("#"+idform+" option[value=2]").remove()
            $("#"+idform+" option[value=1]").remove()

        }
    }
}
function suma(val1,val2){
    num1 = parseInt(val1)
    num2 = parseInt(val2)
    return num1+num2;
}
function resta(val1,val2){
    num1 = parseInt(val1)
    num2 = parseInt(val2)
    return num1-num2;
}