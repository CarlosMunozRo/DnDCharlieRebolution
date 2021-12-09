<?php 

    if(!empty($_POST["usuario"]) && !empty($_POST["contrasenya"])){

        try {
            $hostname = "dndcharlierevolution.tk";
            $dbname = "DungeonsAndDragons";
            $username = "manolo";
            $pw = "manolo123";
            $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
          } catch (PDOException $e) {
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
            exit;
          }
    
    
          //preparem i executem la consulta
          $query = $pdo->prepare("select * FROM Usuarios where NombreUsuario= :user and Password= SHA2(:password,256)");
    
          $query->bindParam(':user', $_POST["usuario"]);
          $query->bindParam(':password',$_POST["contrasenya"]);
    
          $query->execute();      
    
    
            //comprovo errors:
          $e= $query->errorInfo();
          if ($e[0]!='00000') {
            echo "\nPDO::errorInfo():\n";
            die("Error accedint a dades: " . $e[2]);
          }  
        
    
          //anem agafant les fileres d'amb una amb una
          $row = $query->fetch();
    
          $login="no";
          if($row){
              session_start();
                
              $_SESSION["Usuario"] = $_POST["usuario"];

              header("Location: login-dashboard.php");
          }else{
              $login="no";
          }
    
    
    
          //eliminem els objectes per alliberar memòria 
          unset($pdo); 
          unset($query);
         

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <script src="./Scripts/jquery.min.js" ></script>
    <script src="./Scripts/home.js"></script>
</head>
<body class="home">

    <?php 
    
        if($login=="no"){
            ?>
                <div class="DIV_ERR_Message"><p>Los credenciales no son correctos</p><div><span>X</span></div></div>
            <?php
        }

    ?>
    
    <div class="centrar-contenido flex-row">
        <div class="DIV_Home-Izquierda">
            <div class="centrar-contenido flex-column"><img class="IMG_Home-imagen" src="./Media/Imagenes/DnDLogoHome.png"><h1 class="blanco">Character Creator</h1></div>
            <div class="centrar-contenido"><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate, sit ratione. Asperiores, eius. Modi fuga aperiam neque numquam illo dolor esse doloremque non. Est in commodi deserunt consequatur similique, recusandae, quibusdam fuga molestias dolorem nulla dolores provident corporis enim tempora autem delectus consequuntur quia, architecto hic! In cum obcaecati dolore?</p></div>
        </div>
        <div class="DIV_Home-Derecha centrar-contenido">
            <form action="" method="post">
                <div class="DIV_Home-Login">
                    <div>
                        <h3 class="blanco">Inicio de Sesion</h3>
                    </div>
                    <div>
                        <div class="centrar-contenido flex-column">
                            <label for="usuario">Nombre de Usuario:</label><input type="text" name="usuario" id="usuario">
                        </div>
                        <div class="centrar-contenido flex-column">
                            <label for="usuario">Contraseña:</label><div class="centrar-contenido position-relative"><input type="password" name="contrasenya" id="contrasenya"><i onclick="cambiarContrasenya()" class="fas fa-eye I_Alternar-Visivilidad-Contraseña"></i></div>
                        </div>
                        <div class="centrar-contenido flex-row DIV_Home-Login-enviar">
                            <div> <a href="Nueva-Cuenta.php">No recuerdas la contraseña?</a> </div>
                            <div> <input type="submit" value="Iniciar Sesion"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>