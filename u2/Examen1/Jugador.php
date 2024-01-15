<?php

class Jugador
{
    private int $nJugador;
    private string $nombre;
    private string $fechaN;
    private string $categoria;
    private string $tipoC;
    private string $competi;
    private string $equipaciones;

    public function __construct($nJugador, $nombre, $fechaN, $categoria, $tipoC)
    {
        $this->nJugador = $nJugador;
        $this->nombre = $nombre;
        $this->fechaN = $fechaN;
        $this->categoria = $categoria;
        $this->tipoC = $tipoC;
    }

    /**
     * Get the value of nJugador
     */
    public function getNJugador()
    {
        return $this->nJugador;
    }

    /**
     * Set the value of nJugador
     *
     * @return  self
     */
    public function setNJugador($nJugador)
    {
        $this->nJugador = $nJugador;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of fechaN
     */
    public function getFechaN()
    {
        return $this->fechaN;
    }

    /**
     * Set the value of fechaN
     *
     * @return  self
     */
    public function setFechaN($fechaN)
    {
        $this->fechaN = $fechaN;

        return $this;
    }

    /**
     * Get the value of categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of tipoC
     */
    public function getTipoC()
    {
        return $this->tipoC;
    }

    /**
     * Set the value of tipoC
     *
     * @return  self
     */
    public function setTipoC($tipoC)
    {
        $this->tipoC = $tipoC;

        return $this;
    }

    /**
     * Get the value of competi
     */
    public function getCompeti()
    {
        return $this->competi;
    }

    /**
     * Set the value of competi
     *
     * @return  self
     */
    public function setCompeti($competi)
    {
        $this->competi = $competi;

        return $this;
    }

    /**
     * Get the value of equipaciones
     */
    public function getEquipaciones()
    {
        return $this->equipaciones;
    }

    /**
     * Set the value of equipaciones
     *
     * @return  self
     */
    public function setEquipaciones($equipaciones)
    {
        $this->equipaciones = $equipaciones;

        return $this;
    }
}

class Modelo
{
    private string $nombreFichero = "jugadores.txt";

    function crearJugador(Jugador $j)
    {
        $fich = null;
        try {
            $fich = fopen($this->nombreFichero, "a+");
            fwrite(
                $fich,
                $j->getNJugador() . ";" . $j->getNombre() . ";" . $j->getFechaN() . ";" . $j->getCategoria() . ";" . $j->getTipoC() . ";" . $j->getCompeti() . ";" . $j->getEquipaciones() . ";" . PHP_EOL
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
    public function obtenerJugadores()
    {
        $resultado = array();

        if (file_exists($this->nombreFichero)) {
            $archivos = file($this->nombreFichero);
            foreach ($archivos as $linea) {
                $pos = explode(';', $linea);
                $jugador = new Jugador($pos[0], $pos[1], $pos[2], $pos[3], $pos[4]);
                $jugador->setCompeti($pos[5]);
                $jugador->setEquipaciones($pos[6]);
                $resultado[] = $jugador;
            }
        }
        return $resultado;
    }
}
