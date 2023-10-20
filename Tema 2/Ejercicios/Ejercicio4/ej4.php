<?php
require_once 'Evento.php';

//Ver si está definido el array de eventos en la cookie
if (isset($_COOKIE['cEventos'])) {
    $eventos = unserialize($_COOKIE['cEventos']);
} else {
    //Creamos el array vacío
    $eventos = [];
}
if (isset($_POST['crear'])) {
    $e = new Evento($_POST['fecha'], $_POST['hora'], $_POST['asunto']);
    //Añadimos el evento al array
    $eventos[] = $e;
    //Actualizar/Crear la cookie (fecha caducidad de un mes)
    setcookie('cEventos', serialize($eventos), time() + (30 * 24 * 60 * 60));
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
    <h1>CALENDARIO DE EVENTOS</h1>
    <form action="" method="post">
        <table>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Asunto</th>
                <th>Acción</th>
            </tr>
            <tr>
                <td><input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>"></td>
                <td><input type="time" name="hora" value="<?php echo date('H:i'); ?>"></td>
                <td><input type="text" name="asunto" placeholder="Asunto" required="required"></td>
                <td><input type="submit" name="crear" value="Añadir"></td>
            </tr>
        </table>
    </form>
</body>

</html>