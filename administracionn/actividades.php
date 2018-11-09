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
    <title>Inclusive</title>
    <link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
    <link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
    <script src="../sistema/estilos/js/bootstrap.min.js"/></script>
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
    <table width="98%" align="center">
        <tr>
        <td align="center"><h1 style="text-align: center">Actividades</h1>
        <tr></td><td
            <?php
            // 150617
            /*
            if (!isset($_SESSION['UltimoIn'])) {
                echo '<div align="center"><font color="red"><b>Ya existe ese número</b><br><br></font></div>'; 
                $_SESSION['UltimoIn'] = 1;
             }
            if ($_SESSION['IdPerfil'] != 2) {
                $page = basename($_SERVER['PHP_SELF'], ".php");
                echo generarAgregar($page);
            }*/
            ?>
        </td></tr>
        <tr>
        </table>
        <?php 
        DibujarTabla("preguntas", $_SESSION['idorg'],'');
        ?>
</body>
</html>