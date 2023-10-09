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
</head>

<body>
    <div>
        <form action="" method="post">
            <label for="tipoV">Selecciona el tipo de vivienda: </label>
            <select name="tipoV">
                <option value="1">Adosado</option>
                <option value="2">Unifamiliar</option>
                <option value="3">Piso</option>
            </select>
            <br>

            <label for="zona">Selecciona la zona: </label>
            <select name="zona">
                <option value="1">Centro</option>
                <option value="2">Periferia</option>
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
            <input type="checkbox" name="extra">Garaje
            <input type="checkbox" name="extra">Trastero
            <input type="checkbox" name="extra">Piscina
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
            $v = new Vivienda($_POST['tipoV'], $_POST['zona'], $_POST['direccion'], $_POST['nH'], $_POST['precio'], $_POST['tamanio'], $_POST['extra'], $_POST['comentario']);
            if ($ad->crearVivienda($v)) {
                echo '<h3 style="color:blue">Vivienda creada</h3>';
            } else {
                echo '<h3 style="color:red">Error al crear la vivienda</h3>';
            }
        }
    }
    ?>
</body>

</html>