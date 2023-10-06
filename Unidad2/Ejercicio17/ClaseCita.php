<?php
class Cita{
    private DateTime $fecha;
    private int $hora;
    private string $nombre;
    private int $tipoServicio;

    public function __construct($fecha, $hora, $nombre, $tipoServicio)
    {
        $this->fecha=$fecha;
        $this->hora=$hora;
        $this->nombre=$nombre;
        $this->tipoServicio=$tipoServicio;
    }

    public function obtenerNombreServicio(){
        switch ($this->tipoServicio) {
            case '1':
            return 'Corte Señora';
            case '2':
            return 'Corte Caballero';
            case '3':
            return 'Corte Tinte';
            case '4':
            return 'Corte Señora';
    }}
    public function obtenerTiempoServicio(){
        switch ($this->hora) {
            case '1':
            return 'Corte Señora';
            case '2':
            return 'Corte Caballero';
            case '3':
            return 'Corte Tinte';
            case '4':
            return 'Corte Señora';
    }}

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
     * Get the value of tipoServicio
     */ 
    public function getTipoServicio()
    {
        return $this->tipoServicio;
    }

    /**
     * Set the value of tipoServicio
     *
     * @return  self
     */ 
    public function setTipoServicio($tipoServicio)
    {
        $this->tipoServicio = $tipoServicio;

        return $this;
    }
}
?>