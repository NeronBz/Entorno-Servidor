<?php
class Cita
{
    private string $fecha;
    private string $hora;
    private string $nombreC;
    private int $tipoS;

    public function __construct($fecha, $hora, $nombreC, $tipoS)
    {
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->nombreC = $nombreC;
        $this->tipoS = $tipoS;
    }

    /**
     * Get the value of tipoS
     */
    public function getTipoS()
    {
        return $this->tipoS;
    }

    /**
     * Set the value of tipoS
     *
     * @return  self
     */
    public function setTipoS($tipoS)
    {
        $this->tipoS = $tipoS;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of hora
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get the value of nombreC
     */
    public function getNombreC()
    {
        return $this->nombreC;
    }

    /**
     * Set the value of nombreC
     *
     * @return  self
     */
    public function setNombreC($nombreC)
    {
        $this->nombreC = $nombreC;

        return $this;
    }
}
