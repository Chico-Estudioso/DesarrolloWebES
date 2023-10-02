<?php
include_once 'claseAlumno.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Alum</title>
</head>

<body>
    <?php
    $a = new Alumno(1, 'Paco', time());
    $a->mostrar();
    ?>
</body>

</html>