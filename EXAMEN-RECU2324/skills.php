<?php
require_once 'Modelo.php';
$bd = new Modelo();

if ($bd->getConexion() == null) {
    $mensaje = 'Error, no hay conexión con la bd';
} else {
    session_start();
    if (isset($_POST['selModalidad'])) {
        $modalidad = $bd->obtenerModalidadSeleccionada($_POST['modalidad']);
        if ($modalidad != null) {
            $_SESSION['modalidad'] = $modalidad;
        } else {
            $mensaje = 'Error, no se ha podido seleccionar la modalidad';
        }
    } elseif (isset($_POST['selAlumno'])) {
        $alumno = $bd->obtenerAlumnoSeleccionado($_POST['alumno']);
        if ($alumno != null) {
            $_SESSION['alumno'] = $alumno;
        } else {
            $mensaje = 'Error, no se ha podido seleccionar el alumno';
        }
    } elseif (isset($_POST['cambiarM'])) {
        unset($_SESSION['modalidad']);
        header('location:skills.php');
    } elseif (isset($_POST['cambiarA'])) {
        session_destroy();
        header('location:skills.php');
    } elseif (isset($_POST['guardar'])) {
        $puntuacionMaximaPrueba = $bd->obtenerPuntMax($_POST['prueba'], $_POST['puntos']);
        if ($puntuacionMaximaPrueba == true) {
            $comprobacionPrueba = $bd->comprobarPruebaCorregida($_POST['prueba']);
            if ($comprobacionPrueba == false) {
                $correccionInsertada = $bd->crearCalificacion($_SESSION['alumno'], $_POST['prueba'], $_POST['puntos'], $_POST['comentario']);
                if ($correccionInsertada == true) {
                    $mensaje = 'Se ha insertado la calificacion';
                } else {
                    $mensaje = 'Error, la calificacion insertada ha tenido fallos';
                }
            } else {
                $mensaje = 'Error, la prueba introducida ya se ha corregido previamente';
            }
        } else {
            $mensaje = 'Error, la puntuacion introducida supera el máximo de la prueba';
        }
    } elseif (isset($_POST['finalizar'])) {
        if ($correcciones = $bd->obtenerCorreccionesA($_SESSION['alumno']) == true) {
            $actualizarF = $bd->actualizarFinalizado($_SESSION['alumno']);
            if ($actualizarF == true) {
                $mensaje = 'Se ha actualizado correctamente';
            } else {
                $mensaje = 'Error, no se ha actualizado';
            }
        } else {
            $mensaje = 'Error, no todas las pruebas están corregidas';
        }
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
    <h1 style='color:red;'>
        <?php echo isset($mensaje) ? $mensaje : ''; ?>
    </h1>
    <form action="skills.php" method="post">
        <?php
        if (!isset($_SESSION['modalidad'])) {

        ?>
            <div>
                <h1 style='color:blue;'>Modalidad</h1>
                <label for="tienda">Modalidad</label><br />

                <select name="modalidad">
                    <?php
                    $modalidades = $bd->obtenerModalidades();
                    foreach ($modalidades as $mod) {
                        echo '<option value="' . $mod->getId() . '">' . $mod->getModalidad() . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="selModalidad">Seleccionar Modalidad</button>
            </div>
        <?php
        } ?>
        <?php
        if (isset($_SESSION['modalidad']) and !isset($_SESSION['alumno'])) {

        ?>
            <div>
                <h1 style='color:blue;'>Alumno</h1>
                <label for="tienda">Alumno</label><br />
                <select name="alumno">
                    <?php
                    $alumnos = $bd->obtenerAlumnos($_SESSION['modalidad']);
                    foreach ($alumnos as $al) {
                        echo '<option value="' . $al->getId() . '">' . $al->getNombre() . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" name="selAlumno">Seleccionar Alumno</button>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['modalidad']) and isset($_SESSION['alumno'])) {
        ?>
            <div>
                <h1 style='color:blue;'>Corrección</h1>

                <?php $datosAlumno = $_SESSION['alumno']; ?>
                <h2 style='color:green;'>Modalidad Seleccionada - <?php echo $datosAlumno->getNombre(); ?> -
                    Nota:<?php
                            if ($comprobarF = $bd->comprobarFinalizado($_SESSION['alumno']) == true) {
                                echo $datosAlumno->getPuntuacion(), ' DEFINITIVA';
                            } else {
                                echo 'X (Provisional)';
                            }
                            ?>
                    <button type="submit" name="cambiarM">Cambiar Modalidad</button>
                    <button type="submit" name="cambiarA">Cambiar Alumno</button>
                </h2>
                <table>
                    <tr>
                        <td><label for="prueba">Prueba</label><br /></td>
                        <td><label for="puntos">Puntos</label><br /></td>
                        <td><label for="comentario">Comentario</label></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <select id="prueba" name="prueba">
                                <?php
                                $datosModalidad = $_SESSION['modalidad'];

                                $pruebas = $bd->obtenerPruebasModalidad($_SESSION['modalidad']);
                                foreach ($pruebas as $pr) {
                                    echo '<option value="' . $pr->getId() . '">' . $pr->getDescripcion() . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td><input id="puntos" type="number" name="puntos" value="1" /></td>
                        <td><input id="comentario" type="text" name="comentario" placeholder="Comentario" /></td>
                        <td><button type="submit" name="guardar">Guardar</button></td>
                    </tr>
                </table>
            </div>
            <div>
                <h1 style='color:blue;'>Calificaciones del alumno</h1>
                <table border="1" rules="all" width="50%">
                    <tr>
                        <td><b>Prueba</b></td>
                        <td><b>Puntos Asignados</b></td>
                        <td><b>Puntos Obtenidos</b></td>
                        <td><b>Comentario</b></td>
                    </tr>
                    <?php
                    $correcciones = $bd->obtenerCorrecciones($_SESSION['alumno']);
                    foreach ($correcciones as $co) {
                        $pruebaC = $bd->obtenerPruebasId($co);
                        echo '<tr>';
                        echo '<td>', $pruebaC->getDescripcion(), '</td>';
                        echo '<td>', $pruebaC->getPuntuacion(), '</td>';
                        echo '<td>', $co->getPuntos(), '</td>';
                        echo '<td>', $co->getComentario(), '</td>';
                        echo '</tr>';
                    }
                    ?>

                </table>
                <button type="submit" name="finalizar">Finalizar Corrección</button>

                <!-- <div>
                    <table border="1" rules="all" width="50%">
                        <?php
                        // $obtenerG = obtenerGanadores();
                        ?>
                    </table>
                </div> -->
            </div>
        <?php } ?>
    </form>
</body>

</html>