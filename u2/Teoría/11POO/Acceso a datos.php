<?php
include_once "claseAlumno.php";
$nombreFichero = "alumnos.txt";
function crearAlumno(Alumno $a)
{
    $fichero = null;

    try {
        global $nombreFichero;
        //Abrir el fichero para añadir información
        //Si no existe se va a crear
        $fichero = fopen($nombreFichero, "a+");
        //Escribir los datos del alumno
        fputs($fichero, $a->getNumExp() . ';' . $a->getNombre() . ';' . $a->getFechaN() . PHP_EOL);
        return true;
    } catch (\Throwable $th) {
        return false;
    } finally {
        //Cerrar el fichero
        if ($fichero != null) {
            fclose($fichero);
        }
    }
}

function obtenerAlumno(int $numExp)
{
    global $nombreFichero;
    $resultado = null;
    try {
        //Comprobar si existe el fichero antes de abrir
        if (file_exists($nombreFichero)) {
            //Cargar fichero en array
            $contenido = file($nombreFichero);
            if (is_array($contenido)) {
                //Buscar el numExp en el array
                foreach ($contenido as $linea) {
                    $datos = explode(';', $linea);
                    //Comprar el numExp del fichero(datos[0]) con el numExp buscado
                    if ($datos[0] == $numExp) {
                        //Crear objeto alumno y finalizar
                        $resultado = new Alumno($datos[0], $datos[1], (int)$datos[2]);
                        return $resultado;
                    }
                }
            }
        }
        //Si se encuentra, crear $resultado como un alumno
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
    return $resultado;
}

function obtenerAlumnos()
{
    $resultado = array();
    global $nombreFichero;
    try {
        //Comprobar si el fichero existe
        if (file_exists($nombreFichero)) {
            $contenido = file($nombreFichero);
            foreach ($contenido as $linea) {
                //Dividir la linea en campos: NumExp, nombre, fechaN
                $campos = explode(";", $linea);
                //Creamos objeto alumno
                $a = new Alumno($campos[0], $campos[1], $campos[2]);
                //Añadimos el alumno al array de resultado
                $resultado[] = $a;
            }
        }
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
    return $resultado;
}
