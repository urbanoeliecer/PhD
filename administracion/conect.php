<?php
// P�gina para definir la funci�n de conexi�n
function Conectarse()
{
    $bd = 'bdsamii';
    if (!($link = mysqli_connect("localhost","root","")))
    {
      echo "Error conectando a la base de datos.";
      exit();
   }
   if (!mysqli_select_db($link,$bd)){ 
      echo "Error seleccionando la base de datos.";
      exit();
   } 
   mysqli_query($link,"SET NAMES 'utf8'");
   return $link;
}
$link=Conectarse();   
?>