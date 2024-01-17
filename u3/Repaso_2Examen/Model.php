<?php
require_once 'Producto.php';
require_once 'ProductoEnCesta.php';
require_once 'Tienda.php';
class Model
{
    private string $url = 'mysql:host=localhost;port=3306;dbname=mcdaw';
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

    function obtenerTiendas()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query("select * from tienda");
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $tienda = new Tienda($fila["codigo"], $fila["nombre"], $fila["telefono"]);
                    $resultado[] = $tienda;
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
