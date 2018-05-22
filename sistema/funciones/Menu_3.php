<?php
function MenuBas() {

    echo '<li><a href = "index.php">Descripción</a></li>';
    echo '<li class = "dropdown">';    
    echo '<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-expanded = "false">Registro<span class = "caret"></span></a>';
    echo '<ul class = "dropdown-menu" role = "menu">';
    echo '<li><a href = "Registro.php">Appis</a></li>';
    echo '</ul>';
    echo '<li class = "dropdown">'; 
    echo '<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-expanded = "false">Ingreso<span class = "caret"></span></a>';
    echo '<ul class = "dropdown-menu" role = "menu">';   
    echo '<li><a href = "IniciarSesion.php">Appis</a></li>';
    echo '</ul>';
    echo '<li><a href = "Contacto.php">Contacto</a></li>';
    echo '<li><a href = "Organizacion.php">Organización</a></li>';
}
function Menu($idperfil = null) {
    echo '<li class = "dropdown">';
    if (($idperfil == 1) || ($idperfil == 4)) {
    echo '<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-expanded = "false">Administración <span class = "caret"></span></a>';
    echo '<ul class = "dropdown-menu" role = "menu">';
    echo '<li><a href = "municipios.php">Municipios</a></li>';
    echo '<li><a href = "ubicaciones.php">Fincas</a></li>';
    echo '<li><a href = "lotes.php">Lotes</a></li>';
    echo '<li class = "divider"></li>';
    echo '<li><a href = "razas.php">Razas</a></li>';
    echo '<li><a href = "tiposAnimal.php">Tipo Animal</a></li>';
    echo '<li class = "divider"></li>';
    echo '<li><a href = "tipoTerceros.php">Tipos Tercero</a></li>';
    echo '<li><a href = "terceros.php">Terceros</a></li>';
    echo '<li><a href = "usuarios.php">Usuarios</a></li>';
    echo '</ul>';
    echo '</li>';
    }
    echo '<li><a href = "animales.php">Animales</a></li>';
    echo '<li><a href = "novedades.php">Novedades</a></li>';
    echo '<li><a href = "genealogia.php">Genealogia</a></li>';
    echo '<li><a href = "informes.php?Ancho=\"+screen.width">Informes</a></li>';
    if ($idperfil == 4) {
       echo '<li><a href = "infResumen.php">Resumen</a></li>';   
    }
}

function MenuUsuario() {
    $root = realpath($_SERVER["SERVER_NAME"]);
    $AppName = "agroIT"; // "/" . $AppName . 
    return
            "<li class=\"dropdown\">
        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">" . $_SESSION['usuario'] . "<span class=\"caret\"></span></a>
            <ul class=\"dropdown-menu\" role=\"menu\">
                <li><a href=../LogOut.php>Cerrar Sesión</a></li>
            <ul>
    </li>";
}