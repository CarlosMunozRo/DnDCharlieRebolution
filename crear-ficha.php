<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <script src="./Scripts/jquery.min.js" ></script>
    <script src="Scripts/login-dashboard.js"></script>
    <title>Crear Ficha</title>
</head>
<body class="Crear-Ficha">
    <?php include "Templates/header.php"?>
    <div class="Contenedor-hilo_ariadna">
        <a href="login-dashboard.php"><h2 class="hilo_ariadna">Dashboard</h2></a>
        <h2 class="hilo_ariadna">/</h2>
        <a href="login-dashboard.php"><h2 class="hilo_ariadna">Crear Ficha</h2></a>
    </div>
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

        $query = $pdo->prepare("select * from Razas;");
        $query->execute();


        $row = $query->fetchAll();

        $Razas = [];
        if($row){



            foreach($row as $dato){

                
                $queryRaza= $pdo->prepare('
                    select 
                    IFNULL(Dimension, (select Dimension from Razas where NombreRaza= :razaP )) as "Dimension",
                    IFNULL(Velocidad, 0)+(select IFNULL(Velocidad, 0) from Razas where NombreRaza= :razaP ) as "Velocidad",
                    IFNULL(Vision, (select Vision from Razas where NombreRaza= :razaP )) as "Vision",
                    IFNULL(RazaPadre,false) as "RazaPadre"
                    from Razas where NombreRaza= :razaB ;
                ');

                $queryRaza->bindParam(':razaB', $dato["NombreRaza"]);
                $queryRaza->bindParam(':razaP',$dato["RazaPadre"]);
                $queryRaza->execute();

                $rowR = $queryRaza->fetchAll();

                foreach($rowR as $datoR){

                    array_push($Razas,array("NombreRaza"=>$dato["NombreRaza"],"IncrementoEstadistica"=>$dato["IncrementoEstadistica"],"Dimension"=>$datoR["Dimension"],"Velocidad"=>$datoR["Velocidad"],"RazaPadre"=>$dato["RazaPadre"],"HasRazaPadre"=>$datoR["RazaPadre"]));

                }

            }
            
            ?>
                <script>
                    var razas =<?php echo json_encode($Razas) ?>
                </script>
            <?php

        }else{
            echo "No hay ninguna";
        }

        $query = $pdo->prepare("SELECT * FROM Clases;");
        $query->execute();


        $row = $query->fetchAll();

        $Clases = [];
        if($row){

            foreach($row as $clase){
                array_push($Clases,array("Nombre"=>$clase["NombreClase"],"Descripcion"=>$clase["Descripcion"]));
            }
            
            ?>
                <script>
                    var clases =<?php echo json_encode($Clases) ?>
                </script>
            <?php
        }

        $query = $pdo->prepare("SELECT * FROM Trasfondo;");
        $query->execute();


        $row = $query->fetchAll();

        $Trasfondos = [];
        if($row){

            foreach($row as $trasfondo){
                array_push($Trasfondos,array("Nombre"=>$trasfondo["Nombre"]));
            }
            
            ?>
                <script>
                    var trasfondos =<?php echo json_encode($Trasfondos) ?>
                </script>
            <?php
        }


        $query = $pdo->prepare("SELECT * FROM Idiomas;");
        $query->execute();


        $row = $query->fetchAll();

        $Idiomas = [];
        if($row){

            foreach($row as $idioma){
                array_push($Idiomas,array("Nombre"=>$idioma["NombreIdioma"]));
            }
            
            ?>
                <script>
                    var idiomas =<?php echo json_encode($Idiomas) ?>
                </script>
            <?php
        }


        $query = $pdo->prepare("SELECT * FROM Clases_Armas_Armaduras_Objetos;");
        $query->execute();

        $row = $query->fetchAll();

        $Equipamientos = [];
        if($row){

            foreach($row as $equipo){
                array_push($Equipamientos,array("Clase"=>$equipo["NombreClase"],"Arma"=>$equipo["NombreArma"],"Armadura"=>$equipo["NombreArmadura"],"Objeto"=>$equipo["NombreObjeto"]));
            }
            
            ?>
                <script>
                    var equipamientos =<?php echo json_encode($Equipamientos) ?>
                </script>
            <?php
        }


    ?>

    <div class="Crear_Form">
        <form id="autoForm" action="Ficha.php" method="GET" disabled></form>
    </div>


    <?php include "Templates/footer.php"?>

    <script src="Scripts/crear-ficha.js"></script>
</body>
</html>