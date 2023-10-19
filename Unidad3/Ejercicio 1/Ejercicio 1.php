<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <?php
    //Si la Cookie está definida mostramos los valores 
    // de numAccesos y FechaUM
    if (isset($_COOKIE['numAccesos'])) {
        $numAccesos = $_COOKIE['numAccesos'];
        $fechaUA = $_COOKIE['fechaUA'];
    }else {
        $numAccesos=1;
        $fechaUA="";
    }
    ?>
    <div>
        <h2>Nº de accesos: <?php echo $numAccesos; ?></h2>
        <h2>Fecha Último Acceso: <?php echo $fechaUA; ?></h2>
    </div>
    <?php
    // Creamos/Modificamos la cookie
    setcookie("numAccesos",$numAccesos+1, time()+365*24*60*60);
    setcookie("fechaUA",date('d/m/Y'), time()+365*24*60*60);
    ?>
</body>

</html>