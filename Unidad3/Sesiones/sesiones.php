<?php
    session_start();
    //Mostrar id y nombre de la sesión sin haberla iniciado
    echo '<h3>Id Sesión: '.session_id().'</h3>';
    echo '<h3>Nombre Sesión: '.session_name().'</h3>';
    echo '<h3>Valor de $_COOKIE["nombreSesion"]: '.$_COOKIE[session_name()].'</h3>';
    if (isset($_SESSION['usuario'])) {
        echo '<p>Existe variable usuario en sesión</p>';
    } else{
        echo '<p>NO Existe variable usuario en sesión</p>';
    }
    $_SESSION['usuario']='rosa';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>