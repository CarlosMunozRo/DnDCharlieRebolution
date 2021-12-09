<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <script src="./Scripts/jquery.min.js" ></script>
    <script src="./Scripts/home.js"></script>
    <script src="Scripts/login-dashboard.js"></script>
</head>
<body class="Nueva-Cuenta">
	<?php include "Templates/header.php"?>
	<div class="DIV_Nueva-Cuenta centrar-contenido">
		<form action="" method="POST">
			<div class="DIV_Nueva-Cuenta-Formulario">
				<div>
					<h1 class="blanco">Crear cuenta</h1>
				</div>
				<div>
					<div class="centrar-contenido flex-column">
						<label for="usuario">Nombre:</label>
						<input type="text" name="usuario" id="usuario" required>
					</div>
					<div class="centrar-contenido flex-column">
						<label for="fecha">Fecha de nacimiento:</label>
						<input type="date" name="fecha" id="fecha" required>
					</div>
					<div class="centrar-contenido flex-column">
						<label for="email">Email:</label>
						<input type="text" name="email" id="email" required>
					</div>
					<div class="centrar-contenido flex-column">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>     	
          </div>
          <div class="centrar-contenido flex-column">
            <label for="password1">Contraseña:</label>
            <input type="password" name="password1" id="password1" required>       
          </div>
					<div class="centrar-contenido flex-column">
						<input type="submit" value="Crear Cuenta">
					</div>
				</div>
			</div>
		</form>
	</div>
   <?php
        if(!isset($_POST["usuario"])){
            die();
        }
      //connexió dins block try-catch:
      //  prova d'executar el contingut del try
      //  si falla executa el catch
      try {
        $hostname = "localhost";
        $dbname = "DungeonsAndDragons";
        $username = "manolo";
        $pw = "manolo123";
        $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
      } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
      }
      //preparem i executem la consulta
      $query = $pdo->prepare("select * FROM Usuarios where NombreUsuario= :user");
      $query->bindParam(':user', $_POST["usuario"]);
      $query->execute();      
        //comprovo errors:
      $e= $query->errorInfo();
      if ($e[0]!='00000') {
        echo "\nPDO::errorInfo():\n";
        die("Error accedint a dades: " . $e[2]);
      }  
      //anem agafant les fileres d'amb una amb una
      $row = $query->fetch();
      if($row){
        ?>
          <div class="DIV_ERR_Message"><p>El nombre de usuario ya existe.</p><div><span>X</span></div></div>
        <?php 
      }else{
        if (strcmp($_POST['password'], $_POST['password1']) === 0){
          $encriptedPwd = hash("sha256", $_POST["password"]);
          //preparem i executem la consulta
          $query = $pdo->prepare("insert into Usuarios(UsuarioID,NombreUsuario,FechaNacimiento,Password,Email)
          Values(null,:user,:fecha,:password,:email)");
          $query->bindParam(':user', $_POST["usuario"]);
          $query->bindParam(':password', $encriptedPwd);
          $query->bindParam(':fecha', $_POST['fecha']);
          $query->bindParam(':email', $_POST['email']);
          $query->execute();
          header("Location: home.php");
        }else{
          ?>
            <div class="DIV_ERR_Message"><p>Las contraseñas no coinciden.</p><div><span>X</span></div></div>
          <?php 
        }
      }
      //eliminem els objectes per alliberar memòria 
      unset($pdo); 
      unset($query);
    ?>
</body>
</html>