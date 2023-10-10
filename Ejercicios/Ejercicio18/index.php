<?php
require_once 'modelo.php';
require_once 'Vivienda.php';
$ad = new Modelo();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Estilo para el div del formulario */
        .formulario-div {
            border: 1px solid black;
            /* Agrega un borde al div del formulario */
            text-align: center;
            /* Centra el texto en el div */
            padding: 20px;
            /* Añade un espacio interior al div */
        }

        /* Estilo para la tabla */
        table {
            border: 1px solid black;
            /* Agrega un borde a la tabla */
            width: 50%;
            /* Establece el ancho de la tabla */
            margin: 0 auto;
            /* Centra la tabla horizontalmente */
        }

        /* Estilo para las celdas de la tabla */
        table td {
            border: 1px solid black;
            /* Agrega un borde a las celdas */
            padding: 5px;
            /* Añade un espacio interior a las celdas */
        }
    </style>
</head>

<body>
    <div class="formulario-div">
        <form action="" method="post">
            <label for="tipoV">Selecciona el tipo de vivienda: </label>
            <select name="tipoV">
                <option>Adosado</option>
                <option>Unifamiliar</option>
                <option>Piso</option>
            </select>
            <br>

            <label for="zona">Selecciona la zona: </label>
            <select name="zona">
                <option>Centro</option>
                <option>Periferia</option>
            </select>
            <br>
            <label>Introduce dirección:</label>
            <input type="text" name="direccion">
            <br>

            <label>Selecciona nº de habitaciones: </label>
            <input type="radio" name="nH" checked="checked" value="1">1
            <input type="radio" name="nH" value="2">2
            <input type="radio" name="nH" value="3">3
            <br>

            <label>Introduce precio:</label>
            <input type="text" name="precio">
            <br>

            <label>Introduce tamaño:</label>
            <input type="text" name="tamanio">
            <br>

            <label>Selecciona los extras que necesites: </label>
            <input type="checkbox" name="extra[]" value="Garaje">Garaje
            <input type="checkbox" name="extra[]" value="Trastero">Trastero
            <input type="checkbox" name="extra[]" value="Piscina">Piscina
            <br>

            <label>Observaciones</label>
            <br>
            <textarea name="comentario" cols="30" rows="10"></textarea>
            <br>
            <input type="submit" name="crear" value="Crear Vivienda">
        </form>
    </div>
    <?php
    if (isset($_POST['crear'])) {
        if (empty($_POST['direccion'] or $_POST['precio'] or $_POST['tamanio'])) {
            echo '<h3 style="color:red;">Debes rellenar todos los campos</h3>';
        } else {
            $v = new Vivienda(
                $_POST['tipoV'],
                $_POST['zona'],
                $_POST['direccion'],
                $_POST['nH'],
                $_POST['precio'],
                $_POST['tamanio']
            );

            $strextra = implode(',', $_POST['extra']);
            $v->setExtra($strextra);
            $v->setComentario($_POST['comentario']);

            if ($ad->crearVivienda($v)) {
                echo '<h3 style="color:blue">Vivienda creada</h3>';
            } else {
                echo '<h3 style="color:red">Error al crear la vivienda</h3>';
            }
        }
    }
    $vivi = $ad->obtenerViviendas();
    ?>
    <table>
        <tr>
            <td><b>Tipo de vivienda</b></td>
            <td><b>Zona</b></td>
            <td><b>Dirección</b></td>
            <td><b>Nº de habitaciones</b></td>
            <td><b>Precio</b></td>
            <td><b>Tamaño</b></td>
            <td><b>Extras</b></td>
            <td><b>Observaciones</b></td>
        </tr>
        <?php
        foreach ($vivi as $v) {
            echo '<tr>';
            echo '<td>' . $v->getTipoV() . '</td>';
            echo '<td>' . $v->getZona() . '</td>';
            echo '<td>' . $v->getDireccion() . '</td>';
            echo '<td>' . $v->getNH() . '</td>';
            echo '<td>' . $v->getPrecio() . '</td>';
            echo '<td>' . $v->getTamanio() . '</td>';
            echo '<td>' . $v->getExtra() . '</td>';
            echo '<td>' . $v->getComentario() . '</td>';
        }
        ?>
    </table>
</body>

</html>