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

    //Prepare = Si en la consulta hay ?
    //Query = Todas las demás

    function obtenerTiendas()
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

    function obtenerTienda($codigo)
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

    function obtenerProductos()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('SELECT * from producto order by nombre');
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


    function obtenerDatosTienda($tienda)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from tienda where codigo = ?');
            $params = array($tienda);
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


    function obtenerSeleccionado($code)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from producto where codigo = ?');
            $params = array($code);
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

    function crearPedido($tienda, $cesta)
    {
        $resultado=0;
        try {
            $this->conexion->beginTransaction();
            //Crear Pedido
            $consulta = $this->conexion->prepare('INSERT into pedido values(default, curdate(), ?)');
            $params = array($tienda->getCodigo());
            if ($consulta->execute($params)) {
                //Recuperar el id del pedido generado
                $idP = $this->conexion->lastInsertId();
                //Inserts de productos en cesta
                $linea = 0;
                foreach ($cesta as $pc) {
                    $consulta = $this->conexion->prepare('INSERT into detalle values(?,?,?,?,?)');

                    $params = array(++$linea,$idP, $pc->getProducto()->getCodigo(), $pc->getCantidad(), $pc->getProducto()->getPrecio());
                    if (!$consulta->execute($params)) {
                        $this->conexion->rollBack();
                        $resultado=false;
                        return 0;
                    }
                }
                $this->conexion->commit();
                $resultado=$idP;
            } else {
                $this->conexion->rollBack();
                $resultado=0;
            }
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        }
        return $resultado;
    }


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
