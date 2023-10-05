<?php

require_once 'ClaseCita.php';
class Modelo{
    private string $nombreFichero="citas.txt";

function __construct(){

}

function crearCita(Cita $c){
    try {
        $f=fopen($this->nombreFichero,"a+");
        fwrite($f,$c->getFecha().";".$c->getHora().";".$c->getNombre().";".$c->getTipoServicio().PHP_EOL);
    } catch (\Throwable $th) {
        echo $th->getMessage();
        $resultado=true;
    } finally{
        if($f!=null){
            fclose($f);
        }
    }
    return $resultado;
}
}?>