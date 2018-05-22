<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
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
        <title>SAMII-DSS</title>
        <link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
        <link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../sistema/estilos/js/bootstrap.min.js"/></script>
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <!--<img src = "../images/appisSin.png" width="63">
                    <a href="Manual.php?id=5" target="_blank"><img src = "../images/descarga.png" width="33"></a>
                    --><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">SAMII-DSS</a>
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
        <table width="98%" align="center">
            <tr><td align="center"><?php
            //170527 Fincas, Lotes, Terceros, Animales, Novedades
            $sql = "select count(idfinca) from t_fincas where estado = 1 and idorg =  ".$_SESSION['idorg'];
            $rrr = consultaSQL($sql, $_SESSION['idorg']); $f = mysqli_fetch_array($rrr); $fnc = $f[0];
            $sql = "select count(idlote) from t_lotes where estado = 1 and idorg =  ".$_SESSION['idorg'];
            $rrr = consultaSQL($sql, $_SESSION['idorg']); $f = mysqli_fetch_array($rrr); $lot = $f[0];
            $sql = "select count(idtercero) from t_terceros where estado = 1 and idorg =  ".$_SESSION['idorg'];
            $rrr = consultaSQL($sql, $_SESSION['idorg']); $f = mysqli_fetch_array($rrr); $trc = $f[0];
            $sql = "select count(idanimal) from t_animales where estado = 1 and idorg =  ".$_SESSION['idorg'];
            $rrr = consultaSQL($sql, $_SESSION['idorg']); $f = mysqli_fetch_array($rrr); $anm = $f[0];   
            $sql = "select count(idmovimiento) from t_movimientos where estado = 1 and idorg =  ".$_SESSION['idorg'];
            $rrr = consultaSQL($sql, $_SESSION['idorg']); $f = mysqli_fetch_array($rrr); $nvd = $f[0];               
            echo 'Fincas: '.$fnc.' - Lotes: '.$lot.' - Terceros: '.$trc.' - Animales: '.$anm.' - Novedades: '.$nvd;
            echo '&nbsp;&nbsp;<font color="red">';
            if ($fnc == 0) echo 'Para iniciar el registro de animales debe agregar alguna finca';
            else
                if ($lot == 0) echo 'Para iniciar el registro de animales debe agregar algún Lote de Produccion';
                else
                if ($trc == 0) echo 'Para iniciar el registro de animales debe agregar algún Tercero';
                else 
                    if ($anm == 0) echo 'Para iniciar el registro Novedades o Eventos debe agregar algún Animal';
                    else
                        if ($nvd == 0) echo 'Puede iniciar el registro de Novedades o Eventos de los Animales';
             echo '</font>';
            ?>            
            <tr>
            <td align="center"><h1 style="text-align: center">Animales</h1>
            <tr></td><td
                <?php
                // 150617
                if (!isset($_SESSION['UltimoIn'])) {
                    echo '<div align="center"><font color="red"><b>Ya existe ese número</b><br><br></font></div>'; 
                    $_SESSION['UltimoIn'] = 1;
                 }
                if ($_SESSION['IdPerfil'] != 2) {
                    $page = basename($_SERVER['PHP_SELF'], ".php");
                    echo generarAgregar($page);
                }
                ?>
            </td></tr>
            <tr>
            </table>
            <?php 
            DibujarTabla("t_animales", $_SESSION['idorg'],'');
            ?>
        
    </body>
</html>
<!--
<td></td></td><td>&nbsp;
<td width="40%" align="center">Tareas Pendientes</td></td><td>&nbsp;</td>
            <td valign="top"><?php DibujarTabla("tareaspendientes", $_SESSION['idorg'],''); ?>
            <td>&nbsp;</td>
-->