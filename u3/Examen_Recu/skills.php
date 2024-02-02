<?php
require_once 'Modelo.php';

$bd = new Modelo();
if ($bd->getConexion() == null) {
    $mensaje = "Error, no hay conexión con la bd";
} else {
    session_start();
    if (isset($_POST['modalidad'])) {
        $modalidad = $bd->obtenerModalidad($_POST['modalidad']);
        $_SESSION['modalidad'] = $modalidad;
    }
    if (isset($_POST['alumno'])) {
        $alumno = $bd->obtenerAlumno($_POST['alumno'], $_SESSION['modalidad']->getId());
        $_SESSION['alumno'] = $alumno;
    }
    if (isset($_POST['cambiarM'])) {
        session_unset();
        header('location:skills.php');
    }
    if (isset($_POST['cambiarA'])) {
        unset($_SESSION['alumno']);
        header('location:skills.php');
    }
    if (isset($_POST['guardar'])) {
        $prueba = $bd->obtenerPrueba($_POST['prueba']);
        if ($_POST['puntos'] > $prueba->getPuntuacion()) {
            $mensaje = "Error, el puntaje es mayor que el máximo de puntos previsto";
        } else {
            $existeCorreccion = $bd->existeCorreccion($_SESSION['alumno']->getId(), $prueba->getId());
            if ($existeCorreccion) {
                $mensaje = "Ya se ha corregido esta prueba";
            } else {
                $correccion = new Correccion($_SESSION['alumno']->getId(), $prueba->getId(), $_POST['puntos'], $_POST['comentario']);
                if ($bd->crearCorreccion($correccion)) {
                    $mensaje = "Corrección hecha";
                    $puntaje = $bd->aumentarPuntaje($_SESSION['alumno'], $_SESSION['alumno']->getId());
                } else {
                    $mensaje = "Error al hacer la corrección";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Recuperación</title>
</head>

<body>
    <div>
        <h1 style='color:red;'><?php if (isset($mensaje)) echo $mensaje ?></h1>
    </div>
    <form action="skills.php" method="post">
        <?php

        if (!isset($_SESSION['modalidad'])) {
        ?>
            <div>
                <h1 style='color:blue;'>Modalidad</h1>
                <label for="tienda">Modalidad</label><br />

                <select name="modalidad">
                    <?php
                    $modalidades = $bd->obtenerModalidades();
                    foreach ($modalidades as $m) {
                        echo '<option value="' . $m->getId() . '">' . $m->getModalidad() . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="selModalidad">Seleccionar Modalidad</button>
            </div>
        <?php
        } elseif (!isset($_SESSION['alumno']) && isset($_SESSION['modalidad'])) {
        ?>
            <div>
                <h1 style='color:blue;'>Alumno</h1>
                <?php
                ?>
                <label for="tienda">Alumno</label><br />
                <select name="alumno">
                    <?php
                    $alumnos = $bd->obtenerAlumnos($_SESSION['modalidad']->getId());
                    foreach ($alumnos as $a) {
                        echo '<option value="' . $a->getId() . '">' . $a->getNombre() . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="selAlumno">Seleccionar Alumno</button>
            </div>
        <?php
        } elseif (isset($_SESSION['alumno'])) {
        ?>
            <div>
                <h1 style='color:blue;'>Corrección</h1>
                <h2 style='color:green;'>
                    <?php
                    $mod = $_SESSION['modalidad'];
                    $alum = $_SESSION['alumno'];
                    echo $mod->getModalidad();
                    echo ' - ';
                    echo $alum->getNombre();
                    echo ' - Nota: ';
                    echo $alum->getPuntuacion();
                    if ($alum->getFinalizado() == false) {
                        echo ' (Provisional)';
                    } else {
                        echo ' (Definitiva)';
                    }
                    ?>

                    <button type="submit" name="cambiarM">Cambiar Modalidad</button>
                    <button type="submit" name="cambiarA">Cambiar Alumno</button>
                </h2>
                <table>
                    <tr>
                        <td><label for="prueba">Prueba</label><br /></td>
                        <td><label for="puntos">Puntos</label><br /></td>
                        <td><label for="comentario">Comentario</label></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <select id="prueba" name="prueba">
                                <?php
                                $pruebas = $bd->obtenerPruebas($_SESSION['modalidad']->getId());
                                foreach ($pruebas as $p) {
                                    echo '<option value="' . $p->getId() . '">' . $p->getDescripcion() . ' - ' . $p->getPuntuacion() . ' puntos' . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td><input id="puntos" type="number" name="puntos" value="1" /></td>
                        <td><input id="comentario" type="text" name="comentario" placeholder="Comentario" /></td>
                        <td><button type="submit" name="guardar">Guardar</button></td>
                    </tr>
                </table>
            </div>
            <div>
                <h1 style='color:blue;'>Calificaciones del alumno</h1>
                <table border="1" rules="all" width="50%">
                    <tr>
                        <td><b>Prueba</b></td>
                        <td><b>Puntos Asignados</b></td>
                        <td><b>Puntos Obtenidos</b></td>
                        <td><b>Comentario</b></td>
                    </tr>

                </table>
                <button type="submit" name="finalizar">Finalizar Corrección</button>
            </div>
        <?php
        }
        ?>
    </form>
</body>

</html>