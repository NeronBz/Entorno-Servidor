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
        fwrite($fichero, $a->getNumExp() . ';' . $a->getNombre() . ';' . $a->getFechaN() . "\n");
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
        //Si se encuentra, crear $resultado como un alumno
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
    return $resultado;
}
