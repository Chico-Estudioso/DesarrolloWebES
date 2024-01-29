<?php
require_once 'Cliente.php';
require_once 'misActividades.php';
require_once 'Usuario.php';
require_once 'Actividad.php';
require_once 'login.php';
require_once 'crearCliente.php';

class Modelo
{
    private $url = "mysql:host=localhost;port=3306;dbname=gimnasio";
    private $us = "root";
    private $ps = "";
    private $conexion = null;

    function __construct()
    {
        try {
            $this->conexion = new PDO($this->url, $this->us, $this->ps);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /*
    DUDAS:
    1) El $consulta->execute params porque hay veces que va en el if y otras veces que va fuera del inf
    2) El puntero del fetch lo tenemos que usar en todos los métodos que no nos 
    devuelvan solo 1 resultado o hay que usarlos en todos
    3) Como se puede acceder a un campo en específico de un $SESSION, al igualarlo de una variable como
    puedo acceder a los campos de la propia variable??
    EJ: $SESSION[TOMATE] el campo de [Frutal]
    o El ejemplo de los jug1 y jug2 de Raúl
    */

    function obtenerUsuario(string $us, string $ps)
    {
        $resultado = 0;
        try {
            //Ejecutar fucnión almacenada en bd
            $consulta = $this->conexion->prepare('SELECT * from usuario where usuario=? and clave=sha(?,0)');
            $params = array($us, $ps);
            $consulta->execute($params);

            if ($fila = $consulta->fetch()) {
                $resultado = new Usuario($fila['usuario'], $fila['tipo']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerCliente(string $nombreUsuario)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from cliente where usuario=?');
            $params = array($nombreUsuario);
            $consulta->execute($params);
            if ($fila = $consulta->fetch()) {
                $resultado = new Cliente($fila['id'], $fila['usuario'], $fila['dni'], $fila['apellidos'], $fila['nombre'], $fila['telf'], $fila['baja']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
}
