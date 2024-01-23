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

    function obtenerJugadoresPartido($j1, $j2)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare("select count(*) as jugados from partido where finalizado=true 
            and (jugador1 = ? or jugador2 = ?)");
            $params = array($j1, $j2);
            if ($consulta->execute($params)) {
                //Ver si se ha devuelto 1 registro con el usuario
                if ($fila = $consulta->fetch()) {
                    //Se ha encontrado el usuario
                    $resultado = new Partido($fila["codigo"], $fila["jugador1"], $fila["jugador2"], $fila["fecha"], $fila["numSets"], false);
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
                    $partido = new Partido($fila["codigo"], $fila["jugador1"], $fila["jugador2"], $fila["fecha"], $fila["numSets"], false);
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
                    $resultado = new Partido($fila["codigo"], $fila["jugador1"], $fila["jugador2"], $fila["fecha"], $fila["numSets"], false);
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
