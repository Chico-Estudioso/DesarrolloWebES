<?php
require_once 'ClaseCita.php';
require_once 'modelo.php';
?>
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
            <label for="fecha">Fecha/Hora </label>
            <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>">
            <input type="time" name="hora" value="<?php echo date('h:i'); ?>">
        </div>
        <div>
            <label for="nombre">Nombre del cliente </label>
            <input type="text" name="nombre" placeholder="Nombre deñ Cliente">
        </div>
        <div>
            <label for="tipoS">Selecciona el servicio </label>
            <select name="tipoS">
                <option value="1">Corte Sra.</option>
                <option value="2">Corte Sr.</option>
                <option value="3">Corte Tinte.</option>
                <option value="4">Corte Mechas.</option>

            </select>
        </div>
        <div>
            <input type="submit" name="crear" value="Crear Cita">
        </div><?php
                if (isset($_POST['crear'])) {
                    if (empty($_POST['fecha']) or empty($_POST['hora']) or empty($_POST['nombre']) or empty($_POST['tipoS'])) {
                        echo '<h3>MAL<\h3>';
                    } else {
                        $cita = new Cita(strtotime($_POST['fecha']), strtotime($_POST['hora']), $_POST['nombre'], $_POST['tipoS']);
                    }
                }
                ?>
    </form>
</body>

</html>