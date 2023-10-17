<?php

require_once 'Jugador.php';
require_once 'modelo.php';
$ad = new Modelo();

function rellenarSelected($campo, $item)
{
    if (isset($_POST[$campo])) {
        if ($_POST[$campo] == $item) {
            echo 'selected = "selected"';
        }
    }
}

function rellenarRadio($campo, $item)
{
    if (isset($_POST[$campo])) {
        if ($_POST[$campo] == $item) {
            echo 'checked = "checked"';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio3</title>
</head>

<body>
    <form action="" method="post">
        <div>
            <label>Nº de Jugador</label><br />
            <input type="number" name="nJugador" />
        </div>
        <div>
            <label>Nombre y Apellidos</label><br />
            <input type="text" name="nombre" />
        </div>
        <div>
            <label>Fecha de Nacimiento</label>
            <input type="date" name="fechaN" value="<?php echo date('d-m-Y'); ?>">
        </div>
        <div>
            <label>Selecciona Categoria</label><br />
            <select name="categoria">
                <option <?php rellenarSelected('categoria', 'Benjamin'); ?>>Benjamin</option>
                <option <?php rellenarSelected('categoria', 'Alevín'); ?>>Alevín</option>
                <option <?php rellenarSelected('categoria', 'Infantil'); ?>>Infantil</option>
                <option <?php rellenarSelected('categoria', 'Cadete'); ?>>Cadete</option>
                <option <?php rellenarSelected('categoria', 'Junior'); ?>>Junior</option>
                <option <?php rellenarSelected('categoria', 'Senior'); ?>>Senior</option>
            </select>
        </div>
        <div>
            <label>Tipo de Categoria</label>
            <input type="radio" name="tipoCategoria" value="Masculina" <?php rellenarRadio('tipoCategoria', 'Masculina'); ?>>Masculina
            <input type="radio" name="tipoCategoria" value="Femenina" <?php rellenarRadio('tipoCategoria', 'Femenina'); ?>>Femenina
            <input type="radio" name="tipoCategoria" value="Mixta" <?php rellenarRadio('tipoCategoria', 'Mixta'); ?>>Mixta
        </div>
        <div>
            <label>Selecciona la/las competiciones</label>
            <br>
            <select name="compe[]" multiple="multiple">
                <option <?php rellenarSelected('compe', 'Primera'); ?>>Primera</option>
                <option <?php rellenarSelected('compe', 'Segunda A'); ?>>Segunda A</option>
                <option <?php rellenarSelected('compe', 'Segunda B'); ?>>Segunda B</option>
                <option <?php rellenarSelected('compe', 'Tercera'); ?>>Tercera</option>
            </select>
        </div>
        <div>
            <label>Equipaciones y Extras</label>
            <br> <input type="checkbox" name="extras[]" value="Entrenamientos" <?php if (isset($_POST['extras']) && in_array('Entrenamientos', $_POST['extras'])) echo 'checked'; ?>>Entrenamientos (25,00€)
            <br> <input type="checkbox" name="extras[]" value="Partidos" <?php if (isset($_POST['extras']) && in_array('Partidos', $_POST['extras'])) echo 'checked'; ?>>Partidos (25,00€)
            <br> <input type="checkbox" name="extras[]" value="Chandal" <?php if (isset($_POST['extras']) && in_array('Chandal', $_POST['extras'])) echo 'checked'; ?>>Chandal (40,00€)
            <br> <input type="checkbox" name="extras[]" value="Bolso" <?php if (isset($_POST['extras']) && in_array('Bolso', $_POST['extras'])) echo 'checked'; ?>>Bolso (15,00€)
        </div>
        <div>
            <input type="submit" name="enviar" value="Enviar" />
            <input type="reset" name="limpiar" value="Limpiar" />
            <input type="submit" name="verJ" value="Ver Jugadores">
        </div>
    </form>

    <?php
    if (isset($_POST['enviar'])) {
        if (
            empty($_POST['nJugador']) or empty($_POST['nombre'])
            or empty($_POST['fechaN']) or empty($_POST['categoria'])
            or empty($_POST['tipoCategoria']) or
            empty($_POST['compe']) or empty($_POST['extras'])
        ) {
            echo '<h3 style="color:red;">Error:Todos los campos deben de estar completos</h3>';
        } elseif (
            /*isset($_POST['tipoCategoria']) && $_POST['tipoCategoria'] == 'Mixta' &&
            $_POST['categoria'] == 'Infantil' or $_POST['categoria'] == 'Cadete'
            or $_POST['categoria'] == 'Junior' or $_POST['categoria'] == 'Senior'*/

            isset($_POST['tipoCategoria']) and $_POST['tipoCategoria'] == 'Mixta'
        ) {
            if (
                $_POST['categoria'] == 'Infantil' or $_POST['categoria'] == 'Cadete'
                or $_POST['categoria'] == 'Junior' or $_POST['categoria'] == 'Senior'
            ) {
                echo '<h3 style="color:red;">Error:La categoria mixta solo está disponible para Benjamín y Alevín</h3>';
            }
        } elseif ($_POST['extras'][0] != 'Entrenamientos' and $_POST['extras'][0] != 'Partidos') {
            echo '<h3 style="color:red;">Error:Debe seleccionar Entrenamientos o partidos como mínimo</h3>';
        } else {
            $importe = 0;
            for ($i = 0;$i < sizeof($_POST['extras']); $i++) {
                /*switch ($_POST['extras'][$i]) {
                    case '0':
                        if (isset($_POST['extras']) && $_POST['extras'][$i] == 'Entrenamientos') {
                            $importe += 25;
                        }
                        break;
                    case '1':
                        if (isset($_POST['extras']) && $_POST['extras'][$i] == 'Entrenamientos') {
                            $importe += 25;
                        }
                        break;
                    case '2':
                        if (isset($_POST['extras']) && $_POST['extras'][$i] == 'Entrenamientos') {
                            $importe += 25;
                        }
                        break;
                    case '3':
                        if (isset($_POST['extras']) && $_POST['extras'][$i] == 'Entrenamientos') {
                            $importe += 25;
                        }
                        break;
                }*/


                if (isset($_POST['extras'])) {
                    if ($_POST['extras'][$i] == 'Entrenamientos') {
                        $importe += 25;
                    }
                    if ($_POST['extras'][$i] == 'Partidos') {
                        $importe += 25;
                    }
                    if ($_POST['extras'][$i] == 'Chandal') {
                        $importe += 40;
                    }
                    if ($_POST['extras'][$i] == 'Bolso') {
                        $importe += 15;
                    }
                }
            }

            if ($importe != 0) {
                echo '<h3 style="color:blue;">Datos correctos. El importe a pagar es: ' . $importe . '</h3>';
            } else {
                echo '<h3 style="color:red;">Error al calcular importe</h3>';
            }

            $j = new Jugador(
                $_POST['nJugador'],
                $_POST['nombre'],
                $_POST['fechaN'],
                $_POST['categoria'],
                $_POST['tipoCategoria'],
                $_POST['compe'],
                $_POST['extras']
            );
            $strcompe = implode(',', $_POST['compe']);
            $j->setCompe($strcompe);
            $strextras = implode(',', $_POST['extras']);
            $j->setExtras($strextras);

            if ($ad->crearJugador($j)) {
                echo '<h3 style="color:blue;">Entrada correcta. El importe de a pagar es de ' . $importe . '€</h3>';
            } else {
                echo '<h3 style="color:red">Error al crear la ficha del jugador</h3>';
            }
        }
    }
    if (isset($_POST['verJ'])) {
        $jug = $ad->obtenerJugadores();
    ?>
        <table>
            <tr>
                <td><b>Nº de Jugador</b></td>
                <td><b>Nombre y apellidos</b></td>
                <td><b>Fecha de Nacimiento</b></td>
                <td><b>Categoria</b></td>
                <td><b>Tipo de Categoria</b></td>
                <td><b>Competiciones</b></td>
                <td><b>Extras</b></td>
            </tr>
        <?php
        foreach ($jug as $j) {
            echo '<tr>';
            echo '<td>' . $j->getNJugador() . '</td>';
            echo '<td>' . $j->getNombre() . '</td>';
            echo '<td>' . $j->getFechaN() . '</td>';
            echo '<td>' . $j->getCategoria() . '</td>';
            echo '<td>' . $j->getTipoCategoria() . '</td>';
            echo '<td>' . $j->getCompe() . '</td>';
            echo '<td>' . $j->getExtras() . '</td>';
        }
    }
        ?>

</body>

</html>