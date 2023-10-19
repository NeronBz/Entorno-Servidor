<?php
require_once 'Jugador.php';
$ad = new Modelo();

function rellenarSelected($campo, $item, $opcionPorDefecto)
{
    if (isset($_POST[$campo])) {
        if ($_POST[$campo] == $item) {
            echo 'selected = "selected"';
        }
    } elseif ($opcionPorDefecto) {
        echo 'selected = "selected"';
    }
}

function rellenarRadio($campo, $item, $opcionPorDefecto)
{
    if (isset($_POST[$campo])) {
        if ($_POST[$campo] == $item) {
            echo 'checked = "checked"';
        }
    } elseif ($opcionPorDefecto) {
        echo 'checked = "checked"';
    }
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
    <form action="" method="post">
        <fieldset>
            <legend>Nuevo Jugador</legend>
            <div>
                <label>Nº de Jugador</label><br />
                <input type="text" name="nJugador" value="<?php
                                                            echo (isset($_POST['nJugador']) ? $_POST['nJugador'] : '');
                                                            ?>" />
            </div>
            <div>
                <label>Nombre y Apellidos</label><br />
                <input type="text" name="nombre" placeholder="Nombre y Apellidos del Jugador" value="<?php
                                                                                                        echo (isset($_POST['nombre']) ? $_POST['nombre'] : '');
                                                                                                        ?>" />
            </div>
            <div>
                <label for="fecha">Fecha de Nacimiento</label><br>
                <input type="date" name="fechaN" value="<?php echo (isset($_POST['fechaN']) ? $_POST['fechaN'] : ''); ?>" />
            </div>
            <br />
            <div>
                <label>Selecciona Categoría</label><br />
                <select name="categoria">
                    <option <?php rellenarSelected('categoria', 'Benjamin', true); ?>>Benjamin</option>
                    <option <?php rellenarSelected('categoria', 'Alevin', false); ?>>Alevin</option>
                    <option <?php rellenarSelected('categoria', 'Infantil', false); ?>>Infantil</option>
                    <option <?php rellenarSelected('categoria', 'Cadete', false); ?>>Cadete</option>
                    <option <?php rellenarSelected('categoria', 'Junior', false); ?>>Junior</option>
                    <option <?php rellenarSelected('categoria', 'Senior', false); ?>>Senior</option>
                </select>
            </div>
            <div>
                <label>Tipo de Categoría</label><br />
                <input type="radio" name="tipoC" value="Masculina" <?php rellenarRadio('tipoC', 'Masculina', true); ?> />Masculina
                <input type="radio" name="tipoC" value="Femenina" <?php rellenarRadio('tipoC', 'Femenina', false); ?> />Femenina
                <input type="radio" name="tipoC" value="Mixta" <?php rellenarRadio('tipoC', 'Mixta', false); ?> />Mixta
            </div>
            <div>
                <label>Selecciona la/las competiciones</label>
                <br />
                <select name="competi[]" multiple="multiple">
                    <option value="Primera" <?php if (isset($_POST['competi']) && in_array(
                                                'Primera',
                                                $_POST['competi']
                                            )) echo 'checked'; ?>>Primera</option>
                    <option value="Segunda A" <?php if (isset($_POST['competi']) && in_array(
                                                    'Segunda A',
                                                    $_POST['competi']
                                                )) echo 'checked'; ?>>Segunda A</option>
                    <option value="Segunda B" <?php if (isset($_POST['competi']) && in_array(
                                                    'Segunda B',
                                                    $_POST['competi']
                                                )) echo 'checked'; ?>>Segunda B</option>
                    <option value="Tercera" <?php if (isset($_POST['competi']) && in_array(
                                                'Tercera',
                                                $_POST['competi']
                                            )) echo 'checked'; ?>>Tercera</option>
                </select>
            </div>
            <br>
            <div>
                <label>Equipaciones y extras</label><br />
                <input type="checkbox" name="equipaciones[]" value="Entrenamientos" <?php if (isset($_POST['equipaciones']) && in_array(
                                                                                        'Entrenamientos',
                                                                                        $_POST['equipaciones']
                                                                                    )) echo 'checked'; ?> />Entrenamientos(25,00€)<br>
                <input type="checkbox" name="equipaciones[]" value="Partidos" <?php if (isset($_POST['equipaciones']) && in_array(
                                                                                    'Partidos',
                                                                                    $_POST['equipaciones']
                                                                                )) echo 'checked'; ?> />Partidos(25,00€)<br>
                <input type="checkbox" name="equipaciones[]" value="Chandal" <?php if (isset($_POST['equipaciones']) && in_array(
                                                                                    'Chandal',
                                                                                    $_POST['equipaciones']
                                                                                )) echo 'checked'; ?> />Chandal(40,00€)<br>
                <input type="checkbox" name="equipaciones[]" value="Bolso" <?php if (isset($_POST['equipaciones']) && in_array(
                                                                                'Bolso',
                                                                                $_POST['equipaciones']
                                                                            )) echo 'checked'; ?> />Bolso(15,00€)
            </div>
            <br />
            <div>
                <input type="submit" name="enviar" value="Enviar" />
                <input type="reset" name="limpiar" value="Limpiar" />
                <input type="submit" name="ver" value="Ver" />
            </div>
        </fieldset>
    </form>

    <?php
    //Chequeos
    if (isset($_POST['enviar'])) {
        $error = false;
        //Campos vacíos
        if (
            empty($_POST['nJugador']) or empty($_POST['nombre'])  or empty($_POST['fechaN'])
            or empty($_POST['categoria'])  or empty($_POST['tipoC'])  or empty($_POST['competi'])
            or empty($_POST['equipaciones'])
        ) {
            echo '<h3 style="color:red;">Error: Todos los campos tienen que estar rellenos</h3>';
            $error = true;
        }

        //Control de categoría mixta
        if ($_POST['tipoC'] == 'Mixta') {
            if (
                $_POST['categoria'] == 'Infantil' || $_POST['categoria'] == 'Cadete'
                || $_POST['categoria'] == 'Junior' || $_POST['categoria'] == 'Senior'
            ) {
                echo '<h3 style="color:red;">Error: La categoría "Mixta" solo está disponible 
                    para "Benjamín" o "Alevín"</h3>';
                $error = true;
            }
        }

        //Equipación marcada
        $eSeleccionadas = $_POST['equipaciones'];
        if (
            !in_array('Entrenamiento', $eSeleccionadas) || !in_array('Partidos', $eSeleccionadas)
        ) {
            echo '<h3 style="color:red;">Error: Se tiene que marcar al menos una equipación
                    (Entrenamientos ó Partidos)</h3>';
            $error = true;
        }

        //Cálculo del precio
        if (!$error) {
            $importe = 0;
            foreach ($_POST['equipaciones'] as $item) {
                if ($item == 'Entrenamientos') {
                    $importe += 25;
                }
                if ($item == 'Partidos') {
                    $importe += 25;
                }
                if ($item == 'Chandal') {
                    $importe += 40;
                }
                if ($item == 'Bolso') {
                    $importe += 15;
                }
            }

            $j = new Jugador(
                $_POST['nJugador'],
                $_POST['nombre'],
                $_POST['fechaN'],
                $_POST['categoria'],
                $_POST['tipoC'],
                $_POST['competi'],
                $_POST['equipaciones']
            );

            $strCompeti = implode(',', $_POST['competi']);
            $j->setCompeti($strCompeti);

            $strEquipaciones = implode(',', $_POST['equipaciones']);
            $j->setEquipaciones($strEquipaciones);

            if ($ad->crearJugador($j)) {
                echo '<h3 style="color:blue;">Datos correctos. El importe a pagar es de 
                ' . $importe . '€</h3>';
            } else {
                echo '<h3 style="color:red">Error al crear la vivienda</h3>';
            }
        }
    }
    if (isset($_POST['ver'])) {
        $jug = $ad->obtenerJugadores();
    ?>
        <table>
            <tr>
                <td><b>Nº de Jugador</b></td>
                <td><b>Nombre y Apellidos</b></td>
                <td><b>Fecha de Nacimiento</b></td>
                <td><b>Categoría</b></td>
                <td><b>Tipo de categoría</b></td>
                <td><b>Competiciones</b></td>
                <td><b>Equipaciones y extras</b></td>
            </tr>
        <?php
        foreach ($jug as $j) {
            echo '<tr>';
            echo '<td>' . $j->getNJugador() . '</td>';
            echo '<td>' . $j->getNombre() . '</td>';
            echo '<td>' . $j->getFechaN() . '</td>';
            echo '<td>' . $j->getCategoria() . '</td>';
            echo '<td>' . $j->getTipoC() . '</td>';
            echo '<td>' . $j->getCompeti() . '</td>';
            echo '<td>' . $j->getEquipaciones() . '</td>';
        }
    }
        ?>
        </table>
</body>

</html>