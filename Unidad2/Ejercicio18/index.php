<?php
require_once 'ClaseVivienda.php';
require_once 'modelo.php';

$ad=new Modelo();
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
                <option value="1" selected>Adosado</option>
                <option value="2">Unifamiliar</option>
                <option value="3">Piso</option>
            </select>
        </div>
        <div>
            <label for="zonaVivienda">Zona de la Vivienda </label>
            <select name="tipoVivienda">
                <option value="1" selected>Centro</option>
                <option value="2">Periferia</option>
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
            <label for="tamañoVivienda">Introduzca el tamaño</label>
            <input type="num" name="tamañoViv" placeholder="Tamaño de la vivienda">
        </div>
        <div>
            <label for="extrasVivienda">Selecciona los extras que necesitas:</label>
            <input type="checkbox" name="xtra[]" value="1"> Garaje
            <input type="checkbox" name="xtra[]" value="2"> Trastero
            <input type="checkbox" name="xtra[]" value="3"> Piscina
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
            isset($_POST['tipoVivienda']) or isset($_POST['zonaVivienda']) 
            or empty($_POST['direccionVivienda']) or empty($_POST['precioVivienda']) 
            or empty($_POST['tamañoVivienda'])
        ) {
            echo '<h3 style="color:red">Error, rellena todos los campos</h3>';
        } else {
            $vivienda = new Vivienda(
                $_POST['tipoVivienda'],
                $_POST['zonaVivienda'],
                $_POST['direccionVivienda'],
                $_POST['numHabitaciones'],
                $_POST['precioVivienda'],
                $_POST['tamañoVivienda'],
                $_POST['extrasVivienda'],
                $_POST['observacionesViv']
            );

            if ($ad->crearCita($vivienda)) {
                echo '<h3 style="color:blue">Vivienda creada con éxito</h3>';
            } else {
                echo '<h3 style="color:red">Error al crear la vivienda</h3>';
            }
        }
    }
    $vivienda=$ad->obtenerCitas();
    ?>
</body>

</html>