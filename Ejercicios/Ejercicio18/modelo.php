<?php
require_once 'Vivienda.php';

class Modelo
{
    private string $nombreFichero = "viviendas.txt";

    function __construct()
    {
    }

    function crearVivienda(Vivienda $v)
    {
        $fich = null;
        try {
            $fich = fopen($this->nombreFichero, "a+");
            fwrite(
                $fich,
                $v->getTipoV() . ";" . $v->getZona() . ";" . $v->getDireccion() . ";" . $v->getNH() . ";" . $v->getPrecio() . ";" . $v->getTamanio() . ";" . $v->getExtra() . ";" . $v->getComentario() . ";" . PHP_EOL
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
    public function obtenerViviendas()
    {
        $resultado = array();

        if (file_exists($this->nombreFichero)) {
            $archivos = file($this->nombreFichero);
            foreach ($archivos as $linea) {
                $pos = explode(';', $linea);
                $vivienda = new Vivienda($pos[0], $pos[1], $pos[2], $pos[3], $pos[4], $pos[5], $pos[6], $pos[7]);
                $resultado[] = $vivienda;
            }
        }
        return $resultado;
    }
}
