<?php
require_once 'Modelo.php';
$bd = new Modelo();
$seleccionado1=0;
if($bd->getConexion()==null){
	$mensaje = 'Error, no hay conexión con la bd';
}

session_start(); 
// if (isset($_SESSION['tienda'])) {
//     $tienda = $bd->obtenerDatosTienda($_POST['tienda']);
// }  
if (isset($_POST['selTienda'])) {
    $tienda = $bd->obtenerDatosTienda($_POST['tienda']);
    $_SESSION['tienda']=$tienda;
} 
if (isset($_SESSION['tienda'])) {
    $seleccionado1==1;
}

if (isset($_POST['cambiar'])) {
    session_destroy();
    header('location:mcDaw.php');
}

if (isset($_POST['crearPedido'])) {
    
}

if (isset($_POST['agregar'])) {
    if ($_POST['cantidad']==0) {
        $mensaje='La cantidad no puede ser inferior a 0';
    }else {
        $productos2=$bd->obtenerSeleccionado($_POST['producto']);

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
    <div>
        <h1 style='color:red;'><?php
								echo isset($mensaje) ? $mensaje : '';
								?></h1>
    </div>
    <form action="mcDaw.php" method="post">
        <h1 style='color:blue;'>Tienda</h1>
        <label for="tienda">Tienda</label><br />
        <select name="tienda">
            <?php 
            ?>
            <?php
            $tiendas = $bd->obtenerTiendas();
            foreach($tiendas as $t){
                echo '<option value="'.$t->getCodigo().'">'.$t->getNombre().'</option>';	
            }
            ?>
            </select>
            <?php 
                
            ?>
            <button type="submit" name="selTienda">Seleccionar tienda</button>
            
            <?php  ?>
        <div>
            <?php if (isset($_POST['selTienda'])) {
             ?>
            <h1 style='color:blue;'>Añade productos a la cesta</h1>
            <h2 style='color:green;'>Datos:<?php
					echo 'Nombre: '.$tienda->getNombre().'-'
                    .'- Fecha: '.
					$tienda->getTelefono();
					?>
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
                            $productos = $bd->obtenerProductos();
                            foreach($productos as $p){
                                echo '<option value="'.$p->getCodigo().'">'.$p->getNombre().'</option>';	
                            }
                                ?>
                        </select>
                    </td>
                    <td><input id="cantidad" type="number" name="cantidad" value="1"/></td>
                    <?php 

                    ?>
                    <td><button type="submit" name="agregar">+</button></td>
                </tr>
            </table>            
        </div>
        <div>
            <h1 style='color:blue;'>Contenido de la cesta</h1>
            <table  border="1"  rules="all"  width="25%">
                <tr>
                    <td><b>Producto</b></td>
                    <td><b>Cantidad</b></td>
                    <td><b>Precio</b></td>
                </tr>
            <?php
            if (isset($_POST['agregar'])) {
                foreach ($productos2 as $p2) {
                    echo '<tr>';
					echo '<td align="left">'.$p2->getProducto()->getNombre().'</td>';
            		echo '<td align="left">'.$p2->getCantidad().'</td>';
					echo '</tr>';
                }
            } 
            ?>
            </table>   
            <button type="submit" name="crearPedido">Crear Pedido</button>         
        </div>
        <?php } else {
            echo '';
        } ?>
        
    </form>
</body>
</html>