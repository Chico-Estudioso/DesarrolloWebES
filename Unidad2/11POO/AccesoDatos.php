<?php
include_once "claseAlumno.php";
$nombreFichero = "alumnos.txt";
function crearAlumno(Alumno $a)
{
    $fichero = null;
    try {
        //Abrir el fichero para + info
        //Si el fichero no existe se va a crear.
        global $nombreFichero;
        $fichero = fopen($nombreFichero, "a+");
        //Escribir los datos del alumno
        fwrite($fichero, $a->getNumExp() . ';' . $a->getNombre() . ';' . $a->getFechaN() . '\n');
        return true;
    } catch (\Throwable $th) {
        return false;
    } finally {
        if ($fichero = null) {
            fclose($fichero);
        }
    }
}
