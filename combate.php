<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Listar Ficha</title>
	<link rel="stylesheet" href="styles.css">
    <script src="./Scripts/jquery.min.js" ></script>
    <script src="Scripts/login-dashboard.js"></script>
</head>
<body class="combate">
    <?php include "Templates/header.php"?>
    <section>
        <?php
        
            try {
                $hostname = "dndcharlierevolution.ml";
            $dbname = "DungeonsAndDragons";
            $username = "master";
            $pw = "Master1234!";
            $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
            } catch (PDOException $e) {
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
            exit;
            }
        
            $query = $pdo->prepare('select Personajes.* from Usuarios_Personajes
            inner join Personajes on Usuarios_Personajes.PersonajeID=Personajes.PersonajeID
            inner join Usuarios on Usuarios_Personajes.UsuarioID =Usuarios.UsuarioID
            where Usuarios.NombreUsuario="'.$_SESSION["Usuario"].'" and Personajes.PersonajeID='.$_GET["IDPersonaje"].';');
            $query->execute();

            $row = $query->fetchAll();

            foreach($row as $ficha){

                ?>
                
                    <div>
                        <div class="flex combate-contenedor">
                            <?php
                                echo"<div class='contenedor'>
                                <div class='carta'>
                                    <div class='img'>
                                        <img src='/Media/Imagenes/".$ficha["Raza"].".jpeg'/>
                                    </div>
                                    <div class='info'>
                                        <h3>Nombre:</h2>
                                        <p>".$ficha["Nombre"]."</p>
                                        <h3>Clase:</h2>
                                        <p>".$ficha["Clase"]."</p>
                                        <h3>Raza:</h2>
                                        <p>".$ficha["Raza"]."</p>
                                    </div>
                                </div>
                                
                            </div>";
                            ?>
                        
                            <div class='contenedor'>
                                <div class='carta'>
                                    <div class='img'>
                                        <img src='/Media/Imagenes/abominatiogus.jpg'/>
                                    </div>
                                    <div class='info'>
                                        <h3>Nombre:</h2>
                                        <p>Abominatiogus</p>
                                        <h3>Clase:</h2>
                                        <p>SuS</p>
                                        <h3>Raza:</h2>
                                        <p>Tripulante</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="combate-container-botones">
                            <div>

                            </div>
                        </div>

                    </div>

                <?php

                return;
            }

        ?>
    </section>

</body>
</html>