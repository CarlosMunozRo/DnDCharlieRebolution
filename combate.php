<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Listar Ficha</title>
	<link rel="stylesheet" href="styles.css">
    <script src="./Scripts/jquery.min.js" ></script>
    <script src="Scripts/login-dashboard.js"></script>
    <script type="module" src="Scripts/3d.js"></script>

</head>
<body class="combate">
    <?php include "Templates/header.php"?>


	<div class="Contenedor-hilo_ariadna">
        <a href="login-dashboard.php"><h2 class="hilo_ariadna">Dashboard</h2></a>
        <h2 class="hilo_ariadna">/</h2>
        <a href="probar-ficha.php"><h2 class="hilo_ariadna">Probar Ficha</h2></a>
    </div>

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

        
            $query = $pdo->prepare('select Personajes.*, Clases.DG from Usuarios_Personajes
            inner join Personajes on Usuarios_Personajes.PersonajeID=Personajes.PersonajeID
            inner join Usuarios on Usuarios_Personajes.UsuarioID =Usuarios.UsuarioID
            inner join Clases on Personajes.Clase=Clases.NombreClase 
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
                            <button onclick="tirarDado(<?php echo $ficha['DG'] ?>,<?php echo $ficha['Fuerza'] ?>,'Fuerza')" class="BTN_NoA_ST1_Pequeño">Fuerza</button>
                            <button onclick="tirarDado(<?php echo $ficha['DG'] ?>,<?php echo $ficha['Destreza'] ?>,'Destreza')" class="BTN_NoA_ST1_Pequeño">Destreza</button>
                            <button onclick="tirarDado(<?php echo $ficha['DG'] ?>,<?php echo $ficha['Constitucion'] ?>,'Constitucion')" class="BTN_NoA_ST1_Pequeño">Constitucion</button>
                            <button onclick="tirarDado(<?php echo $ficha['DG'] ?>,<?php echo $ficha['inteligencia'] ?>,'inteligencia')" class="BTN_NoA_ST1_Pequeño">Inteligencia</button>
                            <button onclick="tirarDado(<?php echo $ficha['DG'] ?>,<?php echo $ficha['Sabiduria'] ?>,'Sabiduria')" class="BTN_NoA_ST1_Pequeño">Sabiduria</button>
                            <button onclick="tirarDado(<?php echo $ficha['DG'] ?>,<?php echo $ficha['Carisma'] ?>,'Carisma')" class="BTN_NoA_ST1_Pequeño">Carisma</button>
                        </div>

                    </div>

                <?php

                return;
            }

        ?>
    </section>

    

    

</body>
</html>