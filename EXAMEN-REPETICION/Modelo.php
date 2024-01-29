<?php

require_once 'Producto.php';
require_once 'ProductoEnCesta.php';
require_once 'Tienda.php';

class Modelo
{
    private string $url = 'mysql:host=localhost;port=3306;dbname=mcDaw';
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

    function obtenerTodosProductos()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query('SELECT * from producto order by nombre');
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Producto($fila['codigo'], $fila['nombre'], $fila['precio']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerTodasTiendas()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query('SELECT * from tienda order by nombre');
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Tienda($fila['codigo'], $fila['nombre'], $fila['telefono']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function obtenerTiendaSeleccionada(string $codigo)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from tienda where codigo=?');
            $params = array($codigo);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Tienda($fila['codigo'], $fila['nombre'], $fila['telefono']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    
    function obtenerDatosProductoSeleccionado($codigo)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from producto where codigo=?');
            $params = array($codigo);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Producto($fila['codigo'], $fila['nombre'], $fila['precio']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    function crearPedido($cesta, $tienda)
    {
        try {
            $resultado = 0;
            $this->conexion->beginTransaction();
            $consulta = $this->conexion->prepare(
                'INSERT into pedido values (default,curdate(),?)'
            );
            $params = array($tienda->getCodigo());
            if ($consulta->execute($params)) {
                $idP = $this->conexion->lastInsertId();
                $puntero = 0;
                foreach ($cesta as $c) {
                    $consulta = $this->conexion->prepare('INSERT into detalles values (?,?,?,?,?)');
                    $params = array(++$puntero, $idP, $c->getProducto()->getCodigo(), $c->getCantidad(), $c->getProducto()->getPrecio());
                    if (!$consulta->execute($params)) {
                        $this->conexion->rollBack();
                        return 0;
                    }
                }
                $this->conexion->commit();
                $resultado = $idP;
            } else {
                $this->conexion->rollBack();
            }
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        }
        return $resultado;
    }

    // function introducirProductoEnCesta($producto, $cantidad, $tienda)
    // {
    //     $resultado = 0;
    //     try {
    //         //HAy que hacer inserts en 2 tablas => TRANSACCIÓN
    //         $this->conexion->beginTransaction();
    //         $consulta = $this->conexion->prepare(
    //             'INSERT into pedido values (default,curdate(),?)'
    //         );
    //         $params = array($tienda);
    //         if ($consulta->execute($params)) {
    //             $idP = $this->conexion->lastInsertId();
    //             $puntero = 0;
    //             foreach ($destinarios as $d) {
    //                 $consulta = $this->conexion->prepare(
    //                     'INSERT into para values (default,curdate(),?)'
    //                 );
    //                 $params = array($tienda);
    //                 if ($consulta->execute($params)) {
    //                     if ($consulta->rowCount() != 1) {
    //                         $this->conexion->rollBack();
    //                     }
    //                 } else {
    //                     $this->conexion->rollBack();
    //                 }
    //             }
    //             $this->conexion->commit();
    //             $resultado = $idMensaje;
    //             $m->setIdMen($idMensaje);
    //         }
    //     } catch (PDOException $e) {
    //         $this->conexion->rollBack();
    //         echo $e->getMessage();
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
