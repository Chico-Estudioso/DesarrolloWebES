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
    <form action="" method="post">
    <div>
        <label for="numExp">NºExpediente</label>
        <input type="text" name="numExp" placeholder="nombre Alumno">
    </div>
    <div>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" >
    </div>
    <div>
        <label for="fechaN">Fecha Nacimiento</label>
        <input type="date" name="fechaN" >
    </div>

    </form>
    <?php
        if(isset($_POST['crear'])){
            $a=new Alumno($_POST['numExp'],$_POST['nombre'],$_POST['fechaN']);
            $a->mostrar();
        }
    ?>
    
    <!--<?php
    /*$a = new Alumno(1, 'Paco', time());
    $a->mostrar();*/
    ?>-->
</body>

</html>