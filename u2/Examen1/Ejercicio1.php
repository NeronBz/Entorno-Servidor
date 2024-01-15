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
                <input type="number" name="nJugador" />
            </div>
            <div>
                <label>Nombre y Apellidos</label><br />
                <input type="text" name="nombre" placeholder="Nombre y Apellidos del Jugador" />
            </div>
            <div>
                <label for="fecha">Fecha de Nacimiento</label><br>
                <input type="date" name="fechaN" />
            </div>
            <br />
            <div>
                <label>Selecciona Categoría</label><br />
                <select name="categoria">
                    <option>Benjamin</option>
                    <option>Alevin</option>
                    <option>Infantil</option>
                    <option>Cadete</option>
                    <option>Junior</option>
                    <option>Senior</option>
                </select>
            </div>
            <div>
                <label>Tipo de Categoría</label><br />
                <input type="radio" name="tipoC" value="Masculina" checked="checked" />Masculina
                <input type="radio" name="tipoC" value="Femenina" />Femenina
                <input type="radio" name="tipoC" value="Mixta" />Mixta
            </div>
            <div>
                <label>Selecciona la/las competiciones</label>
                <br />
                <select name="competi[]" multiple="multiple">
                    <option value="Primera">Primera</option>
                    <option value="Segunda A">Segunda A</option>
                    <option value="Segunda B">Segunda B</option>
                    <option value="Tercera">Tercera</option>
                </select>
            </div>
            <br>
            <div>
                <label>Equipaciones y extras</label><br />
                <input type="checkbox" name="equipaciones[]" value="Entrenamientos" checked="checked" />Entrenamientos(25,00€) <br>
                <input type="checkbox" name="equipaciones[]" value="Partidos" />Partidos(25,00€)<br>
                <input type="checkbox" name="equipaciones[]" value="Chandal" />Chandal(40,00€)<br>
                <input type="checkbox" name="equipaciones[]" value="Bolso" />Bolso(15,00€)
            </div>
            <br />
            <div>
                <input type="submit" name="enviar" value="Enviar" />
                <input type="reset" name="limpiar" value="Limpiar" />
            </div>
        </fieldset>
    </form>

    <?php
    //Chequeos
    if (isset($_POST['enviar'])) {
        //Campos vacíos
        if (
            empty($_POST['nJugador']) or empty($_POST['nombre'])  or empty($_POST['fechaN'])
            or empty($_POST['categoria'])  or !isset($_POST['tipoC'])  or !isset($_POST['competi'])
            or !isset($_POST['equipaciones'])
        ) {
            echo '<h3 style="color:red;">Error: Todos los campos tienen que estar rellenos</h3>';
        } else {
            //Control de categoría mixta
            if ($_POST['tipoC'] == 'Mixta' and $_POST['categoria'] != 'Benjamin' and $_POST['categoria'] != 'Alevin') {
                echo '<h3 style="color:red;">Error: La categoría "Mixta" solo está disponible 
                    para "Benjamín" o "Alevín"</h3>';
            } else {
                //Equipación marcada
                foreach ($_POST['equipaciones'] as $e) {
                    if ($e == 'Entrenamientos' or $e == 'Partidos') {
                        $error = false;
                        break;
                    } else {
                        $error = true;
                    }
                }
                if ($error) {
                    echo '<h3 style="color:red;">Error: Se tiene que marcar al menos una equipación
                        (Entrenamientos ó Partidos)</h3>';
                }

                if (!isset($error) or $error == false) {
                    //Precio
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

                    echo '<h3 style="color:blue;">Datos correctos. El importe a pagar es de 
                        ' . $importe . '€</h3>';
                }
            }
        }
    }
    ?>
</body>

</html>