<?php
class Alumno
{
    private $numExp;
    private $nombre;
    private $fechaN;

    function __construct(int $numExp, string $nombre, int $fechaN)
    {
        $this->numExp = $numExp;
        $this->nombre = $nombre;
        $this->fechaN = $fechaN;
    }

    function mostrar()
    {
        echo 'Alumno: ' . $this->numExp . ' Fecha Nacimiento: ' .
            date('d/m/Y', $this->fechaN) . 'Nombre: ' . $this->nombre;
    }

    function __destruct()
    {
        echo 'Alumno ' . $this->nombre . ' dado de baja';
    }
}
