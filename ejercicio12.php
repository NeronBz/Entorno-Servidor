<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        tr,
        td {
            border-collapse: collapse;
            border: 1px solid black;
            text-align: left, center;
            padding-top: 7px;
            padding-bottom: 7px;
            padding-right: 30px;
        }

        #tabla {
            border-collapse: collapse;
            border: 1px solid black;
            text-align: center;
        }

        #celda {
            padding: 5px;
        }

        #cd1,
        #cd2 {
            text-align: center;
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php
    $datosPersona = array();
    $datosPersona['double'] = 2345.65;
    $datosPersona['string'] = "Carlos";
    $datosPersona['integer'] = 34;
    $datosPersona['array'] = array(
        'Nombre' => "María",
        'Edad' => 19
    );
    $datosPersona['boolean'] = 'True';
    ?>
    <table>
        <?php
        foreach ($datosPersona as $valor) {

            if (is_array($valor)) {
                echo '<td id="celda">';
                echo '<table id="tabla">';
                foreach ($valor as $indice2 => $valor2) {
                    echo '<tr>';
                    echo '<td id="cd1">' . $indice2 . '</td>';
                    echo '<td id="cd2">' . $valor2 . '</td>';
                    echo '</tr>';
                }
                echo '</td>';
                echo '</table>';
            } else {
                echo '<td>' . $valor . '</td>';
            }
        }
        ?>
    </table>
    <?php
    echo '<br>';
    foreach ($datosPersona as $indice => $var) {
        //Usamos el operador ternario para sabr si tenemos que imprimir el valor si hay un array
        $texto = is_array($var) ? '' : $var;
        echo 'Posición:' . $indice . ' ' . gettype($var) . ' - Valor ' . $texto . '<br>';
        if (is_array($var)) {
            foreach ($var as $ind2 => $var2) {
                echo '=>' . $ind2 . ' ' . $var2 . '<br>';
            }
        }
    }
    ?>
</body>

</html>