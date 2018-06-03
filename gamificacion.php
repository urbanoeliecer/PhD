<?php
// Traigo el Vector de Resultados de los jugos
include("conect_app.php");
$link = ConectarseExt();
//$ssql = "select p.idorg, o.orgnmb, o.idusuario, max(p.tiempo),p.dinero from partidaestdnr p, t_organizaciones o where o.idorg = p.idorg group by p.idorg ";
//select estDnrid from partidaestdnr order by dinero group by idorg 
//print $ssql = "select distinct(p.idorg),  o.orgnmb, o.idusuario, p.tiempo as tmp, max(p.dinero) as dnr from partidaestdnr p, t_organizaciones o where MOD(p.tiempo,6)= 0 and p.dinero > 0 and o.idorg = p.idorg group by p.tiempo, p.idorg order by tmp desc,dnr desc";
$ssql = "select distinct(p.idorg),  o.orgnmb, o.idusuario, max(p.tiempo) as tmp, max(p.dinero) as dnr from partidaestdnr p, t_organizaciones o where p.dinero > 2000000 and o.idorg = p.idorg group by p.idorg order by tmp desc,dnr desc";
$p = mysqli_query($link,$ssql);
$ii = 0;
$ant = '';
while ($fila = mysqli_fetch_array($p)) {
	//if ($ant != $fila[1])
	{
		$idorgx[$ii] = $fila[0];
		$orgx[$ii] = $fila[1];
		$usrx[$ii] = $fila[2];
		$tmpx[$ii] = $fila[3];
		$dnrx[$ii] = $fila[4];	
		$ii++;
	}
	$ant = $fila[1];
}
//mysqli_close();
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
        <title>SAMI-DSS - Gamificacion</title>
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
                    <a href="Manual.php?id=5" target="_blank"><img src = "../images/descarga.png" width="33"></a>-->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">SAMI-DSS</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                        //echo Menu($_SESSION["IdPerfil"]);
						echo MenuGame();
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
<?php
include("conect.php");
function pintarPrg($scc){
	$SQL = 'select * from preguntas ';
	$link = Conectarse();
	$p = mysqli_query($link,$SQL);
	$cntPrg = 0;
	while ($fila = mysqli_fetch_array($p)) {
		$prgId[$cntPrg] = $fila[0];
		$prg[$cntPrg] = $fila[2];
		$prgScc[$cntPrg] = $fila[1];
		$cntPrg++;
	}
	for ($i=0;$i< $cntPrg;$i++){
		if ($prgScc[$i] == $scc){
			echo '<br><br>'.$prg[$i];
			$SQP = 'select * from respuestas where prgid = '.$prgId[$i] ;
			$link = Conectarse();
			$p = mysqli_query($link,$SQP);
			while ($fila = mysqli_fetch_array($p)) {
				echo '<br><input type="radio" name="r'.$prgId[$i].'" value = "1">'.$fila[2].'</radio>';
				echo '<br><input type="radio" name="r'.$prgId[$i].'" value = "2">'.$fila[3].'</radio>';
				echo '<br><input type="radio" name="r'.$prgId[$i].'" value = "3">'.$fila[4].'</radio>';
				echo '<br><input type="radio" name="r'.$prgId[$i].'" value = "4">'.$fila[5].'</radio>';
			}
		}				
	}
}
function pintarImagen($scc){
	// Selecciona la imagen
	switch($scc){
		case 1: $img = 'ganaderia.jpg'; $txt = 'Ganadería'; break;
		case 2: $img = 'TIC.jpg'; $txt = 'TIC'; break;
		case 3: $img = 'modelo.jpg'; $txt = 'Modelo';  break;
		case 4: $img = 'Papel.png'; $txt = 'Papel';  break;
		case 5: $img = 'Samii-VS.jpeg'; $txt = 'Samii-VS';  break;
		case 6: $img = 'Samii-DSS.jpeg'; $txt = 'Samii-DSS';  break;
	}
	echo '<tr><td align="center">';	
    echo '<h4>'.$txt.'</h4>';	
	echo '<img src="../img/'.$img.'"><br>';
	//Busca la descripción de la descripción
	$SQL = 'select sccDsc from secciones where sccid = '.$scc;
	$link = Conectarse();
	$p = mysqli_query($link,$SQL);
	while ($fila = mysqli_fetch_array($p)) {
		echo $fila[0];
	}
}
// Empieza la página
// Traigo el Vector de Resultados de los jugos (arriba)
// Vector de Resultados
/*$ssql = "select c.cmnid, c.cmn, uc.idusr,uc.nombres from comunidades c, usuariosxcomunidad uc where c.cmnid = uc.idcmn ";
$p = mysqli_query($link,$ssql);
$kk = 0;
while ($fila = mysqli_fetch_array($p)) {
	//$idcmn = $fila[0];
	//$idusu = $fila[2];
	//$juego[$idcmn][$idusu] = $fila[2];
	$idcmny[$kk] = $fila[0];
	$cmny[$kk] = $fila[1];
	$usry[$kk] = $fila[2];
	$usrNmby[$kk] = $fila[3];
	$kk++;
*/
echo '<div align="center">Top de Resultados';
echo '<table border ="1" width="90%" align="center"><thead><tr><th><div align="center">#<th><div align="center">Cmn<th><div align="center">Cmn<th><div align="center">IdOrg<th><div align="center">Org<th><div align="center">IdUsuario<th><div align="center">Usuario<th><div align="center">Tiempo<th><div align="center">Dinero</td></thead></tr>';
$fil = 1;
for ($j=0;$j<$ii;$j++){
	// $ssql = "select distinc(p.idorg),  o.orgnmb, o.idusuario, p.tiempo, max(p.dinero) as x from partidaestdnr p, t_organizaciones o where p.dinero > 0 and o.idorg = p.idorg group by p.idorg order by x desc";
	$ssql = "select c.cmnid, c.cmn, uc.nombres from comunidades c, usuariosxcomunidad uc where c.cmnid = uc.idcmn and c.cmnid != 1 and uc.idusr = ".$usrx[$j];
	$p = mysqli_query($link,$ssql);
	$kk = 0;
	while ($fila = mysqli_fetch_array($p)) {
    /*
	$k=1;
	// busca dentro de todo el arreglo el nombre de la comunidad de ese usuario
	while ($k<=$kk){
		if ($usrx[$j] == $usry[$k]){
			$idcmn = $idcmny[$k];
			$cmn = $cmny[$k];
			$org = $orgx[$j];
			$tmp = $tmpx[$j];
			$dnr = $dnrx[$j];
			$usrNmb = $usrNmby[$k];
			$k=$kk;
		}
		$k++;
	}
    if ($idcmn > 1) 	*/
		echo '<tr><td align="center">'.$fil.'<td align="center">'.$fila[0].'<td align="center">'.$fila[1].'<td align="center">'.$idorgx[$j].'<td align="center">'.$orgx[$j].'<td align="center">'.$usrx[$j].'<td align="center">'.$fila[2].'<td align="center">'.$tmpx[$j].'<td align="right">'.number_format($dnrx[$j], 0, ".", ",").'</td>';
	$fil++;
	}
}
echo '</table>';
//Otros informes
echo '<div align="center"><br>';
//echo '<h4>Gamificación</h4>';
echo '<table align="center" width="95%"><tr><td align="center">';

$a = @$_GET["scc"];
$usr = $_SESSION["IdUsuario"];
$fch = date("Y-m-d H:i:s");
// Si no es alguna sesión es porque está enviando algunas respuestas
if ($a == ''){
	echo 'Top de Preguntas';

	$SQL = 'select prgid, sccid, prg, rspcrr from preguntas ';
	$link = Conectarse();
	$p = mysqli_query($link,$SQL);
	$cntPrg = 1;
	while ($fila = mysqli_fetch_array($p)) {
		$prgId[$cntPrg] = $fila[0];
		$prg[$cntPrg] = $fila[2];
		$prgScc[$cntPrg] = $fila[1];
		$rspCrr[$cntPrg] = $fila[3];
		$cntPrg++;
	}
	for ($i=1;$i<= $cntPrg;$i++){
		$rsp = @$_POST["r".$prgId[$i]];
		//print $rsp. ' '.$i.'<br>';
		//Si encontró alguna respuesta de alguna pregurna se la asigna al usuario
		if ($rsp != ''){
			// compara si la respuesta asignada corresponde con la respuesta correcta
			$vlrRsp = 0;
			if ($rspCrr[$i] == $rsp)
				$vlrRsp = 5;
			$SQL = "insert into pruebas (fecha,idusuario,pregunta,valor) values ('".$fch."',$usr,$prgId[$i],$vlrRsp)";
			//print $SQL;
			$p = mysqli_query($link,$SQL);
		}
	}
     
	$usr = '1';//$prgId[$i] 
	echo '<table border="1" width="95%"><tr><td align="center">Sección<td align="center">Pregunta<td align="center">Pregunta<td align="center">Fecha<td align="center">Cantidad<td align="center">Promedio<td align="center">Gráfico</tr>';
	//$SQP = 'select idprueba, fecha, idusuario, pregunta, valor from pruebas where idusuario = '.$usr.'';
	$SQP = 'select s.scc, e.pregunta, p.prg, e.fecha, count(e.valor), avg(e.valor) from secciones s, pruebas e, preguntas p where s.sccid = p.sccid and p.prgid = e.pregunta ';
	if ($usr != 1) $SQP .= ' and e.idusuario = '.$usr;
	$SQP .= ' group by p.sccid, e.pregunta';
	$SQP .= ' order by p.sccid, e.pregunta';
	//print $SQP;
	$link = Conectarse();
	$p = mysqli_query($link,$SQP);
	while ($fila = mysqli_fetch_array($p)) {
		$ancho = ($fila[5]*100)/5;
		echo '<tr><td align="center">';
		echo $fila[0].'<td align="center">'.$fila[1].'<td><font size="1">'.$fila[2].'<td align="center">'.$fila[3].'<td align="center">'.$fila[4].'<td align="center">'.$fila[5].'<td><img src="../img/grafica.jpg" width="'.$ancho.'" height="10">';
	}
	echo '</table><br>';
	echo '<table border="1" width="95%"><tr><td align="center">Usuario<td align="center">Sección<td align="center">Pregunta<td align="center">Pregunta<td align="center">Fecha<td align="center">Cantidad<td align="center">Promedio<td align="center">Gráfico</tr>';
	//$SQP = 'select idprueba, fecha, idusuario, pregunta, valor from pruebas where idusuario = '.$usr.'';
	$SQP = 'select s.scc, e.pregunta, e.idusuario, p.prg, e.fecha, count(e.valor), avg(e.valor) from secciones s, pruebas e, preguntas p where s.sccid = p.sccid and p.prgid = e.pregunta ';
	if ($usr != 1) $SQP .= ' and e.idusuario = '.$usr;
	$SQP .= ' group by s.scc, e.pregunta, e.idusuario';
	$SQP .= ' order by e.idusuario, p.sccid, e.pregunta';
	//print $SQP;
	$link = Conectarse();
	$p = mysqli_query($link,$SQP);
	while ($fila = mysqli_fetch_array($p)) {
		$ancho = ($fila[6]*100)/5;
		echo '<tr><td align="center">';
		echo $fila[2].'<td align="center">'.$fila[0].'<td align="center">'.$fila[1].'<td><font size="1">'.$fila[3].'<td align="center">'.$fila[4].'<td align="center">'.$fila[5].'<td align="center">'.$fila[6].'<td><img src="../img/grafica.jpg" width="'.$ancho.'" height="10">';
	}
	echo '</table>';
}
else
{

?>

<form action="gamificacion.php" method = "POST">
<?php
pintarImagen($a);
pintarPrg($a);
?>
<br><br><input type = "submit" value = "Enviar" name="btn">
<form><?php
}
echo '</td></tr></table></div>';
?>
</body>
</html>
<!--
<td></td></td><td>&nbsp;
<td width="40%" align="center">Tareas Pendientes</td></td><td>&nbsp;</td>
<td valign="top"><?php DibujarTabla("tareaspendientes", $_SESSION['idorg'],''); ?>
<td>&nbsp;</td>
-->