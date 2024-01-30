<?php
require_once 'Alumno.php';
require_once 'Correccion.php';
require_once 'Modalidad.php';
require_once 'Prueba.php';
require_once 'skills.php';


class Modelo
{
    private string $url = 'mysql:host=localhost;port=3306;dbname=skills';
    private string $us = 'root';
    private string $ps = '';

    private $conexion = null;

    function __construct()
    {
        try {
            $this->conexion = new PDO($this->url, $this->us, $this->ps);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function obtenerModalidades()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query("SELECT * from modalidad");
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Modalidad($fila['id'], $fila['modalidad']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerModalidadSeleccionada($id)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare("SELECT * from modalidad where id = ?");
            $params = array($id);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Modalidad($fila['id'], $fila['modalidad']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerAlumnos($modalidadData)
    {

        $resultado = array();
        try {
            $consulta = $this->conexion->prepare("SELECT * from alumno where modalidad = ?");
            $params = array($modalidadData->getId());
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Alumno($fila['id'], $fila['nombre'], $fila['modalidad'], $fila['puntuacion'], $fila['finalizado']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerAlumnoSeleccionado($idAlumno)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare("SELECT * from alumno where id = ?");
            $params = array($idAlumno);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado =  new Alumno($fila['id'], $fila['nombre'], $fila['modalidad'], $fila['puntuacion'], $fila['finalizado']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerPruebasModalidad($modalidad)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare("SELECT * from prueba where modalidad = ?");
            $params = array($modalidad->getId());
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Prueba($fila['id'], $fila['modalidad'], $fila['fecha'], $fila['descripcion'], $fila['puntuacion']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerPuntMax($prueba, $puntos)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("SELECT * from prueba where id = ? and puntuacion>=?");
            $params = array($prueba, $puntos);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function comprobarPruebaCorregida($prueba)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("SELECT * from correccion where prueba=?");
            $params = array($prueba);
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function crearCalificacion($alumnoCompleto, $prueba, $puntos, $comentario)
    {
        $resultado = false;
        try {
            $this->conexion->beginTransaction();
            $consulta = $this->conexion->prepare(
                'INSERT into correccion values(?,?,?,?)'
            );
            $params = array($alumnoCompleto->getId(), $prueba, $puntos, $comentario);
            if ($consulta->execute($params)) {
                $this->conexion->commit();
                $resultado = true;
            } else {
                $this->conexion->rollBack();
            }
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
            $resultado = false;
        }
        return $resultado;
    }

    function obtenerCorrecciones($alumno)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare("SELECT * from correccion where alumno = ?");
            $params = array($alumno->getId());
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Correccion($fila['alumno'], $fila['prueba'], $fila['puntos'], $fila['comentario']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerCorreccionesA($alumno)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare("SELECT * from correccion where alumno = ?");
            $params = array($alumno->getId());
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 4) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerNotaMax($correcion)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("SELECT puntuacion from prueba where id = ?");
            $params = array($correcion);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = $fila['puntuacion'];
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerPruebasId($correcion)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare("SELECT * from prueba where id = ?");
            $params = array($correcion->getPrueba());
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Prueba($fila['id'], $fila['modalidad'], $fila['fecha'], $fila['descripcion'], $fila['puntuacion']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function actualizarFinalizado($alumno)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("UPDATE alumno set finalizado=true where id =?");
            $params = array(
                $alumno->getId()
            );
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function comprobarFinalizado($alumno)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare("SELECT * from alumno where finalizado = true and id=?");
            $params = array($alumno->getId());
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = true;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    // function obtenerGanadores()
    // {
    //     $resultado = array();
    //     try {
    //         //Ejecutar función almacenada en bd
    //         $consulta = $this->conexion->prepare('call obtenerGanadores()');
    //         if ($consulta->execute()) {
    //             while ($fila = $consulta->fetch()) {
    //                 $resultado[] = (fila['modalidad']);
    //             }
    //         }
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //         echo $usuario, $ps;
    //     }
    //     return $resultado;
    // }

    /**
     * Get the value of conexion
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     *
     * @return  self
     */
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }
}
