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
            <label>Nº Alumnos</label>
            <input type="text" name="numero" value="<?php
                                                    if (isset($_POST['numero'])) {
                                                        echo $_POST['numero'];
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>" />
            <br>
            <br>
            <button type="submit" name="crear" value="Crear">Crear</button>
            <?php
            if (isset($_POST['crear']) or isset($_POST['mostrar'])) {
                for ($i = 1; $i <= $_POST['numero']; $i++) {
                    echo '<div>';
                    echo '<label>Alumno ' . $i . '<label>';
                    if (isset($_POST['nombres'][$i - 1])) {
                        $texto = $_POST['nombres'][$i - 1];
                    } else {
                        $texto = '';
                    }
                    echo '<input name="nombres[]"
                    value="' . $texto . '"/>';
                    echo '</div>';
                }
            }
            ?>

        </div>
    </form>
</body>

</html>