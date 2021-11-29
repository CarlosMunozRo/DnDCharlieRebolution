
function cambiarContrasenya(){  // Alterna la visibilidad de la contraseña

    if($('.fa-eye').length==1){
        passwordShow();
    }else{
        passwordHide();
        
    }

}

function passwordHide(){
    $('.fas').removeClass('fa-eye-slash');
    $('.fas').addClass('fa-eye');
    $('#contrasenya').attr("type","password");
}

function passwordShow(){
    $('.fas').removeClass('fa-eye');
    $('.fas').addClass('fa-eye-slash');
    $('#contrasenya').attr("type","text");
}