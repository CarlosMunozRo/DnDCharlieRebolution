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
		      	$query = $pdo->prepare("select Nombre,Clase,Raza from Personajes");
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
		      		echo"<div class='carta'>
		      				<div class='img'>
		      					<img src='/Media/Imagenes/".$ficha["Raza"].".jpeg'/>
		      				</div>
		      				<div class='info'>
		      					<h3>Nombre:</h2>
		      					<p>".$ficha["Nombre"]."</p>
		      					<h3>Clase:</h2>
		      					<p>".$ficha["Clase"]."</p>
		      					<h3>Raza:</h2>
		      					<p>".$ficha["Raza"]."</p>
		      				</div>
		      			</div>";
		      	}
		      	//eliminem els objectes per alliberar memòria 
		      	unset($pdo); 
		      	unset($query);
		    ?>
		</div>
	</section>
</body>
</html>