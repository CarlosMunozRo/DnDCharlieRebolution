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
    $("#form1").append("<label for='nombre'>Nom: </label>")
    $("#form1").append("<input id='nombre'type='text' name='nombre'></input>")
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

    
    $("#forButton4").append("<a class='BTN_A_ST1_Pequeño icono-animation-atras' onclick='removeSkillPoints()'><i class='fas fa-undo-alt'></i></a>");

    $("#forButton4").append("<a class='BTN_A_ST2_Pequeño icono-animation-delante' onclick='crearFormTrasfondo()'><i class='fas fa-arrow-right'></i></a>")


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

function removeRazas(){

    $('#form1 input').removeAttr("readonly");
    $('#form1 a').toggleClass("hidden");

    $('#form2').remove();


}

function removeClases(){

    $('#form2 select').removeAttr("disabled");
    $('#form2 a').toggleClass("hidden");
    $('#form3').remove();

}

function removeSkillPoints(){

    $('#form3 select').removeAttr("disabled");
    $('#form3 a').toggleClass("hidden");
    $('#form4').remove();

}

function skill_dropdownmenu(id){

    menu = generate_menu(id)
    $("#m"+id.substr(1)).append(menu)

}
function generate_menu(id){
    var menu = $("<select id='"+id+"' name='"+id.substring(2)+"' class='points'></select>")
    $(menu).append("<option value='0'>8</option>")
    $(menu).append("<option value='1'>9</option>")
    $(menu).append("<option value='2'>10</option>")
    $(menu).append("<option value='3'>11</option>")
    $(menu).append("<option value='4'>12</option>")
    $(menu).append("<option value='5'>13</option>")
    $(menu).append("<option value='7'>14</option>")
    $(menu).append("<option value='9'>15</option>")

    return menu;
}
function updatemenu(pnt,inpval,idform){
    var total = parseInt(pnt)
    if(total>=9){
        add_menu_option(idform) 
    }
    var difrencia=$("#"+idform+" option:selected").next().val()-inpval
    var coste = parseInt(difrencia)
    if(coste>total){
        $("#"+idform+" option:selected").nextAll().remove()
    }
    
    if(total<=9 && inpval<=total){
        if(total>7 && total<8){
            $("#"+idform+" option[value=9]").remove()
            
            if($("#"+idform+" option[value=1]").length ==0){
                $("#"+idform).append("<option value='1'>9</option>")            
            }
            if($("#"+idform+" option[value=2]").length ==0){
                $("#"+idform).append("<option value='2'>10</option>")
            }
            if($("#"+idform+" option[value=3]").length ==0){
                $("#"+idform).append("<option value='3'>11</option>")
            }
            if($("#"+idform+" option[value=4]").length ==0){
                $("#"+idform).append("<option value='4'>12</option>")
            }
            if($("#"+idform+" option[value=5]").length ==0){
                $("#"+idform).append("<option value='5'>13</option>")
            }
            if($("#"+idform+" option[value=7]").length ==0){
                $("#"+idform).append("<option value='7'>14</option>")

            }
            
        }else if(total>4 && total<7){
            $("#"+idform+" option[value=9]").remove()
            $("#"+idform+" option[value=7]").remove()
            if($("#"+idform+" option[value=1]").length ==0){
                $("#"+idform).append("<option value='1'>9</option>")            
            }
            if($("#"+idform+" option[value=2]").length ==0){
                $("#"+idform).append("<option value='2'>10</option>")
            }
            if($("#"+idform+" option[value=3]").length ==0){
                $("#"+idform).append("<option value='3'>11</option>")
            }
            if($("#"+idform+" option[value=4]").length ==0){
                $("#"+idform).append("<option value='4'>12</option>")
            }
            if($("#"+idform+" option[value=5]").length ==0){
                $("#"+idform).append("<option value='5'>13</option>")
            }

        }else if(total==4){
            $("#"+idform+" option[value=9]").remove()
            $("#"+idform+" option[value=7]").remove()
            $("#"+idform+" option[value=5]").remove()
            if($("#"+idform+" option[value=1]").length ==0){
                $("#"+idform).append("<option value='1'>9</option>")            
            }
            if($("#"+idform+" option[value=2]").length ==0){
                $("#"+idform).append("<option value='2'>10</option>")
            }
            if($("#"+idform+" option[value=3]").length ==0){
                $("#"+idform).append("<option value='3'>11</option>")
            }
            if($("#"+idform+" option[value=4]").length ==0){
                $("#"+idform).append("<option value='4'>12</option>")
            }
        }else if(total==3){
            $("#"+idform+" option[value=9]").remove()
            $("#"+idform+" option[value=7]").remove()
            $("#"+idform+" option[value=5]").remove()
            $("#"+idform+" option[value=4]").remove()
            if($("#"+idform+" option[value=1]").length ==0){
                $("#"+idform).append("<option value='1'>9</option>")          
            }
            if($("#"+idform+" option[value=2]").length ==0){
                $("#"+idform).append("<option value='2'>10</option>")
            }
            if($("#"+idform+" option[value=3]").length ==0){
                $("#"+idform).append("<option value='3'>11</option>")
            }

        }else if(total==2){
            $("#"+idform+" option[value=9]").remove()
            $("#"+idform+" option[value=7]").remove()
            $("#"+idform+" option[value=5]").remove()
            $("#"+idform+" option[value=4]").remove()
            $("#"+idform+" option[value=3]").remove()
            if($("#"+idform+" option[value=1]").length ==0){
                $("#"+idform).append("<option value='1'>9</option>")          
            }
            if($("#"+idform+" option[value=2]").length ==0){
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
function remove_options(idform){
    
}
function add_menu_option(idform){
    if($("#"+idform+" option[value=1]").length ==0){
        $("#"+idform).append("<option value='1'>9</option>")            
    }
    if($("#"+idform+" option[value=2]").length ==0){
        $("#"+idform).append("<option value='2'>10</option>")
    }
    if($("#"+idform+" option[value=3]").length ==0){
        $("#"+idform).append("<option value='3'>11</option>")
    }
    if($("#"+idform+" option[value=4]").length ==0){
        $("#"+idform).append("<option value='4'>12</option>")
    }
    if($("#"+idform+" option[value=5]").length ==0){
        $("#"+idform).append("<option value='5'>13</option>")
    }
    if($("#"+idform+" option[value=7]").length ==0){
        $("#"+idform).append("<option value='7'>14</option>")

    }
    if($("#"+idform+" option[value=9]").length ==0){
        $("#"+idform).append("<option value='9'>15</option>")

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


function crearFormIdiomas(){


    $('#form5 select').attr('disabled','true');

    $('#form5 a').toggleClass('hidden');

    $('form#autoForm').append($('<div id="form6"></div>').addClass("form_input"));

    if(idiomas){
        idiomas.forEach(idioma => {
            $('#form6').append($("<label for='"+idioma["Nombre"]+"'></label>").text(idioma["Nombre"]));


            $('<input type="checkbox" id="'+idioma["Nombre"]+'" name="idiomas[]">').val(idioma["Nombre"]).insertAfter($('label[for="'+idioma["Nombre"]+'"]'));
        });
    }

    $('#form6').append("<a class='BTN_A_ST1_Pequeño icono-animation-atras' onclick='removeIdiomas()'><i class='fas fa-undo-alt'></i></a>");

    $('#form6').append("<a class='BTN_A_ST2_Pequeño icono-animation-delante' onclick='crearFormEquipamiento()'><i class='fas fa-arrow-right'></i></a>");

    $('#form6 input[type="checkbox"]').change(function(e) {

        if($('#form6 input[type="checkbox"]:checked').length>3){
            $(e.target).prop( "checked", false );
        }
        
    });


}

function crearFormTrasfondo(){

    $('#form4 select').attr('disabled','true');

    $('#form4 a').toggleClass('hidden');

    $('form#autoForm').append($('<div id="form5"></div>').addClass("form_input"));

    $('#form5').append($('<select id="trasfondo" name="trasfondo"></select>'));

    if(trasfondos){
        trasfondos.forEach(trasfondo => {
            $('select#trasfondo').append($('<option></option>').val(trasfondo["Nombre"]).text(trasfondo["Nombre"]));
        });
    }

    $('#form5').append("<a class='BTN_A_ST1_Pequeño icono-animation-atras' onclick='removeTrasfondo()'><i class='fas fa-undo-alt'></i></a>");

    $('#form5').append("<a class='BTN_A_ST2_Pequeño icono-animation-delante' onclick='crearFormIdiomas()'><i class='fas fa-arrow-right'></i></a>");


}

function removeTrasfondo(){

    $('#form4 select').removeAttr("disabled");
    $('#form4 a').toggleClass("hidden");
    $('#form5').remove();

}

function removeIdiomas(){

    $('#form5 select').removeAttr("disabled");
    $('#form5 a').toggleClass("hidden");
    $('#form6').remove();

}

function crearFormEquipamiento(){

    if($('#form6 input[type="checkbox"]:checked').length!=3){
        return;
    }

    var curEquipo;

    equipamientos.forEach(equipo=>{
        if(equipo["Clase"]==$('select[name="clase"]').val()) {
            curEquipo=equipo;
            return;
        }
    });

    $('#form6 input[type="checkbox"]').attr('disabled','true');

    $('#form6 a').toggleClass('hidden');

    $('form#autoForm').append($('<div id="form7"></div>').addClass("form_input").addClass("formEquipamiento"));


    $('#form7').append($('<label id="LB_arma">Arma: </label>'));
    $('<input type="text" name="arma" disabled/>').val(curEquipo["Arma"]).insertAfter('label#LB_arma');

    $('#form7').append($('<label id="LB_armadura">Armadura: </label>'));
    $('<input type="text" name="armadura" disabled/>').val(curEquipo["Armadura"]).insertAfter('label#LB_armadura');

    $('#form7').append($('<label id="LB_objeto">Objecto: </label>'));
    $('<input type="text" name="objeto" disabled/>').val(curEquipo["Objeto"]).insertAfter('label#LB_objeto');


    $('#form7').append("<a onclick='submitForm()' type='submit' class='BTN_A_ST1_Pequeño icono-animation-delante'><i class='fas fa-arrow-right'></i></a>");


} 

function submitForm(){
    $('select').removeAttr("disabled");
    $('input').removeAttr("disabled");
    $(" #autoForm ").submit();
}