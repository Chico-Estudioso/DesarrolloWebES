<?php 
class Vivienda{
    private string $tipoV;
    private string $zona;
    private string $direccion;
    private int $numHab;
    private float $precio;
    private int $tamanio;
    private string $extras;
    private string $observacion;

    public function __construct($tipoV, $zona, $direccion, $numHab, $precio, $tamanio, $extras, $observacion)
    {
        $this->tipoV = $tipoV;
        $this->zona = $zona;
        $this->direccion = $direccion;
        $this->numHab = $numHab;
        $this->precio = $precio;
        $this->tamanio = $tamanio;
        $this->extras = $extras;  
        $this->observacion=$observacion;
    }

    public function obtenerNumHabitaciones()
    {
        switch ($this->numHab) {
            case '1':
                return 1;
            case '2':
                return 2;
            case '3':
                return 3;
        }
    }

    public function obtenerExtras(){
       
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
     * Get the value of numHab
     */ 
    public function getNumHab()
    {
        return $this->numHab;
    }

    /**
     * Set the value of numHab
     *
     * @return  self
     */ 
    public function setNumHab($numHab)
    {
        $this->numHab = $numHab;

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
     * Get the value of extras
     */ 
    public function getExtras()
    {
        return $this->extras;
    }

    /**
     * Set the value of extras
     *
     * @return  self
     */ 
    public function setExtras($extras)
    {
        $this->extras = $extras;

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

    /**
     * Get the value of observacion
     */ 
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set the value of observacion
     *
     * @return  self
     */ 
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }
}
