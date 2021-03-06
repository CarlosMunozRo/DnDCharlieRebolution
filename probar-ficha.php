<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Listar Ficha</title>
	<link rel="stylesheet" href="styles.css">
    <script src="./Scripts/jquery.min.js" ></script>
    <script src="Scripts/login-dashboard.js"></script>
</head>
<body class="listar-ficha">
	<?php include "Templates/header.php"?>
	<div class="Contenedor-hilo_ariadna">
		<a href="login-dashboard.php"><h2 class="hilo_ariadna">Dashboard</h2></a>
		<h2 class="hilo_ariadna">/</h2>
		<a href="login-dashboard.php"><h2 class="hilo_ariadna">Listar Ficha</h2></a>
	</div>
		<section class="centrar-contenido">
		<div class="tablero">
			<?php
				//connexió dins block try-catch:
		      	//  prova d'executar el contingut del try
		      	//  si falla executa el catch
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




		      	//preparem i executem la consulta
		      	$query = $pdo->prepare('select Personajes.PersonajeID, Personajes.Nombre,Personajes.Clase,Personajes.Raza,Personajes.Imagen from Usuarios_Personajes
				  inner join Personajes on Usuarios_Personajes.PersonajeID=Personajes.PersonajeID
				  inner join Usuarios on Usuarios_Personajes.UsuarioID =Usuarios.UsuarioID
				  where Usuarios.NombreUsuario="'.$_SESSION["Usuario"].'";');
		      	$query->execute();      

		        //comprovo errors:
		      	$e= $query->errorInfo();
		      	if ($e[0]!='00000') {
		        	echo "\nPDO::errorInfo():\n";
		        	die("Error accedint a dades: " . $e[2]);
		      	}  
		      	//anem agafant les fileres d'amb una amb una
		      	$row = $query->fetchAll();

				

		      	foreach ($row as $ficha) {

					$imagen;
					if (!empty($ficha["Imagen"])){ 
						$imagen=$ficha["Imagen"];					
					}else {
						$imagen=$ficha["Raza"].".jpeg";
					};

		      		echo"<div class='contenedor'>
		      				<div class='carta'>
		      					<div class='img'>";
								if (!empty($ficha["Imagen"])){ 
									echo "<img src='./Media/Uploads/".$ficha["Imagen"]."'/>";
								
								}else {
									echo "<img src='/Media/Imagenes/".$ficha["Raza"].".jpeg'/>";
			
								};
		      					echo "</div>
		      					<div class='info'>
		      						<h3>Nombre:</h2>
		      						<p>".$ficha["Nombre"]."</p>
		      						<h3>Clase:</h2>
		      						<p>".$ficha["Clase"]."</p>
		      						<h3>Raza:</h2>
		      						<p>".$ficha["Raza"]."</p>
		      					</div>
		      				</div>
		      				<div class='posicionar-Botones'>
                                <button class='visualizar'><a href='combate.php?IDPersonaje=".$ficha["PersonajeID"]."'>Seleccionar</a></button>
		      				</div>
		      			</div>";
		      	}
		      	//eliminem els objectes per alliberar memòria 
		      	unset($pdo); 
		      	unset($query);
		    ?>
		</div>
	</section>
	<script type="text/javascript">
		$('.borrar').attr('disabled','disabled');
	</script>

<?php include "Templates/footer.php"?>
</body>
</html>