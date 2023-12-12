<?php
require_once 'Empleado.php';
require_once 'Departamento.php';
require_once 'Mensaje.php';
class Modelo
{
    private string $url = 'mysql:host=localhost;port=3306;dbname=mensajes';
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

    function enviarMensaje(Mensaje $m, $destinatarios)
    {
        $resultado = false;
        try {
            //Hay que hacer inserts en 2 tablas => TRANSACCIÓN
            $this->conexion->beginTransaction();
            $consulta = $this->conexion->prepare('INSERT into mensaje values (default, ?,?,?,curdate(),?)');
            $params = array(
                $m->getDeEmpleado(), $m->getParaDepartamento(),
                $m->getAsunto(), $m->getMensaje()
            );
            if ($consulta->execute($params)) {
                //Recuperar el id del mensaje generado
                //Hacer un insert en "para" para cada destinatario
                foreach ($destinatarios as $d) {
                    $consulta = $this->conexion->prepare('INSERT into para values (default, ?,?,false)');
                    $params = array(, $d->getIdEmp());
                }
            }
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerEmpleadosDepartamentos($idDep)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('SELECT * from empleado wher departamento=?');
            $params = array($idDep);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Empleado(
                        $fila['idEmp'],
                        $fila['dni'],
                        $fila['nombreEmp'],
                        $fila['fechaNac'],
                        $fila['departamento'],
                        $fila['cambiarPS']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerDepartamentos()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query('SELECT * from departamento');
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Departamento($fila['idDep'], $fila['nombre']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
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
            $consulta = $this->conexion->prepare(
                'SELECT * from empleado e join departamento d on 
                e.departamento = d.idDep where idEmp=?'
            );
            $params = array($usuario);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Empleado(
                        $fila['idEmp'],
                        $fila['dni'],
                        $fila['nombreEmp'],
                        $fila['fechaNac'],
                        new Departamento($fila['idDep'], $fila['nombre']),
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
