<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../loginForm.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>SAMII-DSS</title>

<link rel="stylesheet" href="../css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="../css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="../css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/script.js"></script> 

<link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
<link href="../../sistema/estilos/css/appgro.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script  src="../../sistema/estilos/js/bootstrap.min.js"></script>

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
        </nav><div id="main">
<?php
$id = $_GET["id"];
if($id>0 && $id<7){
$BD = 'appgrognral'; 
$link = conectar();
//CONVERT(CAST(CONVERT(descripcion USING latin1) AS BINARY) USING utf8)
$SQL = 'select id,titulo,descripcion , imagen, video from manual where id='.$id;
$p = consultaSQL($SQL, $BD);
mysqli_query($link,"SET NAMES 'UTF8'");
while ($f = mysqli_fetch_array($p)) {
    $car1 = $f[1];
    $car2 = $f[2];
    $img = $f[3];
    $vid = $f[4];
}
?>
<div class="container">
<section id="content">
<div class="inside">
<h3><span><?php echo $car1;?></span></h3>
<table  width="330">
<tr><td><?php 
echo $car2; ?>
<tr>
<td align="center"><img src="../images/manual/<?php echo $img;?>" width="335">
</table>
</div>
</section>
<aside>
<div class="inside">
<ul class="insurance">
<br><br><li><strong><?php echo $car1;?></strong>
    <iframe width="340" height="265" src="https://www.youtube.com/embed/<?php echo $vid;?>" frameborder="0" allowfullscreen></iframe>
</ul>
</div>
</aside>
<?php
}
else {
    echo '<div align="center">Esa opción no existe en el Manual</div>';
}
?> 
</div>
<footer>
    <hr style="color: #0056b2;" />
    <div align="center">
        Desarrollado por AgroIT 
        <br>2015 - 2017
    </div>
</footer>
</div>
</body>
</html>