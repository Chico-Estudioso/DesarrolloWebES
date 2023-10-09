<?php 
class Vivienda{
    private string $tipoV;
    private string $zona;
    private string $direccion;
    private int $numHab;
    private float $precio;
    private int $tamaño;
    private string $extras;

    public function __construct($tipoV, $zona, $direccion, $numHab, $precio, $tamaño, $extras)
    {
        $this->tipoV = $tipoV;
        $this->zona = $zona;
        $this->direccion = $direccion;
        $this->numHab = $numHab;
        $this->precio = $precio;
        $this->tamaño = $tamaño;
        $this->extras = $extras;  
    }

    public function obtenerVivienda()
    {
        switch ($this->tipoV) {
            case '1':
                return 'Adosado';
            case '2':
                return 'Unifamiliar';
            case '3':
                return 'Piso';
        }
    }

    public function obtenerZona()
    {
        switch ($this->zona) {
            case '1':
                return 'Centro';
            case '2':
                return 'Periferia';
        }
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
     * Get the value of tamaño
     */ 
    public function getTamaño()
    {
        return $this->tamaño;
    }

    /**
     * Set the value of tamaño
     *
     * @return  self
     */ 
    public function setTamaño($tamaño)
    {
        $this->tamaño = $tamaño;

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
}
