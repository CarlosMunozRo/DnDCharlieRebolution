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

    session_start();

    

    if(!strpos($_SERVER['HTTP_REFERER'], "/listar-ficha.php") && !strpos($_SERVER['HTTP_REFERER'], "/Ficha.php") && $_SERVER['HTTP_REFERER']){
        
        if($_GET["idiomas"]==""){
            header($_SERVER['HTTP_REFERER']);
            header("Location: crear-ficha.php");
        }
        

        $nombre=$_GET["nombre"];
        $raza=$_GET["raza"];
        $clase=$_GET["clase"];
        $trasfondo=$_GET["trasfondo"];
        $idiomas=$_GET["idiomas"];

        

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

        
        if($flag_existe == false){

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


            $select = $pdo->prepare("select * from Personajes where nombre ='".$nombre."';");
            $select->execute();
        
            $row = $select->fetchAll();
        
            foreach($row as $ficha){
                print_r("hola");
                if($ficha["Nombre"]==$nombre){
                    $idiomas_insertar="";
                    foreach($idiomas as $idioma){
                        if($idioma==end($idiomas)){
                            $idiomas_insertar.=$idioma;
                            continue;
                        }
                        $idiomas_insertar.=$idioma.",";
                    }
        
                    $query2 = $pdo->prepare('update Personajes set Idiomas ="'.$idiomas_insertar.'" where PersonajeID= '.$ficha["PersonajeID"].' ;');
                    $query2->execute();
        
                    $query3 = $pdo->prepare('INSERT INTO Usuarios_Personajes VALUES ('.$_SESSION["UsuarioID"].','.$ficha["PersonajeID"].');');
                    $query3->execute();
        
                    
                }  
            }

        }

    
    }
    

    
    $select = $pdo->prepare("select Personajes.* ,Clases.DG from Personajes inner join Clases on Personajes.Clase=Clases.NombreClase where nombre ='".$_GET["nombre"]."';");
    $select->execute();

    $row = $select->fetchAll();

    

    foreach($row as $ficha){




            $nombre=$ficha["Nombre"];
            $raza=$ficha["Raza"];
            $clase=$ficha["Clase"];
            $trasfondo=$ficha["Trasfondo"];
            $idiomas="Comun,Enano";

            if($ficha["Idiomas"]){
                $idiomas=$ficha["Idiomas"];
            }

            $fuerza=$ficha["Fuerza"];
            $destreza=$ficha["Destreza"];
            $carisma=$ficha["Carisma"];
            $sabiduria=$ficha["Sabiduria"];
            $inteligencia=$ficha["inteligencia"];
            $constitucion=$ficha["Constitucion"];
            $dado=$ficha["DG"];
            $imagen=$ficha["Imagen"];

            $query5 = $pdo->prepare("SELECT * FROM Clases_Armas_Armaduras_Objetos where NombreClase='".$clase."';");
            $query5->execute();

            $row2 = $query5->fetchAll();

            
            if($row2){
                foreach($row2 as $equipo){
                    $arma=$equipo["NombreArma"];
                    $armadura=$equipo["NombreArmadura"];
                    $objeto=$equipo["NombreObjeto"];
                }
            }else{
                $arma="Arco corto";
                $armadura="Cuero";
                $objeto="Saco de dormir";
            }
            
    }




?>


    <!DOCTYPE html>
    <html>
    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="styles.css">
    	<title>Ficha</title>
        <script src="./Scripts/jquery.min.js" ></script>

        <link rel="stylesheet" href="styles.css">
    </head>
<body class="ficha">        
	<div class="Contenedor-hilo_ariadna">
        <a href="login-dashboard.php"><h2 class="hilo_ariadna">Dashboard</h2></a>
        <h2 class="hilo_ariadna">/</h2>
        <a href="listar-ficha.php"><h2 class="hilo_ariadna">Listar Ficha</h2></a>
        <h2 class="hilo_ariadna">/</h2>
        <a ></a><h2 class="hilo_ariadna">Ficha</h2></a>
    </div>




    <div class="sec_ficha">
        <div class="header_ficha flex space-between">
            <div>

                <?php if($_GET['exportPDF']!=1):?>
                    <div class="laFoto img">
                        <?php

                            if (!empty($imagen)){ 
                                echo "<img src='./Media/Uploads/".$imagen."'/>";
                            
                            }else {
                                echo "<img src='/Media/Imagenes/".$raza.".jpeg'/>";
                            };
                        ?>
                    </div>
                <?php endif; ?>

                <div class="text-center titulo3">
                    <?php echo $nombre ?>
                </div>
            </div>
            <div class="text-left titulo3">
                <div>Raza: <span><?php echo $raza ?></span></div>
                <div>Clase: <span><?php echo $clase ?></span></div>
                <div>Trasfondo: <span><?php echo $trasfondo ?></span></div>
            </div>
        </div>
        
        <div class="flex">

            <div class="flex">
                <div class="puntos_habilidad">
                    <div class="wraper-default">
                        <div class="text-center">Fuerza</div>
                        <div class="text-center"><?php echo $fuerza ?></div>
                        <div class="text-center">10</div>
                    </div>
                    <div class="wraper-default">
                        <div class="text-center">Destreza</div>
                        <div class="text-center"><?php echo $destreza ?></div>
                        <div class="text-center">10</div>
                    </div>
                    <div class="wraper-default">
                        <div class="text-center">Constitucion</div>
                        <div class="text-center"><?php echo $constitucion ?></div>
                        <div class="text-center">10</div>
                    </div>
                    <div class="wraper-default">
                        <div class="text-center">Inteligencia</div>
                        <div class="text-center"><?php echo $inteligencia ?></div>
                        <div class="text-center">10</div>
                    </div>
                    <div class="wraper-default">
                        <div class="text-center">Sabiduria</div>
                        <div class="text-center"><?php echo $sabiduria ?></div>
                        <div class="text-center">10</div>
                    </div>
                    <div class="wraper-default">
                        <div class="text-center">Carisma</div>
                        <div class="text-center"><?php echo $carisma ?></div>
                        <div class="text-center">10</div>
                    </div>
                </div>
                <div class="habilidades wraper-default">
                        <div class="wraper-default"><span>+<?php echo $destreza ?></span> Acrobacias <span>(Des)</span></div>
                        <div class="wraper-default"><span>+<?php echo $inteligencia ?></span> Arcanos <span>(Int)</span></div>
                        <div class="wraper-default"><span>+<?php echo $fuerza ?></span> Atletismo <span>(Fue)</span></div>
                        <div class="wraper-default"><span>+<?php echo $carisma ?></span> Engño <span>(Car)</span></div>
                        <div class="wraper-default"><span>+<?php echo $inteligencia ?></span> Historia <span>(Int)</span></div>
                        <div class="wraper-default"><span>+<?php echo $carisma ?></span> Interpretacion <span>(Car)</span></div>
                        <div class="wraper-default"><span>+<?php echo $carisma ?></span> Intimidation <span>(Car)</span></div>
                        <div class="wraper-default"><span>+<?php echo $inteligencia ?></span> Investigation <span>(Int)</span></div>
                        <div class="wraper-default"><span>+<?php echo $destreza ?></span> Juego de Manos <span>(Des)</span></div>
                        <div class="wraper-default"><span>+<?php echo $sabiduria ?></span> Medicina <span>(Sab)</span></div>
                        <div class="wraper-default"><span>+<?php echo $inteligencia ?></span> Naturaleza <span>(Int)</span></div>
                        <div class="wraper-default"><span>+<?php echo $sabiduria ?></span> Percepcion <span>(Sab)</span></div>
                        <div class="wraper-default"><span>+<?php echo $sabiduria ?></span> Perspicacia <span>(Sab)</span></div>
                        <div class="wraper-default"><span>+<?php echo $carisma ?></span> Persuasion <span>(Car)</span></div>
                        <div class="wraper-default"><span>+<?php echo $inteligencia ?></span> Religion <span>(Int)</span></div>
                        <div class="wraper-default"><span>+<?php echo $destreza ?></span> Sigilo <span>(Des)</span></div>
                        <div class="wraper-default"><span>+<?php echo $sabiduria ?></span> Supervivencia <span>(Sab)</span></div>
                        <div class="wraper-default"><span>+<?php echo $sabiduria ?></span> Trato con Animales <span>(Sab)</span></div>
                </div>
            </div>
            <div>
                <div class="wraper-default flex">
                    <div class="wraper-default text-center">
                        <p>Vida</p>
                        <p><?php echo $dado ?></p>
                    </div>
                    <div class="wraper-default text-center">
                        <p>Dado de Golpe</p>
                        <p>1d<?php echo $dado ?></p>
                    </div>
                </div>
                <div class="wraper-default text-center">
                    <p>Equipamiento</p>
                    <div>
                        <div><span>Arma: </span><?php echo $arma ?></div>
                        <div><span>Armadura: </span><?php echo $armadura ?></div>
                        <div><span>Objeto: </span><?php echo $objeto ?></div>
                    </div>

                </div>
                <div class="wraper-default">
                    <p>Idiomas</p>
                    <div>
                        <?php
                        
                            foreach(explode(",",$idiomas) as $idioma){
                                ?>

                                    <div><?php echo $idioma ?></div>

                                <?php
                            }

                        ?>
                    </div>
                </div>
            </div>

        </div>

            
    </div>

    <a class="wraper-default" href="prueba.php?NombrePersonaje=<?php echo $nombre ?>">Convertir a PDF</a>


    </body>
</html>

