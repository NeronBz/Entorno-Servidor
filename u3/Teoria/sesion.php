<?php
echo '<h2>No se ha iniciado sesión</h2>';
//Mostrar el id y el nombre de la sesión sin haber iniciado la sesión:
echo "<h3>Id Sesión: " . session_id() . "</h3>";
echo "<h3>Nombre Sesión:" . session_name() . "</h3>";
if (isset($_SESSION['usuario'])) {
    echo '<p>Existe variable usuario en sesión con valor:' . $_SESSION['usuario'] . '</p>';
} else {
    echo '<p>No existe variable usuario en sesión</p>';
}

//Iniciar sesión
session_start();
//Mostrar el id y el nombre de la sesión con las sesión inicida:
echo "<h3>Id Sesión: " . session_id() . "</h3>";
echo "<h3>Nombre Sesión:" . session_name() . "</h3>";
echo '<h3>Valor de $_COOKIE["nombreSesión"]:' . $_COOKIE[session_name()] . '</h3>';
if (isset($_SESSION['usuario'])) {
    echo '<p>Existe variable usuario en sesión con valor:' . $_SESSION['usuario'] . '</p>';
} else {
    echo '<p>No existe variable usuario en sesión</p>';
}

//Guardar variable usuario en la sesión
$_SESSION['usuario'] = 'raul';
if (isset($_SESSION['usuario'])) {
    echo '<p>Existe variable usuario en sesión con valor:' . $_SESSION['usuario'] . '</p>';
} else {
    echo '<p>No existe variable usuario en sesión</p>';
}

//Destruir sesión
echo '<h3>Destruir sesión pero no variables de sesión</h3>';
session_destroy();
echo "<h3>Id Sesión: " . session_id() . "</h3>";
if (isset($_SESSION['usuario'])) {
    echo '<p>Existe variable usuario en sesión con valor:' . $_SESSION['usuario'] . '</p>';
} else {
    echo '<p>No existe variable usuario en sesión</p>';
}
echo '<h3>Destruir variables de sesión</h3>';
session_unset();
//Cargamos de nuevo la sesión
session_start();
if (isset($_SESSION['usuario'])) {
    echo '<p>Existe variable usuario en sesión con valor:' . $_SESSION['usuario'] . '</p>';
} else {
    echo '<p>No existe variable usuario en sesión</p>';
}
