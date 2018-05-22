<?php
 
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "";
$SystemFolder = "appconfig/appgro/sistema";
$SystemFolder = $AppName."//sistema"; 
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../loginForm.php");
}
$ancho = (integer)(@$_SESSION["Ancho"]*0.99); // 160114 Obtiene el ancho del canvas
$DB = 'appgrognral';


?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>AgroIT - appis</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
<link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script  src="../sistema/estilos/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<script src="../design_appgro/backend/js/excanvas.min.js"></script> 
<script src="../design_appgro/backend/js/chart.min.js" type="text/javascript"></script> 
<script language="JavaScript"> 
a = screen.width;
b = screen.height; 
</script>

<?php
include "$root//$SystemFolder//funciones//ComboInput.php"; //$AppName//
?>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <img src = "../images/appisSin.png" width="63"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">AgroIT - appis</a>
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
</nav><br/><br/><br/>
<form action="informes_p.php" method="POST">

<?php
print $radOpc = @$_POST["radOpc"];
$radEvn = @$_POST["radEvn"];
if (!isset($radOpc)) $radOpc = 1;
if (!isset($radEvn)) $radEvn = 2;
$idx=1;
switch ($radOpc){
case 1: $idx = 'area-chart'; $cl='';  break;
case 2: $idx = 'bar-chart';$cl='chart-holder'; break;
case 3: $idx = 'donut-chart';$cl='';  break;
case 4: $idx = 'area-chart';$cl='';  break;
//case 6: $idx = 'pie-chart'; $cl='';break;
//case 4: $idx = 'line-chart';$cl=''; break;
}



echo '<canvas id="'.$idx.'" height="250" width="'.$ancho.'"></canvas>';
?>
<div style="margin-left:3px;">
<font size="2">
<?php
$hoy = getdate();
$i=0;
foreach ($hoy as $k => $v) {
    $h[$i] = $v;
    $i++;
}
$fecAct = $h[6].'-'.str_pad($h[5],2,'0',STR_PAD_LEFT).'-'.str_pad($h[3],2,'0',STR_PAD_LEFT);
$fecAcIni = $h[6].'-'.str_pad($h[5],2,'0',STR_PAD_LEFT).'-01';
$idanimal = @$_POST["idanimal"];
$incAnm = @$_POST["incAnm"];
$fecIni = @$_POST["fecIni"];
$fecFin = @$_POST["fecFin"];
if (!isset($fecIni)) $fecIni = $fecAcIni;
if (!isset($fecFin)) $fecFin = $fecAct;
$accion=1;
$novedad = 'Leche';
//Purgas Muertes 
//Individual  Compras Ventas Vacunas
$cad =  'Tip: <font color = "0033cc">'.$radOpc;
$cad .= '</font> - Evn: <font color = "0033cc">'.$radEvn;
$cad .= '</font> - <font color = "0033cc">'.$fecIni;
$cad .= '</font> & <font color = "0033cc">'.$fecFin;
$cad .= '</font> - Anm: <font color = "0033cc">'.$idanimal.'</font>';
echo '<div align="center">'.$cad.'</div>';
?>
<table border="1" align="center" style="width:330px">
<?php
echo '<tr><td colspan="2">Animal:&nbsp;';
echo '<input type="checkbox" name="incAnm" value ="1" ';
if ($incAnm == 1) echo 'checked';
echo '>&nbsp;';
getCombo('t_animales','idanimal','',$_SESSION['idorg']);
echo '<td align="center"><input type="submit"></td></tr>';
?>
<tr><td colspan="3">
<?php
date_default_timezone_set("America/Bogota");
echo 'Inicio: <input type="date" name="fecIni" value=' .$fecIni . ' style="height:22px;width:120px"/>';
echo '&nbsp;&nbsp;Final:<input type="date" name="fecFin" value=' .$fecFin. ' style="height:22px;width:120px"/>';
?>
<tr bgcolor="#B8E9EA" ><td align="center">Tipo</td><td align="center" colspan="2">Evento</td></tr>
<tr>
<td><input type="radio" name="radOpc" value ="1" <?php if ($radOpc == 1) echo 'checked';?>>Producción Consolid.
<br><input type="radio" name="radOpc" value ="2" <?php if ($radOpc == 2) echo 'checked';?>>Cant. Registros /día
<br><input type="radio" name="radOpc" value ="3" <?php if ($radOpc == 3) echo 'checked';?>>Distribución Etarea
<br><input type="radio" name="radOpc" value ="4" <?php if ($radOpc == 4) echo 'checked';?>>Producción por Animal  

<td rowspan="3"><input type="radio" name="radEvn" value ="1" <?php if ($radEvn == 1) echo 'checked';?>>Peso
<br><input type="radio" name="radEvn" value ="2" <?php if ($radEvn == 2) echo 'checked';?>>Leche
<br><input type="radio" name="radEvn" value ="3" <?php if ($radEvn == 3) echo 'checked';?>>Cria
<br><input type="radio" name="radEvn" value ="4" <?php if ($radEvn == 4) echo 'checked';?>>Compra
<br><input type="radio" name="radEvn" value ="5" <?php if ($radEvn == 5) echo 'checked';?>>Venta
<td><input type="radio" name="radEvn" value ="6" <?php if ($radEvn == 6) echo 'checked';?>>Vacuna
<br><input type="radio" name="radEvn" value ="7" <?php if ($radEvn == 7) echo 'checked';?>>Purga
<br><input type="radio" name="radEvn" value ="8" <?php if ($radEvn == 8) echo 'checked';?>>Muerte
<br><input type="radio" name="radEvn" value ="9" <?php if ($radEvn == 9) echo 'checked';?>>Estado
<br><input type="radio" name="radEvn" value ="10" <?php if ($radEvn == 10) echo 'checked';?>>Todos
</td>
<?php
//echo '<br><input type="radio" name="radOpc" value ="4">Char<br><input type="radio" name="radOpc" value ="6">Polar<br><input type="radio" name="radOpc" value ="1">Peso';
/*
Lineas
Barras
Donut
Contraste
*/
?>
</tr>
</table>
<?php
/*        
$datosInforme = Inf_TiposAnimales(); 
        $datax = array($datosInforme["descripcion"]);
        $datay = array($datosInforme["cuenta"]);
*/
switch ($radOpc){
    case 1: 
        $SQL = "SELECT sum(cantidad),fecha FROM t_movimientos WHERE idtipomovimiento = idtipomovimiento";
        $SQL .= " and idtipomovimiento = '$radEvn'"; 
        $SQL .= " and fecha >= '$fecIni'"; 
        $SQL .= " and fecha <= '$fecFin'"; 
        $SQL .= " GROUP BY fecha ";
        break;  
    case 2:
        $SQL = "SELECT count(*),fecha FROM t_movimientos where idtipomovimiento = idtipomovimiento ";
        if ($radEvn != 10) $SQL .= " and idtipomovimiento = '$radEvn'"; 
        $SQL .= " and fechaRegistro >= '".$fecIni." 00:00:00'"; 
        $SQL .= " and fechaRegistro <= '".$fecFin." 23:59:59'"; 
        if ($incAnm == 1) $SQL .= " and idanimal = '$idanimal' ";
        $SQL .= " GROUP BY fecha ";
    break;
    case 3:
        $SQL = "SELECT count(a.IdTipoAnimal ), t.descripcion FROM t_animales a, t_tiposanimal t WHERE  a.idorg = $idorg and "
            . "a.IdTipoAnimal = t.IdTipoAnimal GROUP BY a.IdTipoAnimal ";
    break;
    case 4:
        $SQL = "SELECT cantidad,fecha FROM t_movimientos where idtipomovimiento = idtipomovimiento ";
        if ($radEvn != 10) $SQL .= " and idtipomovimiento = '$radEvn'"; 
        $SQL .= " and fecha >= '$fecIni'"; 
        $SQL .= " and fecha <= '$fecFin'"; 
        if ($incAnm == 1) $SQL .= " and idanimal = '$idanimal' ";
    break;
    default:
        $SQL = "SELECT count(a.IdTipoAnimal ), t.descripcion FROM t_animales a, t_tiposanimal t WHERE a.idorg = $idorg and "
            . "a.IdTipoAnimal = t.IdTipoAnimal GROUP BY a.IdTipoAnimal ";
}
//$SQL = "SELECT count(a.IdTipoAnimal ), t.descripcion FROM t_animales a, t_tiposanimal t WHERE a.IdTipoAnimal = t.IdTipoAnimal GROUP BY a.IdTipoAnimal ";
//print $SQL;
$BD = $DB; 
$link = conectar();
$p = consultaSQL($SQL, $BD);
echo '<br><table border="1" align="center" style="width:330px">';
$j=0;
echo '<tr bgcolor="#B8E9EA"><td align="center">';
if (($radOpc > 1) && ($radOpc < 4))
    echo 'Tipo';
else
    echo 'Fecha';
echo '<td align="center">Cantidad';
if ($p != ''){
    while ($f = mysqli_fetch_array($p)) {

    echo '<tr';
    if ($j%2 == 1) echo ' bgcolor="#E0C000"';
    echo '>';
    echo '<td align="center">'.$f[1].'</td><td align="center">'.$f[0].'</td>';
    $cntAnm[$j]=(integer)$f[0];
    $grpAnm[$j]=$f[1];
    $j++;
}
}
echo '</table>';
if ($j == 0) echo '<div align="center"><font color="red">Debe seleccionar mejor los criterios o no hay datos</font></div>';
?>
</font> 
<?php
//d.semana, 
print $SQL = "select d.cantidad from t_produccion p, t_producciondet d where p.idtipomovimiento = 2 and idraza = 1 ";
$p = consultaSQL($SQL, $BD);
$cntEsp[0] = 0; // Reiniciar por si no hay datos para la raza
$i=0;
if ($p != ''){
while ($f = mysqli_fetch_array($p)) {
    print $cntEsp[$i]= (integer)$f[0];
    $i++;
}
}
if ($i == '1'){
    for ($k=0;$k<=$j;$k++){
        print $cntEsp[$k]=$cntEsp[0]; 
    }
} 
?>
<!-- Placed at the end of the document so the pages load faster --> 
<script>     
var colors = ["#F7464A","#46BFBD","#FDB45C","#949FB1","#4D5360","#0033cc","#FFFFF","#000000","#555555"];
var cntAnm = <?php echo json_encode($cntAnm);?>;
var grpAnm = <?php echo json_encode($grpAnm);?>;
var cntEsp = <?php echo json_encode($cntEsp);?>;
var radOpc = <?php echo $radOpc ?>;
switch (radOpc) 
{
case 1:
var lineChartData = {
    labels: grpAnm, 
    datasets: [
                {
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    data :cntAnm
                    //data: [65, 59, 90, 81, 56, 55, 40]
                }
                ]
}
var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);

break;
case 2:
var barChartData = {
            labels: grpAnm, 
            datasets: [
				{
				    fillColor: "rgba(220,220,220,0.5)",
				    strokeColor: "rgba(220,220,220,1)",
				    data: cntAnm //[65, 59, 90, 81, 56, 55, 40]
				}
			]

        }

var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);
   
break;

case 3:

var doughnutData = [{value: 67,color: "#F7464A"},{value:80,color: "#46BFBD"},{value: 42,color: "#FDB45C"},{value: 40,color: "#949FB1"},{ value: 48, color: "#4D5360"},{ value:80, color : "#46BFBD"},{ value: 42, color: "#FDB45C"},{ value: 40, color: "#949FB1"},{ value: 48, color: "#4D5360"}];
for (var i=0;i<9;i++){
    doughnutData[i].value = parseInt(cntAnm[i]);
    doughnutData[i].color = colors[i];
}
var myDoughnut = new Chart(document.getElementById("donut-chart").getContext("2d")).Doughnut(doughnutData);
break;
case 5:
var pieData = [
				{
				    value: 30,
				    color: "#F38630"
				},
				{
				    value: 50,
				    color: "#E0E4CC"
				},
				{
				    value: 100,
				    color: "#69D2E7"
				}

			];

				var myPie = new Chart(document.getElementById("pie-chart").getContext("2d")).Pie(pieData);
break;
case 4:
var lineChartData = {
    labels: grpAnm, //["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            data : cntAnm
            //data : [65, 59, 90, 81, 56, 55, 40]
        },
        {
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            data : cntEsp
            //data : [11, 10, 10]
        }
    ]
}
var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);
    
break;
case 6: 
				var chartData = [
			{
			    value: Math.random(),
			    color: "#D97041"
			},
			{
			    value: Math.random(),
			    color: "#C7604C"
			},
			{
			    value: Math.random(),
			    color: "#21323D"
			},
			{
			    value: Math.random(),
			    color: "#9D9B7F"
			},
			{
			    value: Math.random(),
			    color: "#7D4F6D"
			},
			{
			    value: Math.random(),
			    color: "#584A5E"
			}
		];
				var myPolarArea = new Chart(document.getElementById("line-chart").getContext("2d")).PolarArea(chartData);
break;

}

</script>
</div>
</form>
</body>
</html>