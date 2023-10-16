<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <div>
            <label>DNI</label><br>
            <input type="text" name="dni" placeholder="123456789L">
        </div>
        <div>
            <label>Nombre Cliente</label><br>
            <input type="text" name="nombre" placeholder="Nombre del Cliente">
        </div>
        <div>
            <label>Tipo Habitacion</label><br>
            <select name="tipoH">
                <option value="doble" selected>Doble</option>
                <option value="individual">Individual</option>
                <option value="suite">Suite</option>
            </select>
        </div>
        <div>
            <label>Numero de noches</label><br>
            <input type="number" name="numero">
        </div>
        <div>
            <label>Estancia</label><br>
            <select name="estancia">
                <option value="diario">Diario</option>
                <option value="fSemana">Fin de Semana</option>
                <option value="promocionado">Promocionado</option>
            </select>
        </div>
        <div>
            <label>Pago</label><br>
            <input type="radio" name="pago" value="efectivo">Efectivo
            <input type="radio" name="pago" value="tarjeta" checked="checked">Tarjeta
        </div>
        <div>
            <label>Opciones</label><br>
            <input type="Checkbox" name="opciones[]" value="1">Cuna
            <input type="Checkbox" name="opciones[]" value="2">Cama Suplementaria
            <input type="Checkbox" name="opciones[]" value="3">Lavanderia
        </div>
        <div>
            <input type="submit" name="crear" value="Crear Estancia">
            <input type="submit" name="ver" value="Ver Estancias">
        </div>
    </form>

    <?php
    //Chequeos
    if (isset($_POST['crear'])) {
        if (empty($_POST['nombre']) or empty($_POST['dni']) or empty($_POST['numero'])) {
            echo '<h3 style="color:red;">Error:DNI, nombre y nº de noches no pueden estar vacíos</h3>';
        }
        if (isset($_POST['pago']) and $_POST['pago'] == 'Efectivo' and $_POST['numero'] >= 2) {
            echo '<h3 style="color:red;">Error: El pago no puede ser Efectivo si la estancia es mayor a 2 noches</h3>';
        }
        if (isset($_POST['opciones']) and isset($_POST['opciones'][1])) {
            if ($_POST['opciones'][0] == 1 and $_POST['opciones'][1] == 2) {
                echo '<h3 style="color:red;">Error:No puedes marcar cuna y cama suplementaria</h3>';
            }
        }
        // Comprobamdo los valores del array sin usar funciones de array
        $encotnrado = false;
        if (!isset($_POST['opciones'])) {
            echo '<h3 style="color:red;">Error:No has seleccionado nada</h3>';
        } else {
            foreach ($_POST['opciones'] as $o) {
                if ($o == 1 or $o == 2) {
                    if (!$encotnrado) {
                        $encotnrado = true;
                    }
                } else {
                    echo '<h3 style="color:red;">Error:No puedes marcar cuna y cama Suplementaria a la vez</h3>';
                }
            }
        }
    }

    ?>
</body>

</html>