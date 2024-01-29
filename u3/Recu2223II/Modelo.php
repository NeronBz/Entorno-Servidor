<?php
require_once 'Jugador.php';
require_once 'Partido.php';
require_once 'ResultadoPartido.php';
class Modelo
{
    private string $url = 'mysql:host=localhost;port=3306;dbname=tenis';
    private string $us = 'root';
    private string $ps = '';

    private $conexion = null;

    function __construct()
    {
        try {
            $this->conexion = new PDO($this->url, $this->us, $this->ps);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

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

    function obtenerResultadoPartido($id)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('select * from resultadopartido where partido=?');
            $params = array($id);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado[] = new ResultadoPartido($fila["partido"], $fila["numSet"], $fila["juegosJ1"], $fila["juegosJ2"]);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function calcularJugados($jugados)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare("SELECT COUNT(*) as jugados FROM partido WHERE finalizado = true AND (jugador1 = ? OR jugador2 = ?)");
            $params = array($jugados, $jugados);

            if ($consulta->execute($params)) {
                $fila = $consulta->fetch();
                if ($fila) {
                    $resultado = $fila['jugados'];
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerJugadorPartido($j1)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare("select * from jugador where nombre=?");
            $params = array($j1);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Jugador($fila["nombre"], $fila["ganados"]);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

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

    /**
     * Get the value of conexion
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     *
     * @return  self
     */
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }
}
