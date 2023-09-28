<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 16</title>
</head>

<body>
    <table border="1">
        <form action="" method="post">
            <tr>
                <div>
                    <label>Num Alumnos</label>
                    
                    <input type="text" name="nAlum" value="<?php
                                                            if (isset($_POST['nAlum']))
                                                                echo $_POST['nAlum'];
                                                            else echo '';
                                                            ?>" />
                </div>
            </tr>
            <br/>
            <button type="submit" name="crear">Crear</button>
            <br/>
        <?php 
        if(isset($_POST['crear'])){

        
        ?><?php } ?>
        </form>
    </table>
</body>

</html>