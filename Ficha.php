<?php if($_GET['exportPDF']!=1): ?><!DOCTYPE html>
    <html>
    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="styles.css">
    	<title>Ficha</title>
    </head>
<body class="ficha">        
	<div class="Contenedor-hilo_ariadna">
        <a href="login-dashboard.php"><h2 class="hilo_ariadna">Dashboard</h2></a>
        <h2 class="hilo_ariadna">/</h2>
        <a href="login-dashboard.php"><h2 class="hilo_ariadna">Listar Ficha</h2></a>
        <h2 class="hilo_ariadna">/</h2>
        <a href="Ficha.php"><h2 class="hilo_ariadna">Ficha</h2></a>
    </div>
<?php endif; ?>


<?php if($_GET['exportPDF']==1): 
    // eliminamos las variables de css -- ;
    $cadena = '<style>'.file_get_contents(dirname(__FILE__).'/styles.css').'</style>';
    $patrón = '/--(.*)/i';
    $sustitución = '';
    $cadena2 = preg_replace($patrón, $sustitución, $cadena);

    // empalmamos la 2n substitucion
    $patrón2 = '/var\((.*)\)/i';
    $sustitución2 = 'AAAA';
    $cadena2 = preg_replace($patrón2, $sustitución2, $cadena2);

echo str_replace('var(', ';', $cadena2);
    //echo '<style>'.file_get_contents(dirname(__FILE__).'/styles.css').'</style>'; ?>

<?php endif; ?>

    <div class="centrar-contenido">
        <div class="Contenedor" style="width:725px;border: 4px solid red;">

        	<div class="header">
        		<div class="Posicionar-Izquierda">
        			<div class="Contenedor-IMG">
        				<img class="IMG_ficha-imagen" src="./Media/Imagenes/DnDLogoHome.png" <?php if($_GET['exportPDF']==1): ?>style="max-width: 100%; <?php endif; ?>">
        			</div>
        			<div class="Nombre-Personaje">
        				<h1>Bob el Ñapetas</h1>
        				<p>Nombre del Personaje</p>
        			</div>
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
                    <div class="Contenedor-habilidades">
                        <div class="Decoracion">
                            <p>Fuerza</p>
                            <p>+0</p>
                            <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                        <div class="Decoracion">
                            <p>Destreza</p>
                            <p>+0</p>
                             <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                        <div class="Decoracion">
                            <p>Constitucion</p>
                            <p>+0</p>
                             <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                        <div class="Decoracion">
                            <p>Inteligencia</p>
                            <p>+0</p>
                             <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                        <div class="Decoracion">
                            <p>Sabiduria</p>
                            <p>+0</p>
                             <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                        <div class="Decoracion">
                            <p>Carisma</p>
                            <p>+0</p>
                             <div class="redonda">
                                <p>10</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p>Inspiracion</p>
                        </div>
                        <div>
                            <p>Bonificador de competencia</p>
                        </div>
                        <div>
                            <p>Tiradas de salvacion</p>
                        </div>
                        <div>
                            <p></p>
                            <p>Habilidades</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <div class="flex">
                            <div>
                                <p>14</p>
                                <p>Clase de arm</p>
                            </div>
                            <div>
                                <p>13</p>
                                <p>Iniciativa</p>
                            </div>
                            <div>
                                <p>30'</p>
                                <p>Velocidad</p>
                            </div>
                        </div>
                        <div>
                            <div class="flex">
                                <p>Puntos de golpeo maximos</p>
                                <p>10</p>
                            </div>
                            <p>10</p>
                            <p>Puntos de golpe actuales</p>
                        </div>
                        <div>
                            <div>
                                <p>Puntos de golpe temporales</p>
                            </div>
                        </div>
                        <div>
                            <div>
                                <div class="flex">
                                    <p>total</p>
                                    <p>1d8</p>
                                </div>
                                <p>d8</p>
                                <p>Dado de golpe</p>
                            </div>
                            <div>
                                <p>Exitos</p>
                                <p>Fallos</p>
                                <p>Salvaciones de muerte</p>
                            </div>
                        </div>
                    </div>
                    <div>
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
                <div>
                <div>
                    <p>Rasgos De Personalidad</p>
                </div>
                <div>
                    <p>Ideales</p>
                </div>
                <div>
                    <p>Vinculos</p>
                </div>
                <div>
                    <p>Defectos</p>
                </div>
            </div>
            </div>
            <div class="flex">
                <div>
                    <div>
                        <p>Sabiduria Passiva</p>
                    </div>
                    <div>
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
                <div>
                    <div>
                        <p>Herramientas</p>
                        <p>Espada</p>
                        <p>Escudo</p>
                    </div>
                    <p>Equipo</p>
                </div>
                <div>
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
    </div>

<?php if($_GET['exportPDF']!=1): ?>
    </body>
    </html>
<?php endif; ?>