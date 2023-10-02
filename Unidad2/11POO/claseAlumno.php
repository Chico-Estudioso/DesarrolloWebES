<?php
class Alumno
{
    private $numExp;
    private $nombre;
    private $fechaN;

    function __construct($numExp, $nombre, $fechaN)
    {
        $this->numExp = $numExp;
        $this->nombre = $nombre;
        $this->fechaN = $fechaN;
    }

    function mostrar()
    {
        echo 'Alumno: ' . $this->numExp . ' fecha de Nacimiento: ' . date('d/m/Y', $this->fechaN) . 'Nombre: ' . $this->nombre;
    }

    function __destruct()
    {
        echo '<br/>Alumno: ' . $this->nombre . ' dado de baja';
    }
}
