<?php

    $nombre=$_GET["sh_name"];
    $raza=$_GET["raza"];
    $clase=$_GET["clase"];
    $trasfondo=$_GET["trasfondo"];

    $fuerza= intval($_GET["fuerza"]);

    $destreza=intval($_GET["destreza"]);

    $constitucion= intval($_GET["consti"]);

    $inteligencia=intval($_GET["intel"]);

    $sabiduria=intval($_GET["sabi"]);

    $carisma=intval($_GET["carism"]);

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

    $query = $pdo->prepare("select * from Personajes;");
    $query->execute();     
    
    $e= $query->errorInfo();
    if ($e[0]!='00000') {
      echo "\nPDO::errorInfo():\n";
      die("Error accedint a dades: " . $e[2]);
    }  
    
    $row = $query->fetchAll();

    $flag_existe=false;
    foreach($row as $ficha){
        if($ficha["Nombre"]==$nombre){
            $flag_existe=true;
        }
    }


    if($flag_existe){

      

    }else{
      echo "Nombre: $nombre <br>";

      echo "Raza: $raza <br>";
  
      echo "Clase: $clase <br>";
  
      echo "Puntos: f: $fuerza destreza: $destreza constitucion: $constitucion inteligencia: $inteligencia sabiduria: $sabiduria carisma: $carisma";

      $query = $pdo->prepare("insert into Personajes(Nombre,Raza,Clase,Trasfondo,Fuerza,Destreza,Constitucion,inteligencia,Sabiduria,Carisma)
          Values(:nombre,:raza,:clase,:trasfondo,:fuerza,:destreza,:constitucion,:inteligencia,:sabiduria,:carisma)");
          $query->bindParam(':nombre', $nombre);
          $query->bindParam(':raza', $raza);
          $query->bindParam(':clase', $clase);
          $query->bindParam(':trasfondo', $trasfondo);
          $query->bindParam(':fuerza',$destreza );
          $query->bindParam(':destreza', $destreza);
          $query->bindParam(':constitucion', $constitucion);
          $query->bindParam(':inteligencia', $inteligencia);
          $query->bindParam(':sabiduria', $sabiduria);
          $query->bindParam(':carisma', $carisma);
          $query->execute();
    }




?>