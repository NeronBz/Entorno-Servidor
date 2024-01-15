<?php
session_start();
if (isset($_POST['tirar'])) {
    //Comprobar si hay nombre de jugador
    if (empty($_POST['nombre'])) {
        $mensaje = '<span style="color:red;">*Debes rellenar el nombre del jugador</span>';
    } else {
        //Recuperar los datos si existen de la sesión
        if (isset($_SESSION['jugadores'])) {
            $jugadores = $_SESSION['jugadores'];
        }
        //Generar nº
        $numero = rand(1, 6);
        //Guardar datos en un array
        $jugadores[$_POST['nombre']] = $numero;
        //Guardar en sesión
        $_SESSION['jugadores'] = $jugadores;
    }
} elseif (isset($_POST['borrar'])) {
    session_unset();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <div>
            <label>Nombre del Jugador</label>
            <br>
            <input type="text" name="nombre" placeholder="Nombre Jugador">
            <?php
            if (isset($mensaje)) {
                echo $mensaje;
            }
            ?>
        </div>
        <div>
            <button type="submit" name="tirar">Tirar Dado</button>
        </div>
        <?php
        //Mostrar tiradas
        if (isset($_SESSION['jugadores']))
            foreach ($_SESSION['jugadores'] as $clave => $valor) {
                echo '<li>' . $clave . "=>" . $valor . '</li>';
            }
        ?>

    </form>

    <div>
        <form action="" method="post">
            <button type="submit" name="borrar">Borrar Jugadores</button>
        </form>
    </div>
</body>

</html>