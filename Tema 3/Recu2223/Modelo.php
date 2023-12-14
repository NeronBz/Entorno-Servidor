<?php
require_once 'Usuario.php';
require_once 'Cliente.php';
require_once 'Actividad.php';

class Modelo
{
    private string $url = 'mysql:host=localhost;port=3306;dbname=gimnasio';
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

    public function crearCliente($usuario, $nombre, $ape, $dni, $telef)
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

    public function existeUsuario($us, $dni)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare("select * from usuario
                where usuario = ? or dni=?");
            $params = array($us, $dni);
            $consulta->execute($params);
            if ($fila = $consulta->fetch()) {
                $resultado = true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function darDeBaja($idC, $idA)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("DELETE from participa where actividad_id=? and cliente_id = ? ");
            $params = array($idA, $idC);
            if ($consulta->execute($params)) {
                $resultado = true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function contratarActividad($idC, $idA)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("insert into participa values(?,?)");
            $params = array($idA, $idC);
            if ($consulta->execute($params)) {
                $resultado = true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function existeActividadContratada($idC, $idA)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("select * from participa
            where cliente_id=? and actividad_id=?");
            $params = array($idC, $idA);
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

    function obtenerActividadesContratadas($idC)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare("SELECT a.* from participa p 
            inner join actividad a on a.id = p.actividad_id 
            where p.cliente_id=?");
            $params = array($idC);
            $consulta->execute($params);
            while ($fila = $consulta->fetch()) {
                $resultado[] = new Actividad($fila['id'], $fila['nombre'], $fila['coste_mensual'], true);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerPrimeraActividad()
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('select * from actividad order by nombre limit 1');
            $consulta->execute();
            //Ver si se ha devuelto 1 registro con el usuario
            if ($fila = $consulta->fetch()) {
                //Se ha encontrado el usuario
                $resultado = new Actividad($fila['id'], $fila['nombre'], $fila['coste_mensual'], true);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerActividad($id)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('select * from actividad where id=?');
            $params = array($id);
            if ($consulta->execute($params)) {
                //Ver si se ha devuelto 1 registro con el usuario
                if ($fila = $consulta->fetch()) {
                    //Se ha encontrado el usuario
                    $resultado = new Actividad($fila['id'], $fila['nombre'], $fila['coste_mensual'], true);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerActividades()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query('select * from actividad where activa=true order by nombre');
            while ($fila = $consulta->fetch()) {
                $resultado[] = new Actividad($fila['id'], $fila['nombre'], $fila['coste_mensual'], true);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerUsuario(string $usuario, string $ps)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('select * from usuario where usuario=? and clave=sha2(?,0)');
            $params = array($usuario, $ps);
            if ($consulta->execute($params)) {
                //Ver si se ha devuelto 1 registro con el usuario
                if ($fila = $consulta->fetch()) {
                    //Se ha encontrado el usuario
                    $resultado = new Usuario($fila['usuario'], $fila['tipo']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerCliente(string $usuario)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('select * from cliente where usuario=?');
            $params = array($usuario);
            if ($consulta->execute($params)) {
                //Ver si se ha devuelto 1 registro con el usuario
                if ($fila = $consulta->fetch()) {
                    //Se ha encontrado el usuario
                    $resultado = new Cliente(
                        $fila['id'],
                        $fila['usuario'],
                        $fila['dni'],
                        $fila['apellidos'],
                        $fila['nombre'],
                        $fila['telf'],
                        $fila['baja']
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
     *
     * @return  self
     */
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }
}
