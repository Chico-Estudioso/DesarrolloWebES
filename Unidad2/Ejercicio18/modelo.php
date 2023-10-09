<?php
require_once 'ClaseVivienda.php';
class Modelo{
    private string $nombreFichero = 'Vivienda.txt';

    function crearVivienda(Vivienda $v)
    {
        $f = null;
        try {
            //Abrir fichero para añadir
            $f = fopen($this->nombreFichero, "a+");
            //Añadir cita
            fwrite(
                $f,
                $v->getTipoV() . ";" . $v->getZona() . ";" . $v->getDireccion() . ";" . $v->getNumHab() .";" . $v->getPrecio() . ";" . $v->getTamaño() . ";" .$v->getExtras() . PHP_EOL
            );
            $resultado = true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        } finally {
            //Cerrar fichero
            if ($f != null) {
                fclose($f);
            }
        }
        return $resultado;
    }
}
