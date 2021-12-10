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
    <script src="./Scripts/crear-ficha.js"></script>
    <title>Crear Ficha</title>
    
</head>
<body class="Crear-Ficha">
    <?php include "Templates/header.php"?>

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
                    IFNULL(Dimension, (select Dimension from Razas where NombreRaza=":razaP")) as "Dimension",
                    IFNULL(Velocidad, 0)+(select IFNULL(Velocidad, 0) from Razas where NombreRaza=":razaP") as "Velocidad",
                    IFNULL(Vision, (select Vision from Razas where NombreRaza=":razaP")) as "Vision",
                    IFNULL(RazaPadre,false) as "RazaPadre"
                    from Razas where NombreRaza=":razaB";
                ');

                $queryRaza->bindParam(':razaB', $dato["NombreRaza"]);
                $queryRaza->bindParam(':razaP',$dato["RazaPadre"]);
                print_r($dato["NombreRaza"]);
                $queryRaza->execute();

                $rowR = $queryRaza->fetchAll();

                foreach($rowR as $datoR){
                    
                    print_r(array("NombreRaza"=>$dato["NombreRaza"],"IncrementoEstadistica"=>$dato["IncrementoEstadistica"],"Dimension"=>$datoR["Dimension"],"Velocidad"=>$datoR["Velocidad"],"RazaPadre"=>$dato["RazaPadre"],"HasRazaPadre"=>$datoR["RazaPadre"]));

                    array_push($Razas,array("NombreRaza"=>$dato["NombreRaza"],"IncrementoEstadistica"=>$dato["IncrementoEstadistica"],"Dimension"=>$datoR["Dimension"],"Velocidad"=>$datoR["Velocidad"],"RazaPadre"=>$dato["RazaPadre"],"HasRazaPadre"=>$datoR["RazaPadre"]));

                }

                foreach($Razas as $sheesh){
                    print_r($sheesh);
                }

            }

        }else{
            echo "No hay ninguna";
        }

    ?>
    
    <section>
        Label: Raza
    </section>
    <div class="Crear_Form">
        <form id="autoForm"></form>
    </div>
    <?php include "Templates/footer.php"?>


    <!--boton crear ficha-->
    <!-- boton mirar tus fichas -->
    <!-- boton probar ficha -->

</body>
</html>