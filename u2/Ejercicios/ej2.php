<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $entero = 3;
    $decimal = 2.56;
    $cadena = 'Hola Mundo';
    $boolean = false;
    //Mostrar tipo y su valor
    echo 'La variable $entero es de tipo '.gettype($entero).
    '</b> y su valor es '.$entero+'10';
    echo '<br/>La variable $decimal es de tipo '.gettype($decimal);
    '</b> y su valor es '.$decimal;
    echo '<br/>La variable $cadena es de tipo '.gettype($cadena);
    '</b> y su valor es '.$cadena;
    echo '<br/>La variable $boolean es de tipo '.gettype($boolean);
    '</b> y su valor es '.$boolean;

    ?>
</body>
</html>