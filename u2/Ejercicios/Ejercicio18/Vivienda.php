<?php
class Vivienda
{
    private string $tipoV;
    private string $zona;
    private string $direccion;
    private int $nH;
    private int $precio;
    private int $tamanio;
    private string $extra = "";
    private string $comentario = "";

    public function __construct($tipoV, $zona, $direccion, $nH, $precio, $tamanio)
    {
        $this->tipoV = $tipoV;
        $this->zona = $zona;
        $this->direccion = $direccion;
        $this->nH = $nH;
        $this->precio = $precio;
        $this->tamanio = $tamanio;
    }

    /**
     * Get the value of tipoV
     */
    public function getTipoV()
    {
        return $this->tipoV;
    }

    /**
     * Set the value of tipoV
     *
     * @return  self
     */
    public function setTipoV($tipoV)
    {
        $this->tipoV = $tipoV;

        return $this;
    }

    /**
     * Get the value of zona
     */
    public function getZona()
    {
        return $this->zona;
    }

    /**
     * Set the value of zona
     *
     * @return  self
     */
    public function setZona($zona)
    {
        $this->zona = $zona;

        return $this;
    }

    /**
     * Get the value of direccion
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of nH
     */
    public function getNH()
    {
        return $this->nH;
    }

    /**
     * Set the value of nH
     *
     * @return  self
     */
    public function setNH($nH)
    {
        $this->nH = $nH;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of extra
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Set the value of extra
     *
     * @return  self
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;

        return $this;
    }

    /**
     * Get the value of comentario
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set the value of comentario
     *
     * @return  self
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get the value of tamanio
     */
    public function getTamanio()
    {
        return $this->tamanio;
    }

    /**
     * Set the value of tamanio
     *
     * @return  self
     */
    public function setTamanio($tamanio)
    {
        $this->tamanio = $tamanio;

        return $this;
    }
}
