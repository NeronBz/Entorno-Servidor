<?php
require_once 'Empleado.php';
class Modelo
{
    private string $url = 'mysql:host=localhost;port:3306;dbname=mensajes';
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

    function obtenerEmpleado(int $usuario)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from empleado where idEmp=?');
            $params = array($usuario);
            if ($consulta->execute()) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Empleado(
                        $fila['idEmp'],
                        $fila['dni'],
                        $fila['nombreEmp'],
                        $fila['fechaNac'],
                        $fila['departamento'],
                        $fila['cambiarPs']
                    );
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
     */
    public function setConexion($conexion): self
    {
        $this->conexion = $conexion;

        return $this;
    }
}
