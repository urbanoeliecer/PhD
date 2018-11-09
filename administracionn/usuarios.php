<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "inclusive/";
$SystemFolder = $AppName."sistema";  
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../IniciarSesion.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Inclusive - Usuarios</title>
    <link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
    <link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
    <script src="../sistema/estilos/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Inclusive</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php
                    echo Menu($_SESSION["IdPerfil"]);
                    ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    echo MenuUsuario();
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
        <br/><br/><h1 style="text-align: center">Usuarios</h1>
        <div class="col-lg-offset-1 col-lg-10">
            <?php
            DibujarTabla("t_usuarios", $_SESSION['idorg'],'');
            if ($_SESSION['IdPerfil'] != 3) {
                $page = basename($_SERVER['PHP_SELF'], ".php");
                echo generarAgregar($page);
            }
            ?>
        </div>
    </div>
</body>
</html>