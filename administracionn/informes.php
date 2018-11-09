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
$xx = @$_GET["organ"];
if ($xx != '') {
    $sql = "update t_organizaciones set estado = 0 where idorg = ".$xx;
    consultaSQL($sql);
}
// asiga a un jugador los datos de una partida
$prt = @$_POST["txtPrt"];
$usr = @$_POST["txtUsr"];
$ttr = @$_POST["txtTtr"];
if ($prt != '' && $usr != '' && $ttr != '')
{
	$ssql = "update t_organizaciones set idusuario = ".$usr.", usrTtr = ".$ttr." where orgNmb = '".$prt."'";
	include("conect_app.php");
	$link = ConectarseExt();
	$p = mysqli_query($link,$ssql);
	print '<br><div align="center">'.$p.' - Guardado</div>';
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
            <h1 style="text-align: center">Resumen de Usabilidad</h1>
            <div class="col-lg-offset-1 col-lg-10">
            <?php
            echo '<div class="table-responsive">';
            echo '<table class="table table-striped table-hover table-bordered">';
            $p = consultaSQL("select * from t_organizaciones where estado = 1 and idorg < 99 order by idorg ");
            echo '<tr><td><td align="center">IdOrg<td align="center">Organización<td align="center">Animales<td align="center">Movimientos<td align="center" colspan="2">Usuarios';
            //$nmrcampos = mysqli_num_fields($p);
            while ($f = mysqli_fetch_array($p)) {
                $sql3 = "select count(*) from t_usuarios where idorg = ".$f[0];
                $q = consultaSQL($sql3); while ($fila = mysqli_fetch_row($q)) $cntUsr = $fila[0]; 
                echo '<tr><td><a href="infResumen.php?organ='.$f[0].'">Inactivar</a></td>';
                echo '<td align="center">'.$f[0].'</td>';
                echo '<td align="center">'.$f[1].'</td>';
                $sql1 = "select count(*) from t_animales where idorg = ".$f[0];
                $sql2 = "select count(*) from t_movimientos where idorg = ".$f[0];
                $q = consultaSQL($sql1); while ($fila = mysqli_fetch_row($q)) echo '<td align="center">'.$fila[0]; 
                $q = consultaSQL($sql2); while ($fila = mysqli_fetch_row($q)) echo '<td align="center">'.$fila[0]; 
                $sql4 = "select usuario, email from t_usuarios where idorg = ".$f[0];
                $k = consultaSQL($sql4); 
                $i=0;$cadUsu = '';//<table>'; 
                while ($fila = mysqli_fetch_array($k)) { 
                    if ($i > 0) echo '<tr><td colspan="5">'; 
                    echo'<td align="center">'.$fila[0];
                    //echo '<td>'.$fila[1];
                    $i++;
                }
                echo '</tr>';
            }
            echo '</table>';
            // Tabla 2 para la jugadas
            echo '<table class="table table-striped table-hover table-bordered">';
            $sql = "select o.* from t_organizaciones  where estado = 1 and idorg > 99 and idusuario <> '1' and fechaReg > '2018-08-29 00:00:00' order by idorg desc";
            print $sql = "select distinct(p.idorg),o.*,p.tiempo as tmp, max(p.dinero) as dnr from partidaestdnr p, t_organizaciones o where estado = 1 and idorg > 99 and idusuario <> '1' and fechaReg > '2018-08-29 00:00:00' and o.idorg = p.idorg group by p.tiempo, p.idorg order by idorg desc";
            //"select distinct(p.idorg), o.orgnmb, o.idusuario, p.tiempo as tmp, max(p.dinero) as dnr from partidaestdnr p, t_organizaciones o where MOD(p.tiempo,6)= 0 and p.dinero > 0 and o.idorg = p.idorg group by p.tiempo, p.idorg order by tmp desc,dnr desc"
            $p = consultaSQL($sql);
            echo '<tr><td><td align="center">IdOrg<td align="center">Organización<td align="center">Fecha<td align="center">Codigo<td align="center">Jugador<td align="center">Animales<td align="center">Movimientos<td align="center" colspan="2">Usuarios';
            //$nmrcampos = mysqli_num_fields($p);
            while ($f = mysqli_fetch_array($p)) {
                $sql3 = "select count(*) from t_usuarios where idorg = ".$f[0];
                $q = consultaSQL($sql3); while ($fila = mysqli_fetch_row($q)) $cntUsr = $fila[0]; 
                echo '<tr><td><a href="infResumen.php?organ='.$f[0].'">Inactivar</a>';
                echo '<td align="center">'.$f[1].'</td>';
                echo '<td align="center">'.$f[2].'</td>';
                echo '<td align="center">'.$f[4].'</td>';
                echo '<td align="center">'.$f[6].'</td>';
                echo '<td align="center">'.$f[7].'</td>';
                $sql1 = "select count(*) from t_animales where idorg = ".$f[0];
                $sql2 = "select count(*) from t_movimientos where idorg = ".$f[0];
                $q = consultaSQL($sql1); while ($fila = mysqli_fetch_row($q)) echo '<td align="center">'.$fila[0]; 
                $q = consultaSQL($sql2); while ($fila = mysqli_fetch_row($q)) echo '<td align="center">'.$fila[0]; 
                $sql4 = "select usuario, email from t_usuarios where idorg = ".$f[0];
                $k = consultaSQL($sql4); 
                $i=0;$cadUsu = '';//<table>'; 
                while ($fila = mysqli_fetch_array($k)) { 
                    if ($i>0) echo '<tr><td colspan="5">'; 
                    echo'<td align="center">'.$fila[0];
                    //echo '<td>'.$fila[1];
                    $i++;
                }
                echo '</tr>';
            }
	    // Tabla adicional para la jugadas
            $p = consultaSQL("select * from t_organizaciones where estado = 1 and idorg > 99 and usuario <> '' and idusuario = '1' and fechaReg > '2018-08-29 00:00:00' order by idorg desc");
            //$nmrcampos = mysqli_num_fields($p);
            while ($f = mysqli_fetch_array($p)) {
                $sql3 = "select count(*) from t_usuarios where idorg = ".$f[0];
                $q = consultaSQL($sql3); while ($fila = mysqli_fetch_row($q)) $cntUsr = $fila[0]; 
                echo '<tr><td><a href="infResumen.php?organ='.$f[0].'">Inactivar</a></td>';

                echo '<td align="center">'.$f[0].'</td>';
                echo '<td align="center">'.$f[1].'</td>';
                echo '<td align="center">'.$f[3].'</td>';
				echo '<td align="center">'.$f[5].'</td>';
				echo '<td align="center">'.$f[6].'</td>';
				$sql1 = "select count(*) from t_animales where idorg = ".$f[0];
                $sql2 = "select count(*) from t_movimientos where idorg = ".$f[0];
                $q = consultaSQL($sql1); while ($fila = mysqli_fetch_row($q)) echo '<td align="center">'.$fila[0]; 
                $q = consultaSQL($sql2); while ($fila = mysqli_fetch_row($q)) echo '<td align="center">'.$fila[0]; 
                $sql4 = "select usuario, email from t_usuarios where idorg = ".$f[0];
                $k = consultaSQL($sql4); 
                $i=0;$cadUsu = '';//<table>'; 
                while ($fila = mysqli_fetch_array($k)) { 
                    if ($i>0) echo '<tr><td colspan="5">'; 
                    echo'<td align="center">'.$fila[0];
                    //echo '<td>'.$fila[1];
                    $i++;
                }
                echo '</tr>';
            }
			// fin tabla 2			
            echo '</table>';
			// fin tabla 2

			// Tabla 3 para la jugadas
			echo '<table class="table table-striped table-hover table-bordered">';
            $p = consultaSQL("select * from t_organizaciones where estado = 1 and idorg > 99 and idusuario = '1' and fechaReg > '2018-08-29 00:00:00' order by idorg desc ");
            echo '<tr><td><td align="center">IdOrg<td align="center">Organización<td align="center">Fecha<td align="center">Animales<td align="center">Movimientos<td align="center" colspan="2">Usuarios';
            //$nmrcampos = mysqli_num_fields($p);
            while ($f = mysqli_fetch_array($p)) {
                $sql3 = "select count(*) from t_usuarios where idorg = ".$f[0];
                $q = consultaSQL($sql3); while ($fila = mysqli_fetch_row($q)) $cntUsr = $fila[0]; 
                echo '<tr><td>';
				echo '<a href="infResumen.php?organ='.$f[0].'">Inactivar</a>';
				if ($f[6] != '')
					echo '&nbsp;<a href="asignaPartidas.php?organ='.$f[1].'">Conectar</a>';
				echo '</td>';
                echo '<td align="center">'.$f[0].'</td>';
                echo '<td align="center">'.$f[1].'</td>';
				echo '<td align="center">'.$f[3].'</td>';
                echo '<td align="center">'.$f[5].'</td>';
				echo '<td align="center">'.$f[6].'</td>';
                $sql1 = "select count(*) from t_animales where idorg = ".$f[0];
                $sql2 = "select count(*) from t_movimientos where idorg = ".$f[0];
                $q = consultaSQL($sql1); while ($fila = mysqli_fetch_row($q)) echo '<td align="center">'.$fila[0]; 
                $q = consultaSQL($sql2); while ($fila = mysqli_fetch_row($q)) echo '<td align="center">'.$fila[0]; 
                $sql4 = "select usuario, email from t_usuarios where idorg = ".$f[0];
                $k = consultaSQL($sql4); 
                $i=0;$cadUsu = '';//<table>'; 
                while ($fila = mysqli_fetch_array($k)) { 
                    if ($i>0) echo '<tr><td colspan="5">'; 
                    echo'<td align="center">'.$fila[0];
                    //echo '<td>'.$fila[1];
                    $i++;
                }
                echo '</tr>';
            }
            echo '</table>';
			// fin tabla 3			
			
			echo '</div>';			
            ?>
            </div>
        </div>
    </body>
</html>