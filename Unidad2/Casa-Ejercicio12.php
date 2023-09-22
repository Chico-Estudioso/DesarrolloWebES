<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<--Crea un array como el que se muestra a continuación. Recorrer el array y muestra de qué tipo es cada celda del mismo. Para el array asociativo, se debe mostrar todo su contenido (Usa la instrucción foreach para recorres este tipo de array): !>

    <body>
        <?php
        echo '<h1> Ejercicio 12 </h1>';
        $censo = array();
        $hija = array();
        echo '<table>';
        echo '<tr>';
        echo '<td>';
        $censo[0] = 2345.65;
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        $censo[1] = 'Carlos';
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        $censo[2] = 34;
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo '<table>';
        echo '<tr>';
        echo '<td>';
            echo 'Nombre';
        echo '</td>';
        echo '<td>';
            echo 'Edad';
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
            echo '"María"';
        echo '</td>';
        echo '<td>';
            echo '19';
        echo '</td>';
        echo '</tr>';
        echo '</table>';
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
            $censo[3]=true;
        echo '</td>';
        echo '</tr>';
        echo '</table>';
        ?>
    </body>

</html>