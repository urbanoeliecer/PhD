<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "inclusive/";
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../loginform.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Inclusive</title>
        <link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
        <link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
        <script  src="../sistema/estilos/js/bootstrap.min.js"></script>
    </head>
    <body>
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
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="col-lg-offset-3 col-lg-6">
                <?php
                $tabla = "t_animales";
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                    echo '<br/><br/><h1 style="text-align: center">Editar Animal</h1>';
                    generarTablaEditar($tabla, $id, $_SESSION['idorg']);
                } else {
                    echo '<br/><br/><h1 style="text-align: center">Agregar Animal</h1>';
                    generarTablaAgregar($tabla, NULL, $_SESSION['idorg'],@$_GET['FechaNacimiento']);//170602
                }
                ?>
            </div>
        </div>
    </body>
</html>
