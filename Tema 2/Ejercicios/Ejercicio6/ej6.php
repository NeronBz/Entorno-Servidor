<?php
if (isset($_POST['tirar'])) {
    //Comprobar si hay nombre de jugador
    if (!empty($_POST['nombre'])) {
        $mensaje = '<h2 style="color:red;">Debes rellenar el nombre del jugador</h2>';
    }
} elseif (isset($_POST['borrar'])) {
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
            <input type="text" name="nombre" placeholder="Nombre Jugador" required="required">
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
        ?>

    </form>

    <div>
        <form action="" method="post">
            <button type="submit" name="borrar">Borrar Jugadores</button>
        </form>
    </div>
</body>

</html>