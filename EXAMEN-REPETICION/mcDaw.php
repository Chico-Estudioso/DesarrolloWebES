<?php
require_once 'Modelo.php';
require_once 'Tienda.php';
$bd = new Modelo();

if ($bd->getConexion() == null) {
    $mensaje = 'Error, no hay conexión con la bd';
} else {
    session_start();
    if (isset($_POST['selTienda'])) {
        $tienda = $bd->obtenerTiendaSeleccionada($_POST['tienda']);
        $_SESSION['tienda'] = $tienda;
    } elseif (isset($_POST['cambiar'])) {
        session_destroy();
        header('location:mcDaw.php');
    } elseif (isset($_POST['agregar'])) {
        if ($_POST['cantidad'] == 0) {
            $mensaje = 'La CAntidad no puede ser inferior a 0';
        } else {
            $productoBruto = $bd->obtenerDatosProductoSeleccionado($_POST['producto']);
            if ($productoBruto != null) {
                if (!isset($_SESSION['cesta'])) {
                    $_SESSION['cesta'] = array();
                    $nuevoP = new ProductoEnCesta($productoBruto, $_POST['cantidad']);
                    $_SESSION['cesta'][] = $nuevoP;
                } else {
                    $nuevoP = new ProductoEnCesta($productoBruto, $_POST['cantidad']);
                    $_SESSION['cesta'][] = $nuevoP;
                }
            } else {
                $mensaje = 'Los datos del producto no coinciden';
            }
        }
    } elseif (isset($_POST['crearPedido'])) {
        if (isset($_SESSION['cesta']) and !empty($_SESSION['tienda'])) {
            $codigoPedido = $bd->crearPedido($_SESSION['cesta'], $_SESSION['tienda']);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1 style='color:red;'>
        <?php echo isset($mensaje) ? $mensaje : ''; ?>
    </h1>
    <form action="mcDaw.php" method="post">
        <?php if (!isset($_SESSION['tienda'])) {
            # code...
        ?>
            <div>
                <h1 style='color:blue;'>Tienda</h1>
                <label for="tienda">Tienda</label><br />
                <select name="tienda">
                    <?php
                    $tiendas = $bd->obtenerTodasTiendas();
                    foreach ($tiendas as $t) {
                        echo '<option value="' . $t->getCodigo() . '">' . $t->getNombre() . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="selTienda">Seleccionar tienda</button>
            </div>
        <?php } else { ?>
            <div>
                <h1 style='color:blue;'>Añade productos a la cesta</h1>
                <?php $t = $_SESSION['tienda'] ?>
                <h2 style='color:green;'>Datos Tienda: Nombre:<?php echo $t->getNombre() ?> - Teléfono:<?php echo $t->getTelefono() ?>
                    <button type="submit" name="cambiar">Cambiar Tienda</button>
                </h2>
                <table>
                    <tr>
                        <td><label for="producto">Producto</label><br /></td>
                        <td><label for="cantidad">Cantidad</label><br /></td>
                        <td>Añadir a la cesta</td>
                    </tr>
                    <tr>
                        <td>
                            <select id="producto" name="producto">
                                <?php
                                $productos = $bd->obtenerTodosProductos();
                                foreach ($productos as $p) {
                                    echo '<option value="' . $p->getCodigo() . '">' . $p->getNombre() . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td><input id="cantidad" type="number" name="cantidad" value="1" /></td>
                        <td><button type="submit" name="agregar">+</button></td>
                    </tr>
                </table>
            </div>
            <div>
                <h1 style='color:blue;'>Contenido de la cesta</h1>
                <table border="1" rules="all" width="25%">

                    <tr>
                        <td><b>Producto</b></td>
                        <td><b>Cantidad</b></td>
                        <td><b>Precio</b></td>
                    </tr>
                    <?php
                    if (isset($_SESSION['cesta'])) {
                        $PCESTA = $_SESSION['cesta'];
                        foreach ($PCESTA as $pc) {
                            echo '<tr>';
                            echo '<td>' . $pc->getProducto()->getNombre() . '</td>';
                            echo '<td>' . $pc->getCantidad() . '</td>';
                            echo '<td>' . $pc->getProducto()->getPrecio() . '</td>';
                            echo '</tr>';
                        }
                    }

                    ?>


                </table>
                <button type="submit" name="crearPedido">Crear Pedido</button>
            </div>
        <?php } ?>
    </form>
</body>

</html>