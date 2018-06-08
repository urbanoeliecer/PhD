<div class="container">
<h1>SAMI - Videojuego serio para el aprendizaje de ganadería</h1>
</div>  
<div class="container">
<div class="row">
<div class="col-md-3">
Videojuego de sistemas de producción bovina para el entretenimiento y el aprendizaje que brinda la posibilidad de contraste de las jugadas con los resultados que podrían llegar a obtenerse si se sigue un proceso óptimo con el manejo de recursos.
<div align="center"><img src="img/logoUPB.png" class="img-responsive"></div>
<b>Elaborado por:</b><br>Intelec - UPB B/manga<br>Urbano Eliécer Gómez Prada<br>Oscar Fernando Gómez Sandoval<br>

<form class="form-signin" method="POST" action="LogIn.php">
<?php
if (isset($_SESSION["usuario"])){
// ir a cabecera
}
else {
    ?><!--
    <h3>Iniciar Sesión:</h3>
    <table>
    <tr><td>Usuario:<td><input type="text" placeholder="Usuario" name="usuario" size="8" required autofocus>
    <tr><td>Password:<td><input type="password"  name="password" size="8"  placeholder="Contraseña" required>
    <tr><td colspan="2"><input type="submit" value="Enviar" class="btn btn-primary" >
    </table>
	-->
<?php
}
?> 
</form> 
</div>