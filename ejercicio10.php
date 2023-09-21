<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dos arrays</title>
</head>

<body>
    <?php
    $array1 = array('Cougar', 'Ford', '', 2500, 'v6', 182);
    echo "$ array1: Array Escalar - Número de elementos " . sizeof($array1);
    ?>
    <table border="1">
        <tr>
            <?php
            foreach ($array1 as $indice => $valor) {
                echo '<td>' . $indice . '</br>' . $valor . '</td>';
            }
            ?>
        </tr>
    </table>
    </br>
    <?php
    $array2 = array('Modelo' => 'Couger', 'Marca' => 'Ford', 'Fecha' => '', 'CC' => 2500, 'Motor' => 'v6', 'Potencia' => 182);
    echo "$ array2: Array Asociativo - Número de elementos " . sizeof($array2);
    ?>
    <table border="1">
        <tr>
            <?php
            foreach ($array2 as $indice => $valor) {
                echo '<td>' . $indice . '</br>' . $valor . '</td>';
            }
            ?>
        </tr>
    </table>
</body>

</html>