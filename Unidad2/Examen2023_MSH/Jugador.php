<?php 
class Jugador{
    private int $nJugador;
    private string $nombre;
    private string $fechaN;
    private string $categoria;
    private string $tipoCategoria;
    private $compe=false;
    private $extras=false;

    public function __construct($nJugador,$nombre,$fechaN,$categoria,$tipoCategoria){
        $this->nJugador=$nJugador;
        $this->nombre=$nombre;
        $this->fechaN=$fechaN;
        $this->categoria=$categoria;
        $this->tipoCategoria=$tipoCategoria;
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
     * Get the value of tipoCategoria
     */ 
    public function getTipoCategoria()
    {
        return $this->tipoCategoria;
    }

    /**
     * Set the value of tipoCategoria
     *
     * @return  self
     */ 
    public function setTipoCategoria($tipoCategoria)
    {
        $this->tipoCategoria = $tipoCategoria;

        return $this;
    }

    /**
     * Get the value of compe
     */ 
    public function getCompe()
    {
        return $this->compe;
    }

    /**
     * Set the value of compe
     *
     * @return  self
     */ 
    public function setCompe($compe)
    {
        $this->compe = $compe;

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
?>