<?php
require_once '../Pieza/Pieza.php';
class Modelo
{
    private $conexion;

    const URL = 'mysql:host=127.0.0.1;port=3307;dbname=taller';
    const USUARIO = 'root';
    const PS = 'root';
    function __construct()
    {
        try {
            //Establecer conexión con la BD
            $this->conexion = new PDO(Modelo::URL, Modelo::USUARIO, Modelo::PS);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function insertarPieza(Pieza $p)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare('insert into pieza values(?,?,?,?,?)');
            $params = array(
                $p->getCodigo(), $p->getClase(), $p->getDescripcion(),
                $p->getPrecio(), $p->getStock()
            );
            if ($consulta->execute($params)) {
                $resultado = true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerPieza($codigo)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('select * from pieza where codigo = ?');
            $params = array($codigo);
            if ($consulta->execute($params)) {
                //Recuperar el registro y crear un objeto Pieza en resultado
                if ($fila = $consulta->fetch()) {
                    $resultado = new Pieza();
                    $resultado->setCodigo($fila['codigo']);
                    $resultado->setClase($fila['clase']);
                    $resultado->setDescripcion($fila['descripcion']);
                    $resultado->setPrecio($fila['precio']);
                    $resultado->setStock($fila['stock']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerPiezas()
    {
        //Devuelve un array de objetos Pieza
        $resultado = array();
        try {
            //Ejecutamos consulta
            $datos = $this->conexion->query('select * from pieza order by codigo');
            if ($datos !== false) {
                //Recorrer los datos para crear objetos Pieza
                while ($fila = $datos->fetch()) {
                    //Creamos Pieza
                    $p = new Pieza();
                    $p->setCodigo($fila['codigo']);
                    $p->setClase($fila['clase']);
                    $p->setDescripcion($fila['descripcion']);
                    $p->setPrecio($fila['precio']);
                    $p->setStock($fila['stock']);
                    //Añadir pieza al array resultado
                    $resultado[] = $p;
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
