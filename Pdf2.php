
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


    $select = $pdo->prepare("select Personajes.* ,Clases.DG from Personajes inner join Clases on Personajes.Clase=Clases.NombreClase where nombre ='".$_GET["NombrePersonaje"]."';");
    $select->execute();

    $row = $select->fetchAll();

    

    foreach($row as $ficha){


            $nombre=$_GET["NombrePersonaje"];

            
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


    <div class="sec_ficha">
        <div class="header_ficha flex space-between">
            <div>


                <div class="text-center titulo3">
                    Nomre: <?php echo $nombre ?>
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
