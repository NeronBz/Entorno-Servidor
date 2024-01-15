<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 11</title>
</head>

<body>
    <?php
    $array = array();

    for ($i = 0; $i < 10; $i++) {
        $array[$i] = $i ** 2;
    }

    foreach ($array as $x => $numeros) {
        echo 'x=' . $x . ' y=' . $numeros . '<br>';
    }
    ?>
</body>

</html>