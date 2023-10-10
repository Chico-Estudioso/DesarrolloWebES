<?php
require_once 'ClaseVivienda.php';
require_once 'modelo.php';

$ad = new Modelo();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 18</title>
</head>

<body>
    <form action="" method="post">
        <div>
            <label for="tipoVivienda">Tipo de Vivienda </label>
            <select name="tipoVivienda">
                <option selected>Adosado</option>
                <option>Unifamiliar</option>
                <option>Piso</option>
            </select>
        </div>
        <div>
            <label for="zonaVivienda">Zona de la Vivienda </label>
            <select name="zonaVivienda">
                <optionselected>Centro</option>
                <option>Periferia</option>
            </select>
        </div>
        <div>
            <label for="direccionVivienda">Direccion</label>
            <input type="text" name="direccionViv" placeholder="direccion de la Vivienda">
        </div>
        <div>
            <label for="numHabitaciones">Numero de Habitaciones</label>
            <input type="radio" name="numHabitacion" checked="checked" value="1"> 1
            <input type="radio" name="numHabitacion" value="2"> 2
            <input type="radio" name="numHabitacion" value="3"> 3
        </div>
        <div>
            <label for="precioVivienda">Introduzca el precio</label>
            <input type="num" name="precioViv" placeholder="Precio">
        </div>
        <div>
            <label for="tamanioVivienda">Introduzca el tamaño</label>
            <input type="num" name="tamanioViv" placeholder="Tamaño de la vivienda">
        </div>
        <div>
            <label for="extrasVivienda">Selecciona los extras que necesitas:</label>
            <input type="checkbox" name="xtra[]" value="Garaje"> Garaje
            <input type="checkbox" name="xtra[]" value="Trastero"> Trastero
            <input type="checkbox" name="xtra[]" value="Piscina"> Piscina
        </div>
        <div>
            <label for="observacionesVivienda">Observaciones</label>
            <br>
            <textarea name="observacionesViv" placeholder="Observaciones sobre la vivienda"></textarea>
        </div>
        <div>
            <input type="submit" name="crear" value="Crear Vivienda">
        </div>
    </form>
    <?php
    if (isset($_POST['crear'])) {
        if (
            empty($_POST['direccionViv']) or empty($_POST['precioViv'])
            or empty($_POST['tamanioViv'])
        ) {
            echo '<h3 style="color:red">Error, rellena todos los campos</h3>';
        } else {
            if (isset($_POST['xtra'])) {
                $vivienda = new Vivienda(
                    $_POST['tipoVivienda'],
                    $_POST['zonaVivienda'],
                    $_POST['direccionViv'],
                    $_POST['numHabitacion'],
                    $_POST['precioViv'],
                    $_POST['tamanioViv'],
                    implode(",", $_POST['xtra']),
                    $_POST['observacionesViv']
                );
            } else {
                $extratxt = "";
                $vivienda = new Vivienda(
                    $_POST['tipoVivienda'],
                    $_POST['zonaVivienda'],
                    $_POST['direccionViv'],
                    $_POST['numHabitacion'],
                    $_POST['precioViv'],
                    $_POST['tamanioViv'],
                    $extratxt,
                    $_POST['observacionesViv']
                );
            }


            if ($ad->crearVivienda($vivienda)) {
                echo '<h3 style="color:blue">Vivienda creada con éxito</h3>';
            } else {
                echo '<h3 style="color:red">Error al crear la vivienda</h3>';
            }
        }
    }
    $vivienda = $ad->obtenerVivienda();
    ?>
    <table width="50%" align="center">
        <tr>
            <td><b>Tipo Vivienda</b></td>
            <td><b>Zona</b></td>
            <td><b>Num Hab</b></td>
            <td><b>Precio</b></td>
            <td><b>Tamaño</b></td>
            <td><b>Extras</b></td>
            <td><b>observaciones</b></td>
        </tr>
        <?php
        foreach ($vivienda as $c) {
            echo '<tr>';
            echo '<td>' . $c->getTipoV() . '</td>';
            echo '<td>' . $c->getZona() . '</td>';
            echo '<td>' . $c->obtenerNumHabitaciones() . '</td>';
            echo '<td>' . $c->getPrecio() . '</td>';
            echo '<td>' . $c->getTamanio() . '</td>';
            echo '<td>' . $c->getExtras() . '</td>';
            echo '<td>' . $c->getObservacion() . '</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>

</html>