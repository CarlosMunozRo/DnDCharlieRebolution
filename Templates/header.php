<?php 
    session_start();

    if(!empty($_POST["logout"])){
        unset($_SESSION["Usuario"]);
    }
    
    if(!$_SESSION["Usuario"]) {
        header("Location: home.php");
    }
    
?>
<header class="HEA_HeaderStyle1">
    <a href="login-dashboard.php">
        <img src="Media/Imagenes/DnDLogo.png" alt="d&d Logo">
    </a>
    <div>
        <div id="perfil-usuario" class="perfil-usuario centrar-contenido flex-row">
            <p><?php echo $_SESSION["Usuario"]?></p>
            <img src="Media/Imagenes/portrait-prueba.png" alt="Avatar">
        </div>
        <form action="" method="post">
            <nav class="nav-usuario centrar-contenido flex-column">
                <a href="#">Perfil</a>
                <a id="logout">Desconectar</a>
                <input type="hidden" name="logout" value="true">
            </nav>
        </form>
    </div>
</header>