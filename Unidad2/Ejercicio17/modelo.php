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
public function obtenerCitas(){
    $resultado=array();

    if (file_exists($this->nombreFichero)) {
        $datos=file($this->nombreFichero);
        foreach($datos as $linea){
            $campo=explode(';',$linea);
            $cita=new Cita($campo[0],$campo[1],$campo[2],$campo[3]);
            $resultado[]=$cita;
        }
    }
    return $resultado;
}
}
