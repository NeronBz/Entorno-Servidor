<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <h1>Reserva de vuelo</h1>
        <div>
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php
                                                    if (isset($_POST['nombre'])) {
                                                        echo $_POST['nombre'];
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>" />
        </div>
        <div>
            <label>Nº de acompañantes</label>
            <input type="number" name="numAcom" value="<?php
                                                        if (isset($_POST['numAcom'])) {
                                                            echo $_POST['numAcom'];
                                                        } else {
                                                            echo '';
                                                        }
                                                        ?>" />
        </div>
        <button type="submit" name="rellenar" value="rellenar">Rellenar Datos Acompañantes</button>
        <br>
        <?php
        echo '<br>';
        //Pintar formulario de nombres de acompañantes si se ha pulsado en rellenar
        if (isset($_POST['rellenar']) or isset($_POST['mostrar'])) {
            for ($i = 1; $i <= $_POST['numAcom']; $i++) {
                echo '<div>';
                echo '<label>Nombre de acompañante ' . $i . ' </label>';
                //Rellenar una variable con el nombre del acompañante si se ha escrito
                if (isset($_POST['nombres'][$i - 1])) {
                    $texto = $_POST['nombres'][$i - 1];
                } else {
                    $texto = '';
                }
                echo '<input name="nombres[]" 
                value="' . $texto . '"/>';
                echo '</div>';
            }
        ?>
            <input type="submit" name="mostrar" value="Mostrar" />
        <?php
        }
        ?>
    </form>
    <?php
    if (isset($_POST['mostrar'])) {
    ?>
        <table border="1">
            <tr>
                <th>Persona principal</th>
                <?php
                for ($i = 1; $i <= $_POST['numAcom']; $i++) {
                    echo '<th>Acompañante' . $i . '</th>';
                }
                ?>
            </tr>
            <tr>
                <td><?php echo $_POST['nombre'] ?></td>
                <?php
                for ($i = 1; $i <= $_POST['numAcom']; $i++) {
                    if (isset($_POST['nombres'][$i - 1])) {
                        echo '<td>' . $_POST['nombres'][$i - 1] . '</td>';
                    } else {
                        echo '<td></td>';
                    }
                }
                ?>
            </tr>
        </table>
    <?php
    }
    ?>
</body>

</html>