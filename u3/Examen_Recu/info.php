<?php
// Login a través de procedimiento almacenado (método)
function login(string $usuario, string $ps)
{
    $resultado = 0;
    try {
        //Ejecutar función almacenada en bd
        $consulta = $this->conexion->prepare('select login(?,?)');
        $params = array($usuario, $ps);
        if ($consulta->execute($params)) {
            if ($fila = $consulta->fetch()) {
                //devolver lo que devuelve la función
                return $fila[0];
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo $usuario, $ps;
    }
    return $resultado;
}
// Login por método
function crearCliente($usuario, $nombre, $ape, $dni, $telef)
    {
        $resultado = false;
        try {
            $this->conexion->beginTransaction();
            $consulta = $this->conexion->prepare("insert into usuario values(?,sha2(?,0),'C')");
            $params = array($usuario, $dni);
            if ($consulta->execute($params)) {
                $resultado = true;
                $consulta = $this->conexion->prepare("insert into cliente 
                    values(null,?,?,?,?,?,false)");
                $params = array($usuario, $dni, $ape, $nombre, $telef);
                if ($consulta->execute($params)) {
                    $resultado = true;
                    $this->conexion->commit();
                } else {
                    $this->conexion->rollBack();
                }
            } else {
                $this->conexion->rollBack();
            }
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        }
        return $resultado;
    }
// Login normal (no método)
if (isset($_POST['acceder'])) {
    if (empty($_POST['usuario']) or empty($_POST['ps'])) {
        //Mostrar error
        $mensaje = 'Error, rellena us y ps';
    } else {
        //Hacer login
        //Recuperar info del usuario
        $usuario = $bd->obtenerUsuario($_POST['usuario'], $_POST['ps']);
        if ($usuario == null) {
            $mensaje = 'Error, no existe usuario';
        } else {
            //Guardar usuario en sesión
            session_start();
            $_SESSION['usuario'] = $usuario;
            if ($usuario->getTipo() == 'A') {
                header('location:crearCliente.php');
            } elseif ($usuario->getTipo() == 'C') {
                $cliente = $bd->obtenerCliente($_POST['usuario']);
                if ($cliente->getBaja() == 1) {
                    $mensaje = 'Este cliente está dado de baja';
                } else {
                    header('location:misActividades.php');
                }
            } else {
                echo 'No funciona';
            }
        }
    }
}
// Foreach
$partidos = $bd->obtenerPartidos();
foreach ($partidos as $p) {
    echo '<option value="' . $p->getCodigo() . '">' . $p->getJugador1() . '-' . $p->getJugador2() . '</option>';
}
// Modificar
function modificarPieza(Pieza $p, string $codigoAntiguo)
{
    $resultado = false;
    try {
        $consulta = $this->conexion->prepare("update pieza set codigo=?, clase=?, descripcion=?, precio=?, stock=? where codigo =?");
        $params = array(
            $p->getCodigo(), $p->getClase(), $p->getDescripcion(),
            $p->getPrecio(), $p->getStock(), $codigoAntiguo
        );
        if ($consulta->execute($params)) {
            if ($consulta->rowCount() == 1) {
                $resultado = true;
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $resultado;
}

// Preguntar
function existenReparacionesPieza(string $codigo)
{
    $resultado = false;
    try {
        $consulta = $this->conexion->prepare("select * from piezareparacion where pieza=?");
        $params = array($codigo);
        if ($consulta->execute($params)) {
            if ($consulta->fetch()) {
                $resultado = true;
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $resultado;
}

// Borrar
function borrarPieza(string $codigo)
{
    $resultado = false;
    try {
        $consulta = $this->conexion->prepare("delete from pieza where codigo=?");
        $params = array($codigo);
        if ($consulta->execute($params)) {
            //Comprobar si se ha borrado al menos 1 registro
            //En ese caso, ponemos resultado=true
            //rowCount devuelve el nº de registros borrados
            if ($consulta->rowCount() == 1) {
                $resultado = true;
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $resultado;
}

// Insertar
function insertarResultadoPartido(ResultadoPartido $rp)
{
    $resultado = false;
    try {
        $consulta = $this->conexion->prepare('insert into resultadopartido values(?,?,?,?)');
        $params = array(
            $rp->getPartido(), $rp->getNumSet(), $rp->getJuegosJ1(), $rp->getJuegosJ2()
        );
        if ($consulta->execute($params)) {
            $resultado = true;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $resultado;
}

$p = $_SESSION['partido'];
$rp = new ResultadoPartido($_SESSION['codPartido'], $_POST['set'], $_POST['juegosJ1'], $_POST['juegosJ2']);
if ($bd->insertarResultadoPartido($rp)) {
    $mensaje = 'Resultado del partido definido';
} else {
    $mensaje = 'Error al guardar resultados';
}

// Obtener
function obtenerPartidos()
{
    $resultado = array();
    try {
        $consulta = $this->conexion->query("select * from partido");
        if ($consulta->execute()) {
            while ($fila = $consulta->fetch()) {
                $partido = new Partido($fila["codigo"], $fila["jugador1"], $fila["jugador2"], $fila["fecha"], $fila["numSets"], $fila['finalizado']);
                $resultado[] = $partido;
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $resultado;
}

function obtenerPartido($id)
{
    $resultado = null;
    try {
        $consulta = $this->conexion->prepare('select * from partido where codigo=?');
        $params = array($id);
        if ($consulta->execute($params)) {
            //Ver si se ha devuelto 1 registro con el usuario
            if ($fila = $consulta->fetch()) {
                //Se ha encontrado el usuario
                $resultado = new Partido($fila["codigo"], $fila["jugador1"], $fila["jugador2"], $fila["fecha"], $fila["numSets"], $fila['finalizado']);
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $resultado;
}
