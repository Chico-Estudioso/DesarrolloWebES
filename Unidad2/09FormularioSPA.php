<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularios nuevos</title>
</head>

<body>
    <form action="" method="post">
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
</body>

</html>