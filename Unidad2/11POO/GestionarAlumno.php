<?php
include_once 'claseAlumno.php';
include_once 'AccesoDatos.php';
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
            <label for="numExp">Nº Expediente</label><br />
            <input name="numExp" type="number" value="1" />
        </div>
        <div>
            <label for="nombre">Nombre</label><br />
            <input name="nombre" type="text" required="required" placeholder="Introduce nombre Alumno" />
        </div>
        <div>
            <label for="fechaN">Fecha Nacimiento</label><br />
            <input name="fechaN" type="date" value="<?php echo date('Y-m-d') ?>" />
        </div>
        <input type="submit" name="crear" value="Crear Alumno">
    </form>
    <?php
    //Si pulsamos en Crear Alumno se crea el objeto y se muestra
    if (isset($_POST['crear'])) {
        $a = new Alumno($_POST['numExp'], $_POST['nombre'], strtotime($_POST['fechaN']));
        $a->mostrar();
    }

    //Chequear si el nº de expediente no existe en el fichero y si existe dará error
    $alTmp = obtenerAlumno($a->getNumExp());
    if ($alTmp == null) {
        // Guardar el alumno en el fichero
        if (crearAlumno($a)) {
            echo '<p style="color:blue;">Alumno creado: ' . $a->mostrar() . '</p>';
        } else {
            echo '<p style="color:blue;">Error al crear alumno</p>';
        }
    } else {
        echo '<p style="color:blue;">El alumno ya existe</p>';
    }


    function obtenerAlumno(int $numExp)
    {
        $resultado = null;
        global $nombreFichero;
        try {
            $contenido = file($nombreFichero);
            foreach ($contenido as $linea) {
                $datos=explode(';',$linea);
                if ((int)$datos[0]==$numExp) {
                    $resultado=new Alumno($datos[0],$datos[1],$datos[2]);
                    return $resultado;
                }
            }

        } catch (\Throwable $th) {
           echo $th->getMessage();
        }
        return $resultado;
    }
    ?>

    <!--<?php
        /*$a = new Alumno(1, 'Paco', time());
    $a->mostrar();*/
        ?>-->
</body>

</html>