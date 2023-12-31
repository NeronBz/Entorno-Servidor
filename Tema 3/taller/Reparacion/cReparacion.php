<?php
require_once '../modelo.php';
$bd = new Modelo();
if ($bd->getConexion() == null) {
    $mensaje = array('e', 'Error, no hay conexión con la bd');
} else {
    //Chequear el perfil del usuario
    session_start();
    if (isset($_SESSION['usuario']) and ($_SESSION['usuario']->getPerfil() == 'C')) {
        header('location:../Usuario/login.php');
    }
    if (!isset($_SESSION['reparacion'])) {
        header('location:../vehiculo/cVehiculo.php');
    }
    //Botón Crear
    if (isset($_POST['crearPR'])) {
        //crear Pieza en reparación
        //Chequear que estén rellenos la pieza y la cantidad y que no sean negativas
        if (empty($_POST['pieza']) or empty($_POST['cantidad']) or $_POST['cantidad'] < 1) {
            $mensaje = array("e", "Error, hay que rellenar todos los datos y la cantidad debe ser +");
        } else {
            //Chequear que haya stock
            $pieza = $bd->obtenerPieza($_POST['pieza']);
            if ($pieza->getStock() < $_POST['cantidad']) {
                $mensaje = array("e", "Error, No hay stock suficiente");
            } else {
                //Si la pieza ya se ha usado en esa reparación
                //hay que hacer un update e incrementar la cantidad
                //Si no se ha usado, hay que hacer un insertar
                $pr = $bd->obtenerPiezaReparacion($_SESSION['reparacion'], $pieza->getCodigo());
                if ($pr == null) {
                    //Insert
                    if ($bd->insertarPR($_SESSION['reparacion'], $pieza, $_POST['cantidad'])) {
                        $mensaje = array("i", "Pieza insertada");
                    } else {
                        $mensaje = array("e", "Error al insertar la pieza");
                    }
                } else {
                    //Update
                    if ($bd->modificarPR($_SESSION['reparacion'], $pieza, $_POST['cantidad'])) {
                        $mensaje = array("i", "Pieza modificada");
                    } else {
                        $mensaje = array("e", "Error al modificar la pieza");
                    }
                }
            }
        }
    } elseif (isset($_POST['update'])) {
        //Modificar pieza en reparación
        //Obtener pieza a modificar
        $pr = $bd->obtenerPiezaReparacion($_SESSION['reparacion'], $_POST['update']);
        if ($pr != null) {
            if ($bd->modificarCantidad($pr, $_POST['cantidad'])) {
                $mensaje = array('i', 'Pieza modificada');
            }
        } else {
            $mensaje = array('e', 'Error, no existe la pieza en la reparación');
        }
    } elseif (isset($_POST['borrar'])) {
        //Chequear que la pieza exista
        $pr = $bd->obtenerPiezaReparacion($_SESSION['reparacion'], $_POST['borrar']);
        if ($pr != null) {
            //Borrar la pieza
            if ($bd->borrarPiezaReparacion($pieza->getCodigo())) {
                $mensaje = array('i', 'Pieza borrada');
            } else {
                $mensaje = array('e', 'Se ha producido un error al borrar la pieza');
            }
        } else {
            $mensaje = array('e', 'Error, la pieza no existe');
        }
    }
    //Cerrar sesión
    session_write_close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Taller - Gestión de Reparación</title>
</head>

<body>
    <header>
        <?php
        require_once '../menu.php';
        ?>
        <h3 style="text-align: center;">GESTIÓN DE REPARACIÓN</h3>
    </header>
    <section>
        <!-- Datos de la reparación -->
        <?php
        $r = $bd->obtenerReparacion($_SESSION['reparacion']);
        include_once 'infoReparacion.php' ?>
    </section>
    <section>
        <!-- Crear Vehículo -->
        <?php include_once 'crearPiezaR.php' ?>
    </section>
    <section>

        <!-- Comunicar mensajes -->
        <?php include_once '../verMensaje.php' ?>
    </section>
    <section>
        <!-- Seleccionar y visualizar datos de vehiculo -->
        <?php include_once 'datosPiezas.php' ?>
    </section>
    <footer>

    </footer>
</body>

</html>