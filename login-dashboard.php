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
    <div class="Contenedor-hilo_ariadna">
        <a href="login-dashboard.php"><h2 class="hilo_ariadna">Dashboard</h2></a>
    </div>
    <section id="" class="centrar-contenido"> 
        <nav class="centrar-contenido flex-column flex-space-around">
        <a href="/crear-ficha.php" accesskey="c"><button class="BTN_NoA_ST1_Grande">Crear Ficha</button></a>
        <a href="/listar-ficha.php" accesskey="l"><button class="BTN_NoA_ST1_Grande">Listar Fichas</button></a>
        <a href="/probar-ficha.php" accesskey="p"><button class="BTN_NoA_ST1_Grande">Probar Ficha</button></a>
        </nav>
    </section>
    <?php include "Templates/footer.php"?>

    <!--boton crear ficha-->
    <!-- boton mirar tus fichas -->
    <!-- boton probar ficha -->
</body>
</html>