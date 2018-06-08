<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = ""; //appgro//
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
$nmbGlb = 'Intelect';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-5837552012813784",
    enable_page_level_ads: true
  });
</script>
<meta name="description" content="Ejercicios de Programación. Lógica." />
<meta name="keywords" content="Fundamentos, Algoritmo, Problemas, Programacion"/>
<meta name="author" content="urbanoeliecer@gmail.com">
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8_spanish_ci" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo $nmbGlb;?></title>
<meta charset="utf-8">

<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/script.js"></script>        

<link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
<link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../sistema/estilos/js/bootstrap.min.js"></script>
<?php
//
$intro = '<b>Intelec: Grupo de Inv. en Informática y Telecomunicaciones</b><br><br><img src="imagenes/logoUPB.png"><br><br>El grupo INTELEC tiene por misión generar aportes al conocmiento mundial mediante el desarrollo de proyectos de investigación de alto impacto tecnológico, social y organizacional enfocado en  las Tecnologías de la Información y Telecomunicaciones aportanto a su vez a la formación de Investigadores mediantes proyectos de pregrado, Maestría y Doctorado.<br><br><b>Líneas de Investigación:</b><br>1. Telemática<br>2. Ciberseguridad<br>3. Ingeniería de Software<br>4. Gestión de TI<br>';
$car1 = " Integrantes";
$car2 = " Productos";
?>
</head>
<body>

        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Intelec</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                        echo '<img src = "imagenes/logo.png" width="47">&nbsp;';
                        //echo MenuBas();
                        ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

<div id="main">
    <div class="container">
        <section id="content">
            <div class="inside">
                <h2><span>Bienvenido!</span></h2>
                <p><?php echo $intro; ?></p>
            </div>
        </section>
        <aside>
            <div class="inside">
                <ul class="insurance"><table width="100%"><?php
                echo '<li><strong>'.$nmbGlb.' -'.$car1.'</strong></li>';
                // Deberá buscar en la base de datos
                include("0conect.php");
                $link = Conectarse();
                $sql = "Select Nombre, Apellido, Email, cvLac from usuarios order by Nombre, Apellido ";
                mysqli_query($link,"SET NAMES 'UTF8'");    
                $p = mysqli_query($link,$sql);
                $j=1; 
                while ($f = mysqli_fetch_array($p)) {
                     echo '<tr><td>'.$j.'&nbsp;';
                    for ($i=0;$i<3;$i++)
                      echo '<td>'.$f[$i];
                    echo '<td>&nbsp;';
                    if ($f[3] != '')
                      echo '<a href="https://'.$f[3].'"><img src="imagenes/ver.png" width="20"></a>';
                    $j++;
                }
                ?>
                </table><br><table width="100%"><?php
                echo '<li><strong>'.$nmbGlb.' -'.$car2.'</strong></li>';
                $sql = "Select NombreCorto, NombreLargo, anio, url, Tipo, estado from productos where estado = 2 order by Tipo, NombreCorto, Anio ";
                $p = mysqli_query($link,$sql);
                $j=1; $cmp='';
                while ($f = mysqli_fetch_array($p)) {
                    if ($f[4] != $cmp){
                        switch($f[4]){
                            case 1: $xx = 'Proyectos de Investigación'; break;
                            case 2: $xx = 'Artículos'; break;
                            case 3: $xx = 'Ponencias'; break;
                            case 4: $xx = 'Proyectos de Postgrado'; break;
                            case 5: $xx = 'Proyectos de Grado'; break;
							case 6: $xx = 'Semilleros'; break;
                        }
                        echo '<tr><td colspan="4"><b>'.$xx.'</b>';
                    }
                    echo '<tr><td>'.$j;
                    echo '<td>&nbsp;';
                    if ($f[5] == 2) echo '<a href="/'.$f[0].'"><img src="imagenes/'.$f[0].'.png" width="25"></a>';
                    echo '<td><a href="/'.$f[0].'">'.$f[0].'</a>';
                    echo '<td>'.$f[1];
                    echo '<td>'.$f[2];
                    echo '<td>&nbsp;';
                    if ($f[3] != '')
                      echo '<a href="https://'.$f[3].'"><img src="imagenes/ver.png" width="20"></a>';
                    $cmp = $f[4];
                    $j++;
                }
                ?>
                </table>
                </ul>
            </div>
        </aside>
    </div>

    </div>
<div align="center"> <tr>
<td> <div style="width: 300px; height: 250px; float: left;">

</div> </td>
<td><div style="width: 300px; height: 250px; float: right;">

</div></td></tr> 
</center>	
</body>
</html>