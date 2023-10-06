<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <div>
            <label for="num">Nº de Opciones</label>
            <input type="number" id="num" name="numero" value="<?php echo (isset($_POST['numero']) ? $_POST['numero'] : 1); ?>" required="require">
            <br> <input type="submit" name="rellenar" value="Rellenar Opciones">
        </div>
    </form>
    <div>
        <?php
        if (isset($_POST['rellenar'])) {
        ?>Color Fondo:<input type="color" name="color">
        <br>
        Color Texto:<input type="color" name="colorI">
        <br>
    <?php
            for ($i = 0; $i < $_POST['numero']; $i++) {
                echo '<input type="text" name="opciones[]" placeholder="Opción:' . $i . '"/>';
            }
        }
    ?>
    </div>
</body>

</html>