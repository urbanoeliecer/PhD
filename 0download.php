<div class="col-md-3"><?php
if (isset($_SESSION["usuario"])){
    echo 'Hola <font color="red">'.$_SESSION["usuario"].'</font>';
    ?>
    <h3>Descargar</h3><a href="/sami/files/Sami.zip">
    <img src="img/descarga.png" class="img-responsive" width="30"></a>
    <p>Debe dar clic en la imagen</p>
    <?php
}
 else {
?><!--<h3>Datos para la Descarga:</h3>
<form action ="0registroIn.php" method="POST">
Ingrese los datos y empiece a practicar habilidades administrando ganaderías<br>
<table>
<tr><td>Usuario:<td><input name="txtUsr" id="txtUsr">
<tr><td>Nombre:<td><input name="txtNmb" id="txtNmb">
<tr><td>Apellido:<td><input name="txtApl" id="txtApl">
<tr><td>Municipio:<td><input name="txtMnc" id="txtMnc">
<tr><td>Email:<td><input id= "email" type="text" name="txtCrr">
<tr><td>Documento:<td><input id= "txtDcm" type="text" name="txtDcm">
</table><br>

<input  type = "submit" class="btn btn-primary" value="Continuar" onclick="return validar()">
</form>-->
<?php
}
?>    
</div>    
