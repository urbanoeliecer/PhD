<div class="container">
<h1>SARA - Videojuego serio para el aprendizaje agrícola</h1>
</div>  
<div class="container">
<div class="row">
<div class="col-md-3">
Videojuego de sistemas de producción agrícola, buscando un proceso óptimo con el manejo de recursos.
<!--<div align="center"><img src="img/logoUPB.png" class="img-responsive"></div>-->
<br><b>Elaborado por:</b><br>Intelec - UPB B/manga<br>Urbano Eliécer Gómez Prada<br>

<form class="form-signin" method="POST" action="LogIn.php">
<?php
if (isset($_SESSION["usuario"])){
// ir a cabecera
}
else {
    ?>
    <h3>Iniciar Sesión:</h3>
    <table>
    <tr><td>Usuario:<td><input type="text" placeholder="Usuario" name="usuario" size="8" required autofocus>
    <tr><td>Password:<td><input type="password"  name="password" size="8"  placeholder="Contraseña" required>
    <tr><td colspan="2"><input type="submit" value="Enviar" class="btn btn-primary" >
    </table>
<?php
}
?> 
</form> 
</div>