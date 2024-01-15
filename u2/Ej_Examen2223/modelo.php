<?php
require_once 'Estancia.php';

class Modelo
{
    private string $nombreFichero = "estancias.txt";

    function __construct()
    {
    }

    function crearEstancia(Estancia $e)
    {
        $fich = null;
        try {
            $fich = fopen($this->nombreFichero, "a+");
            fwrite(
                $fich,
                $e->getDni() . ";" . $e->getNombre() . ";" . $e->getTipoH() . ";" . $e->getNNoches() . ";" . $e->getEstancia() . ";" . $e->getPago() . ";" . $e->getOpciones() . ";" . PHP_EOL
            );
            $resultado = true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        } finally {
            if ($fich != null) {
                fclose($fich);
            }
        }
        return $resultado;
    }
    public function obtenerEstancias()
    {
        $resultado = array();

        if (file_exists($this->nombreFichero)) {
            $archivos = file($this->nombreFichero);
            foreach ($archivos as $linea) {
                $pos = explode(';', $linea);
                $estancia = new Estancia($pos[0], $pos[1], $pos[2], $pos[3], $pos[4], $pos[5]);
                $estancia->setOpciones($pos[6]);
                $resultado[] = $estancia;
            }
        }
        return $resultado;
    }
}
