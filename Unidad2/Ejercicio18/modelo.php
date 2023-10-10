<?php
require_once 'ClaseVivienda.php';
class Modelo
{
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
                $v->getTipoV() . ";" . $v->getZona() . ";" . $v->getDireccion() . ";" . $v->obtenerNumHabitaciones() . ";" . $v->getPrecio() . ";" . $v->getTamanio() . ";" . $v->getExtras() . ";" . $v->getObservacion() . PHP_EOL
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

    function obtenerVivienda()
    {
        $resultado = array();

        if (file_exists($this->nombreFichero)) {
            $datos = file($this->nombreFichero);
            //Convertimos cada linea del fichero en un objeto Cita
            foreach ($datos as $linea) {
                $campos = explode(';', $linea);
                $vivienda = new Vivienda($campos[0], $campos[1], $campos[2], $campos[3], $campos[4], $campos[5], $campos[6], $campos[7]);
                $resultado[] = $vivienda;
            }
        }
        return $resultado;
    }
}
