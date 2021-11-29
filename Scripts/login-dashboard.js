$(document).ready(function(){

    function toggleNavegacion(){
        $("header nav").slideToggle("slow");
    }

    $("#perfil-usuario").click(toggleNavegacion);
    $("header nav").css("display", "none");
})