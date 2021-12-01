$(document).ready(function(){

    function toggleNavegacion(){
        $("header nav").slideToggle("slow");
    }

    function logout(){
        $("#logout").parent().parent().submit();
    }

    $("#perfil-usuario").click(toggleNavegacion);
    $("header nav").css("display", "none");
    
    $("#logout").click(logout);

})