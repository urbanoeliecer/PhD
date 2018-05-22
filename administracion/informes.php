<?php
 
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
//$SystemFolder = "appconfig/appgro/sistema";
$SystemFolder = $AppName."sistema";//
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../loginForm.php");
}
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<?php
$screenWidth = '<script type="text/javascript">document.write(screen.availWidth);</script>'
?>
<title>SAMII-DSS</title>
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
<?php
//print $screenWidth;
$ancho = (integer)(@$_SESSION["Ancho"]*0.99); // 160114 Obtiene el ancho del canvas
$DB = 'appgrognral';
//print 'No sirve en local lo del ancho<br>';
if (!isset($ancho)) 
    $ancho = 800;
//print $ancho;
?>
    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!--<img src = "../images/appisSin.png" width="63">
            <a href="Manual.php?id=1"  target="_blank"><img src = "../images/descarga.png" width="33"></a>
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
        </div>
    </div>
</nav>
<form action="informes.php" method="POST">
<?php
$radOpc = @$_POST["radOpc"];
$radEvn = @$_POST["radEvn"];
if (!isset($radOpc)) $radOpc = 3;
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
$hoy = getdate();
$i=0;
foreach ($hoy as $k => $v) {
    $h[$i] = $v;
    $i++;
}
$fecAct = $h[6].'-'.str_pad($h[5],2,'0',STR_PAD_LEFT).'-'.str_pad($h[3],2,'0',STR_PAD_LEFT);
$fecAcIni = $h[6].'-'.str_pad($h[5],2,'0',STR_PAD_LEFT).'-01';
// 170529
$idanimal = @$_POST["idanimal"];
if ($idanimal != '') { 
    $sql = "select numero from t_animales where idanimal =  ".$idanimal;
    $rrr = consultaSQL($sql, $_SESSION['idorg']); $f = mysqli_fetch_array($rrr);
    $idanimalx = $f[0];
}
else
  $idanimalx = 1;
//print $idanimalx.' Ejemplo';
$incAnm = @$_POST["incAnm"];
$fecIni = @$_POST["fecIni"];
$fecFin = @$_POST["fecFin"];
$mod_date = strtotime($fecFin."+ 1 days");
$fecFin = date("Y-m-d",$mod_date);
 //= date("Y-m-d",strtotime($fecFin)+86400);
if (!isset($fecIni)) $fecIni = $fecAcIni;
if (!isset($fecFin)) $fecFin = $fecAct;
$accion=1;
$novedad = 'Leche';
//Purgas Muertes 
//Individual  Compras Ventas Vacunas
//$cad =  'Tip: <font color = "0033cc">'.$radOpc;
//$cad .= '</font> - Evn: <font color = "0033cc">'.$radEvn;
if ($radOpc == 3) $cad ="Resumen de Animales por Grupo Etario";
else {
    $cad = 'Inf. Producción </font> - <font color = "0033cc">'.$fecIni;
    $cad .= '</font> & <font color = "0033cc">'.$fecFin;
    $cad .= '</font> - Anm: <font color = "0033cc">'.$idanimalx.'</font>';
}
echo '<div align="center">'.$cad.'</div>';
echo '<canvas id="'.$idx.'" height="250" width="'.$ancho.'"></canvas>';
?>
<div style="margin-left:3px;">
<font size="2">
<?php
/*        
$datosInforme = Inf_TiposAnimales(); 
        $datax = array($datosInforme["descripcion"]);
        $datay = array($datosInforme["cuenta"]);
*/
switch ($radOpc){
    case 1: 
        $SQL = "SELECT sum(cantidad),DATE(fecha) FROM t_movimientos WHERE ".$_SESSION["idorg"];
        $SQL .= " and idtipomovimiento = '$radEvn'"; 
        $SQL .= " and fecha >= '".$fecIni."'"; 
        $SQL .= " and fecha <= '".$fecFin."'"; 
        $SQL .= " GROUP BY fecha ";
        break;  
    case 2:
        $SQL = "SELECT count(*),DATE(fecha),idtipomovimiento FROM t_movimientos where idorg = ".$_SESSION["idorg"];
        if ($radEvn != 10) $SQL .= " and idtipomovimiento = '$radEvn'"; 
        $SQL .= " and fecha >= '".$fecIni."'"; 
        $SQL .= " and fecha <= '".$fecFin."'"; 
        if ($incAnm == 1) $SQL .= " and idanimal = '$idanimal' ";
        $SQL .= " GROUP BY DATE(fecha)";
        if ($radEvn == 10) 
          $SQL .= ",  idtipomovimiento ";
    break;
    case 3:
        $SQL = "SELECT count(a.IdTipoAnimal ), t.TipoAnimal FROM t_animales a, t_tiposanimal t WHERE idorg = ".$_SESSION["idorg"];
        //$SQL .=" and a.estado = 1 ";
		$SQL .=" and a.IdTipoAnimal = t.IdTipoAnimal GROUP BY a.IdTipoAnimal order by t.TipoAnimal ";
    break;
    case 4:
        $SQL = "SELECT cantidad,DATE(fecharegistro) FROM t_movimientos where idorg = ".$_SESSION["idorg"];
        if ($radEvn != 10) $SQL .= " and idtipomovimiento = '$radEvn'"; 
        $SQL .= " and fecha >= '".$fecIni."'"; 
        $SQL .= " and fecha <= '".$fecFin."'"; 
        if ($incAnm == 1) $SQL .= " and idanimal = '$idanimal' ";
        $SQL .= ' order by fecharegistro asc';
        //print $SQL;
    break;
    default:
        $SQL = "SELECT count(a.IdTipoAnimal ), t.descripcion FROM t_animales a, t_tiposanimal t WHERE a.idorg = ".$_SESSION["idorg"];
        $SQL .= " and a.IdTipoAnimal = t.IdTipoAnimal GROUP BY a.IdTipoAnimal ";
}
//print $SQL;
$BD = $DB; 
$link = conectar();
$p = consultaSQL($SQL, $BD);
$j=0;
if ($p != ''){
    while ($f = mysqli_fetch_array($p)) {
        $cntAnm[$j]=(integer)$f[0];
        $grpAnm[$j]=substr($f[1],0,10);
        $aux[$j]=@$f[2];
        $j++;
    }
    //170524 controla los que faltan
    if ($radOpc == 3) {
        if ($j<15){
            for ($u=$j;$u<15;$u++)
            $cntAnm[$u]=0;
        }
    }
}
if ($ancho < 400 && $j > 30) echo '<div align="center"><font color="red">Debe mejorar los criterios</font></div>';
?>
<table border="1" align="center" style="width:350px">
<?php
echo '<tr><td colspan="2">Animal:&nbsp;';
echo '<input type="checkbox" name="incAnm" value ="1" ';
if ($incAnm == 1) echo 'checked';
echo '>&nbsp;';
getCombo('t_animales','idanimal','',$idanimalx,$idanimal,$_SESSION['idorg']);
echo '<td align="center"><input type="submit"></td></tr>';
date_default_timezone_set("America/Bogota");
echo '<tr><td align="right">Inicio: <td colspan="2"><input type="date" name="fecIni" value=' .$fecIni . ' style="height:22px;width:160px"/>';
echo '<tr><td align="right">Final:<td colspan="2"><input type="date" name="fecFin" value=' .$fecFin. ' style="height:22px;width:160px"/>';
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
</tr>
</table>
<?php
//Colores solo para el tipo 3
$colores = array("#1aff8c","#b3ffb3","#ffe0b3","#e68a00","#e6e600","#0059b3","#F7464A","#46BFBD","#FDB45C","#949FB1","#4D5360","#0033cc","#e6f2ff","#ffaae6","#ff3399");
//Lineas,Barras,Donut,Contraste
echo '<br><table border="1" align="center" style="width:330px">';
echo '<tr bgcolor="#B8E9EA"><td align="center">';
if (($radOpc > 1) && ($radOpc < 4))
    echo 'Tipo';
else
    echo 'Fecha';
echo '<td align="center">Cantidad';
if (@$aux[0] != '') echo '<td  align="center">Tipo';
for ($i=0;$i<$j;$i++){
    echo '<tr';
    if ($i%2 == 1) echo ' bgcolor="#B8E9EA"';
    echo '>';
    echo '<td align="center" ';
    if ($radOpc == 3) echo 'bgcolor="'.$colores[$i].'"';
    echo '>'.$grpAnm[$i].'</td><td align="center"';
    if ($radOpc == 3) echo 'bgcolor="'.$colores[$i].'"';
    echo '>'.$cntAnm[$i].'</td>';
    if ($aux[$i] != '') echo '<td align="center">'.$aux[$i];
}
echo '</table>';
if ($j == 0) echo '<div align="center"><font color="red">Debe seleccionar mejor los criterios o no hay datos</font></div>';
?>
</font> 
<?php
//d.semana, 
//if ($radEvn == 1)
//t_produccion p, and idraza = 1 
$SQL = "select d.cantidad from  t_producciondet d where d.idprod = $radEvn";
$p = consultaSQL($SQL, $BD);
$cntEsp[0] = 0; // Reiniciar por si no hay datos para la raza
$i=0;
if ($p != ''){
    while ($f = mysqli_fetch_array($p)) {
        $cntEsp[$i]= (integer)$f[0];
        $i++;
    }
}
if ($i == '1'){
    for ($k=0;$k<=$j;$k++){
        $cntEsp[$k]=$cntEsp[0]; 
    }
} 
?>
<!-- Placed at the end of the document so the pages load faster --> 
<script>     
var colors = ["#1aff8c","#b3ffb3","#ffe0b3","#e68a00","#e6e600","#0059b3","#F7464A","#46BFBD","#FDB45C","#949FB1","#4D5360","#0033cc","#e6f2ff","#ffaae6","#ff3399"];
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
var doughnutData = [
    {value:  7,color:"#1aff8c"},
    {value: 14,color:"#b3ffb3"},
    {value: 21,color:"#ffe0b3"},
    {value: 26,color:"#e68a00"},
    {value: 28,color:"#cce6ff"},
    {value: 32,color:"#0059b3"},
    {value: 37,color:"#F7464A"},
    {value: 41,color:"#46BFBD"},
    {value: 47,color:"#FDB45C"},
    {value: 53,color:"#949FB1"},
    {value: 58,color:"#4D5360"},
    {value: 62,color:"#46BFBD"},
    {value: 67,color:"#FDB45C"},
    {value: 74,color:"#949FB1"},
    {value: 78,color:"#4D5360"}];
for (var i=0;i<15;i++){
    cntAnm[i]
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