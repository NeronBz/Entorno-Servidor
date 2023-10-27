<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    //Iniciar sesión
    session_start();

    if (isset($_POST['cerrar'])) {
        echo '<p>Cerrando sesión.....</p>';
        session_destroy();
        session_start();
    }
    //Comprobar si existen datos de acceso
    if (isset($_SESSION['datosAcceso'])) {
        //Accesos consecutivos
        echo '<h2>Historial de accesos:</h2><ul>';
        //Recuperar el array
        $acceso = $_SESSION['datosAcceso'];
        //Mostrar accesos
        foreach ($acceso as $a) {
            echo '<li>' . $a . '</li>';
        }
    } else {
        //Primer acceso
        echo '<p>Este es el primer acceso. Su SSID es:' . session_id() . '</p>';
    }
    //Guardar acceso actual
    $acceso[] = date('d/m/Y h:i');
    //Guardar array en la sesión
    $_SESSION['datosAcceso'] = $acceso;
    ?>
    <form action="" method="post">
        <button type="submit" name="cerrar">Cerrar Sesión</button>
    </form>

</body>

</html>