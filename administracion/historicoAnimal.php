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
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <!--<img src = "../images/appisSin.png" width="63">--><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
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
        <div class="container">
            <br/><br/><h1 style="text-align: center">Resumen - <?php nombreAnimal($_SESSION['IdAnimal'], $_SESSION['idorg']) ?></h1>
            <div class="col-lg-offset-1 col-lg-10">
                <?php
                echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered" style="font-size:12px">';

                //170614 Mostrar mas datos del animal
                $link = conectar();
                mysqli_query($link,"SET NAMES 'UTF8'");
                $SQL = "select a.numero from t_animalesgen g, t_animales a where g.idanimalpadre = a.idanimal and g.idanimal = ".$_SESSION['IdAnimal'];
                $result = mysqli_query($link, $SQL);
                $cadGnlDtl = '';
                while ($f = mysqli_fetch_array($result)) {
                    $cadGnlDtl .= '<td align="center">'.$f[0];
                }
                $SQL = "select a.numero from t_animalesgen g, t_animales a where g.idanimalmadre = a.idanimal and g.idanimal = ".$_SESSION['IdAnimal'];
                $result = mysqli_query($link, $SQL);
                while ($f = mysqli_fetch_array($result)) {
                    $cadGnlDtl .= '<td align="center">'.$f[0];
                }
                $SQL = "select t.tercero, fecha from t_movimientos m, t_terceros t where t.idtercero = m.idtercero and m.idtipomovimiento = 4 and m.idanimal = ".$_SESSION['IdAnimal'];
                $result = mysqli_query($link, $SQL);
                while ($f = mysqli_fetch_array($result)) {
                    $cadCmpDtl = '<td align="center">'.$f[0].'<td align="center">'.$f[1];
                }
                $SQL = "Select TipoAnimal, Raza, Numero, Nombre, FechaNacimiento, FechaRegistro, NumPartos from v_animales WHERE  IdAnimal = ".$_SESSION['IdAnimal'];
                $DatosTabla = consultaSQL($SQL);
                $NroCampos = mysqli_num_fields($DatosTabla);
                generarEncabezadoTabla($DatosTabla, $NroCampos, '');
                $cadGnl = '<th align="center">Padre<th align="center">Madre';
                $cadCmp = '<th align="center">Tercero<th align="center">Fecha';
                if (@$cadGnlDtl != '') echo $cadGnl;
                if (@$cadCmpDtl != '') echo $cadCmp;
                // Ahora si busca los datos
                $result = mysqli_query($link, $SQL);
                echo '<tr>';
                while ($f = mysqli_fetch_array($result)) {
                    for ($kk = 0; $kk < 7; $kk++) {
                         echo '<td align="center">';
                         if (($f[$kk] == '0') || ($f[$kk] == '0000-00-00')) echo '';
                         else echo $f[$kk];
                    }
                }
                // Imprime el resto de los hallazgos
                echo @$cadGnlDtl.@$cadCmpDtl;
                echo '<tr>';
                echo '</table></div>';
                DibujarTablaHistorico($_SESSION['IdAnimal'], $_SESSION['idorg']);
                ?>
            </div>
        </div> <!-- /container -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../sistema/estilos/js/bootstrap.min.js"></script>
    </body>
</html>