<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="./Scripts/jquery.min.js" ></script>
    <script src="Scripts/login-dashboard.js"></script>
    <title>Dashboard</title>
</head>
<body class="login-dashboard">
    <?php include "Templates/header.php"?>

    <?php
    
        try {
            $hostname = "dndcharlierevolution.tk";
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

        $Razas = []
        if($row){



            foreach($row as $dato){

                $Raza={"NombreRaza":$dato["NombreRaza"]};
                $Raza={"IncrementoEstadistica":$dato["IncrementoEstadistica"]};
                $Raza={"RazaPadre":$dato["RazaPadre"]};
                array_push($Razas,$Raza);

                
                $queryRaza= $pdo->prepare('
                    select IncrementoEstadistica,
                    IFNULL(Dimension, (select Dimension from Razas where NombreRaza=":razaP")) as "Dimension",
                    IFNULL(Velocidad, 0)+(select IFNULL(Velocidad, 0) from Razas where NombreRaza=":razaP") as "Velocidad",
                    IFNULL(Vision, (select Vision from Razas where NombreRaza=":razaP")) as "Vision",
                    IFNULL(RazaPadre,false) as "RazaPadre"
                    from Razas where NombreRaza=":razaB";
                ');

                $query->bindParam(':razaB', $dato["NombreRaza"]);
                $query->bindParam(':razaP',$dato["RazaPadre"]);

                $queryRaza->execute();

                $rowR = $queryRaza->fetchAll();

                foreach($rowR as $datoR){
                    
                    $Raza={"Dimension":$datoR["Dimension"]};
                    $Raza={"Velocidad":$datoR["Velocidad"]};
                    $Raza={"HasRazaPadre":$datoR["RazaPadre"]};

                }

                print_r($Raza);
                

            }

        }else{
            echo "No hay ninguna";
        }

    ?>

    <section>
        Label: Raza
    </section>



    <!--boton crear ficha-->
    <!-- boton mirar tus fichas -->
    <!-- boton probar ficha -->

</body>
</html>