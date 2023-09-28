<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularios nuevos</title>
</head>

<body>
    <form action="" method="post">
        <h1>DATOS DE VUELO</h1>
        <div>
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo isset($_POST['rellenar']) ? $_POST['nombre'] : ''
                                                    ?>" />
        </div>
        <div>
            <label>Nº de acompañantes</label>
            <input type="number" name="numAcom" value="<?php if (isset($_POST['rellenar']))
                                                            echo $_POST['numAcom'];
                                                        else echo '' ?>" />
        </div>

        <button type="submit" name="rellenar" value="rellenar">Rellebar datos acompañantes</button>

        <?php
        //Pintar formulario a raíz de que el botón este pulsado para los nombres de los acompañantes
        if (isset($_POST['rellenar'])) {
            for ($i = 1; $i <= $_POST['numAcom']; $i++) {
                echo '<br>';
                echo '<div>';
                echo '<label>Nombre de acompañante: ' . $i . ' </label>';
                if (isset($_POST['nombres']))
                    $nombre=$_POST['nombres'][$i-1];
                    else
                    $texto ='';
                echo '<input name="nombres[]"
                    value="'.$nombre.'"/>';
                echo '</div> <br/>';
            } ?>

            <button type="submit" name="mostrar" value="mostrar"></button>
        <?php } ?>
    </form>
            <?php
                if(isset($_POST['mostrar'])){
            ?>
            <table>
                <tr>
                    <th>
                        Persona Principal
                        <?php 
                        echo $_POST['nombre'];
                        ?>
                    </th>
                    
                </tr>
                <tr><?php 
                    for($i=1;$i<=$_POST['numAcom'];$i++){
                        echo '<th>Acompañante: '.$i.'</th>';
                    }
                    ?></tr>
            </table><?php } ?>

</body>

</html>