<?php
require_once 'Producto.php';
require_once 'ProductoEnCesta.php';
require_once 'Tienda.php';

class Modelo
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

    function mensaje(){
        
    }

    function obtenerProductosyPrecio()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query('select * from producto order by nombre');
            while ($fila = $consulta->fetch()) {
                $resultado[] = new Producto($fila['codigo'], $fila['nombre'], $fila['precio']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerTiendas()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query('select * from tienda order by nombre');
            while ($fila = $consulta->fetch()) {
                $resultado[] = new Tienda($fila['codigo'], $fila['nombre'], $fila['telefono']);
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
