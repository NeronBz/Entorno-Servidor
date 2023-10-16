<?php

class Estancia
{
    private string $dni;
    private string $nombre;
    private string $tipoH;
    private int $nNoches;
    private string $estancia;
    private $pago = false;
    private $opciones = false;

    public function __construct($dni, $nombre, $tipoH, $nNoches, $estancia, $pago)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->tipoH = $tipoH;
        $this->nNoches = $nNoches;
        $this->estancia = $estancia;
        $this->pago = $pago;
    }

    /**
     * Get the value of dni
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     *
     * @return  self
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

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
     * Get the value of tipoH
     */
    public function getTipoH()
    {
        return $this->tipoH;
    }

    /**
     * Set the value of tipoH
     *
     * @return  self
     */
    public function setTipoH($tipoH)
    {
        $this->tipoH = $tipoH;

        return $this;
    }

    /**
     * Get the value of nNoches
     */
    public function getNNoches()
    {
        return $this->nNoches;
    }

    /**
     * Set the value of nNoches
     *
     * @return  self
     */
    public function setNNoches($nNoches)
    {
        $this->nNoches = $nNoches;

        return $this;
    }

    /**
     * Get the value of estancia
     */
    public function getEstancia()
    {
        return $this->estancia;
    }

    /**
     * Set the value of estancia
     *
     * @return  self
     */
    public function setEstancia($estancia)
    {
        $this->estancia = $estancia;

        return $this;
    }

    /**
     * Get the value of pago
     */
    public function getPago()
    {
        return $this->pago;
    }

    /**
     * Set the value of pago
     *
     * @return  self
     */
    public function setPago($pago)
    {
        $this->pago = $pago;

        return $this;
    }

    /**
     * Get the value of opciones
     */
    public function getOpciones()
    {
        return $this->opciones;
    }

    /**
     * Set the value of opciones
     *
     * @return  self
     */
    public function setOpciones($opciones)
    {
        $this->opciones = $opciones;

        return $this;
    }
}
