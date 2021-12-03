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

        $query = $pdo->prepare("select NombreRaza from Razas;");
  
        $query->execute();


        $row = $query->fetch();


        if($row){

            foreach($row as $dato){
                print_r($dato);
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