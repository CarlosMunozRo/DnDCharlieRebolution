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
        

        $nombre=$_GET["sh_name"];
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
    <script src="./Scripts/jquery.min.js"></script>
	<script src="Scripts/subir-imagen.js"></script>
</head>
<body class="ficha">
	<div class="Contenedor-hilo_ariadna">
        <a href="login-dashboard.php"><h2 class="hilo_ariadna">Dashboard</h2></a>
        <h2 class="hilo_ariadna">/</h2>
        <a href="listar-ficha.php"><h2 class="hilo_ariadna">Listar Ficha</h2></a>
        <h2 class="hilo_ariadna">/</h2>
        <a ></a><h2 class="hilo_ariadna">Ficha</h2></a>
    </div>



    <section class="sec_ficha">
        <div class="header_ficha flex space-between">
            <div>
                <div class="laFoto img">
                    <?php
                        if (!empty($ficha["Imagen"])){ 
                            echo "<img src='./Media/Uploads/".$ficha["Imagen"]."'/>";
                        
                        }else {
                            echo "<img src='/Media/Imagenes/".$ficha["Raza"].".jpeg'/>";
                        };
                    ?>
                </div>
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

    </section>


    <!--
    <section class="centrar-contenido">
        <div class="Contenedor" style="border: 4px solid red;">
        	<div class="header">
        		<div class="Posicionar-Izquierda">
        			<div class="Contenedor-IMG">
        				<img class="IMG_ficha-imagen" src="./Media/Imagenes/DnDLogoHome.png">
        			</div>
        			<div class="Nombre-Personaje">
        				<h3>Bob el Ñapetas</h1>
        				<p>Nombre del Personaje</p>
        			</div>
        		
                </div>
                <div class="laFoto img">
                            <?php
                                /*
                                if (!empty($ficha["Imagen"])){ 
                                    echo "<img  src='./Media/Uploads/Semielfo.jpeg'/>";
                                }else {
                                    echo "<img  src='/Media/Imagenes/Semielfo.jpeg'/>";

                                };
                                */
                            ?>
                        </div>	
                
        		<div class="Posicionar-Derecha">
                <div class="Info">
                        
                        <div class="Datos">
                            <p>Picaro Lvl 1</p>
                            <p>Circense</p>
                            <p>Dr Sordido</p>
                        </div>
                        <div class="Datos">
                            <p>Clase y nivel</p>
                            <p>Trasfondo</p>
                            <p>Nombre del jugador</p>
                        </div>
        			</div>
                    <div class="Info">
                        <div class="Datos">
                            <p>Semielfo</p>
                            <p>Catolico Maligno</p>
                            <p>0</p>
                        </div>
                        <div class="Datos">
                            <p>Raza</p>
                            <p>Alineamiento</p>
                            <p>Puntos de experiencia</p>
                        </div>
                    </div>
        		</div>
        	</div>
            <div class="flex">
                <div class="flex posicionar">
                    <div class="Contenedor-habilidades wraper-default f-grow">
                        <div class="Decoracion wraper-default">
                            <p>Fuerza</p>
                            <p>+0</p>
                            <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                        <div class="Decoracion wraper-default">
                            <p>Destreza</p>
                            <p>+0</p>
                             <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                        <div class="Decoracion wraper-default">
                            <p>Constitucion</p>
                            <p>+0</p>
                             <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                        <div class="Decoracion wraper-default">
                            <p>Inteligencia</p>
                            <p>+0</p>
                             <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                        <div class="Decoracion wraper-default">
                            <p>Sabiduria</p>
                            <p>+0</p>
                             <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                        <div class="Decoracion wraper-default">
                            <p>Carisma</p>
                            <p>+0</p>
                             <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                    </div>
                    <div class="Contenedor-salvacion f-grow">
                        <div class="wraper-default">
                            <p>Inspiracion</p>
                        </div>
                        <div class="wraper-default">
                            <p>Bonificador de competencia</p>
                        </div>
                        <div class="wraper-default">
                            <p>Tiradas de salvacion</p>
                        </div>
                        <div class="wraper-default">
                            <div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Acrobacias<span> (Dex)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Animal Handling<span> (Wis)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Arcana<span> (Int)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Athletics</div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Deception<span> (Cha)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>History<span> (Int)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Insight<span> (Wis)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Intimidation<span> (Cha)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Investigation<span> (Int)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Medicine<span> (Wis)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Nature<span> (Int)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Percception<span> (Wis)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Performance<span> (Cha)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Persuasion<span> (Cha)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Religion<span> (Int)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Sleight of Hand<span> (Dex)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Stealth<span> (Dex)</span></div>
                                </div>
                                <div class="flex column habilidades">
                                    <div>+5</div>
                                    <div>Survival<span> (Wis)</span></div>
                                </div>
                            </div>
                            <p>Habilidades</p>
                        </div>
                    </div>
                </div>
                <div class="f-grow">
                    <div>
                        <div class="flex space-between">
                            <div class="wraper-default">
                                <p class="text-center">14</p>
                                <p>Clase de arm</p>
                            </div>
                            <div class="wraper-default">
                                <p class="text-center">13</p>
                                <p>Iniciativa</p>
                            </div>
                            <div class="wraper-default">
                                <p class="text-center">30'</p>
                                <p>Velocidad</p>
                            </div>
                        </div>
                        <div class="wraper-default">
                            <div class="flex">
                                <p>Puntos de golpeo maximos</p>
                                <p>10</p>
                            </div>
                            <p class="text-center">10</p>
                            <p class="text-center">Puntos de golpe actuales</p>
                        </div>
                        <div class="wraper-pts-totales wraper-default" >
                            <div>
                                <p class="text-center">Puntos de golpe temporales</p>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="wraper-default">
                                <div class="flex">
                                    <p>total</p>
                                    <p class="bold">1d8</p>
                                </div>
                                <p class="text-center bold">d8</p>
                                <p class="text-center">Dado de golpe</p>
                            </div>
                            <div class="wraper-default">
                                <p>Exitos</p>
                                <p>Fallos</p>
                                <p>Salvaciones de muerte</p>
                            </div>
                        </div>
                    </div>
                    <div class="wraper-default">
                        <div class="flex">
                            <p>Nombre</p>
                            <p>Bonf. ataque</p>
                            <p>Daño/Tipo</p>
                        </div>
                        <div class="flex">
                            <p>Estoque</p>
                            <p>+5</p>
                            <div class="flex">
                                <p>1d8 + 3</p>
                                <div>
                                    <p>PERFORANTE</p>
                                    <P>SUTIL</p>
                                </div>
                            </div>
                        </div>
                        <p>Ataques y Conjuros</p>
                    </div>
                </div>
                <div class="Container-rasgos f-grow">
                <div class="wraper-default">
                    <p>Rasgos De Personalidad</p>
                </div>
                <div class="wraper-default">
                    <p>Ideales</p>
                </div>
                <div class="wraper-default">
                    <p>Vinculos</p>
                </div>
                <div class="wraper-default">
                    <p>Defectos</p>
                </div>
                <div class="wraper-default">
                    <div>
                        <p>Vision en la oscuridad</p>
                        <p>Ancestro federico</p>
                        <p>Pericia</p>
                        <p>Ataque furioso</p>
                    </div>
                    <p>Rasgos y Atributos</p>
                </div>
            </div>
            </div>
            <div class="flex Container-equipo">
                <div>
                    <div class="wraper-default">
                        <p>Sabiduria Passiva</p>
                    </div>
                    <div  class="wraper-default">
                        <div>
                            <p>Armaduras:</p>
                            <p>Armas:</p>
                            <p>Herramientas:</p>
                        </div>
                        <div>
                            <p>Comun</p>
                            <p>Elfico</p>
                            <p>Gnomo</p>
                        </div>
                        <p>Otras competencias E Idiomas</p>
                    </div>
                </div>
                <div class="wraper-default">
                    <div>
                        <p>Herramientas</p>
                        <p>Espada</p>
                        <p>Escudo</p>
                    </div>
                    <p>Equipo</p>
                </div>

            </div>
        </div>
    </section>
    -->























</body>
</html>
