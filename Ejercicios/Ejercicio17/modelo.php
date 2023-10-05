<?php
require_once 'ClaseCita.php';
class Modelo
{
    private string $nombreFichero = "citas.txt";

    function __construct()
    {
    }

    function crearCita(Cita $c)
    {
        $f = null;
        try {
            //Abrir fichero para añadir
            $f = fopen($this->nombreFichero, "a+");
            //Añadir cita
            fwrite(
                $f,
                $c->getFecha() . ";" . $c->getHora() . ";" . $c->getNombreC() . ";" . $c->getTipoS() . PHP_EOL
            );
            $resultado = true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        } finally {
            //Cerrar fichero
            if ($f != null) {
                fclose($f);
            }
        }
        return $resultado;
    }
}
