<?php
//Comprobamos di hay que guardar o borrar la cookie
if (isset($_POST['guardar'])) {
    //Caducidad de un día
    setcookie('colorF', $_POST['colorF'], time() + (24 * 60 * 60));
    setcookie('colorT', $_POST['colorT'], time() + (24 * 60 * 60));
    header('location:Ejercicio_2.php');
}
if (isset($_POST['borrar'])) {
    //Caducidad en el pasado
    setcookie('colorF', '', time() - 1);
    setcookie('colorT', '', time() - 1);
    header('location:Ejercicio_2.php');
}
$colorF = "#FFFFFF";
$colorT = "#000000";
//Ver si están definidos los colores en la cookie
if (isset($_COOKIE['colorF'])) {
    $colorF = $_COOKIE['colorF'];
}
if (isset($_COOKIE['colorT'])) {
    $colorT = $_COOKIE['colorT'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: <?php echo $colorF; ?>;
            color: <?php echo $colorT; ?>;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <div>
            <label for="">Color de fondo</label>
            <input type="color" name="colorF" value="<?php echo $colorF; ?>">
        </div>
        <div>
            <label for="">Color de texto</label>
            <input type="color" name="colorT" value="<?php echo $colorT; ?>">
        </div>
        <div>
            <input type="submit" name="guardar" value="Guardar preferencias">
            <input type="submit" name="borrar" value="Borrar preferencias">
        </div>
    </form>
</body>

</html>