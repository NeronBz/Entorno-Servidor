<?php
require_once 'Alumno.php';
require_once 'Correccion.php';
require_once 'Modalidad.php';
require_once 'Prueba.php';
class Modelo
{
    private $url = "mysql:host=localhost;port=3306;dbname=skills";
    private $us = "root";
    private $ps = "";
    private $conexion = null;

    function __construct()
    {
        try {
            $this->conexion = new PDO($this->url, $this->us, $this->ps);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function aumentarPuntaje(Alumno $a, $cod)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("update alumno set puntuacion=puntuacion+? where id =?");
            $params = array($a->getPuntuacion(), $cod);
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

    function crearCorreccion(Correccion $c)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare('insert into correccion values(?,?,?,?)');
            $params = array(
                $c->getAlumno(), $c->getPrueba(), $c->getPuntos(), $c->getComentario()
            );
            if ($consulta->execute($params)) {
                $resultado = true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function existeCorreccion($alumno, $prueba)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("select * from correccion where alumno = ? and prueba = ?");
            $params = array($alumno, $prueba);
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

    function obtenerPrueba($codigo)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare("select * from prueba where id = ?");
            $params = array($codigo);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Prueba($fila['id'], $fila['modalidad'], $fila['fecha'], $fila['descripcion'], $fila['puntuacion']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerPruebas($mod)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare("select * from prueba where modalidad = ?");
            $params = array($mod);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Prueba($fila['id'], $fila['modalidad'], $fila['fecha'], $fila['descripcion'], $fila['puntuacion']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerAlumno($codigo, $mod)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare("select * from alumno where id = ? and modalidad = ?");
            $params = array($codigo, $mod);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Alumno($fila['id'], $fila['nombre'], $fila['modalidad'], $fila['puntuacion'], $fila['finalizado']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerAlumnos($mod)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare("select * from alumno where modalidad = ?");
            $params = array($mod);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Alumno($fila['id'], $fila['nombre'], $fila['modalidad'], $fila['puntuacion'], $fila['finalizado']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerModalidad($codigo)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare("select * from modalidad where id = ?");
            $params = array($codigo);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Modalidad($fila['id'], $fila['modalidad']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerModalidades()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query("select * from modalidad");
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Modalidad($fila['id'], $fila['modalidad']);
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
