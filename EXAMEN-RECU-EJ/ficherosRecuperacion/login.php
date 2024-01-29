<?php
require_once 'Modelo.php';
require_once 'Usuario.php';
require_once 'Cliente.php';
$bd = new Modelo();

if ($bd->getConexion() == null) {
    $mensaje = 'Error, no hay conexión con la bd';
} else {
    if (isset($_POST['acceder'])) {
        if (empty($_POST['usuario']) or empty($_POST['ps'])) {
            $mensaje = 'Error, rellena us y ps';
        } else {
            $user = $bd->obtenerUsuario($_POST['usuario'], $_POST['ps']);
            if ($user != null) {
                session_start();
                $_SESSION['usuario'] = $user;
                if ($user->getTipo() == 'A') {
                    header("location:crearCliente.php");
                } elseif ($user->getTipo() == 'C') {
                    $cliente = $bd->obtenerCliente($user->getUsuario());
                    if ($cliente != null) {
                        header("location:misActivades.php");
                    } else {
                        $mensaje = 'Error, no se ha encontrado este cliente';
                    }
                }
            } else {
                $mensaje = 'Error, usuario no encontrado o contraseña errónea';
            }
        }
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Recuperaci�n T3 22_23</title>
</head>

<body>
    <div>
        <h1 style='color:red;'>
            <?php echo isset($mensaje) ? $mensaje : ''; ?>
        </h1>
    </div>
    <form action="login.php" method="post">
        <h1>SuperGim</h1>
        <div>
            <label for="usuario">Usuario</label><br />
            <input type="text" id="usuario" name="usuario" />
        </div>
        <div>
            <label for="ps">Contraseña</label><br />
            <input type="password" id="ps" name="ps" />
        </div>
        <br /><button type="submit" name="acceder">Acceder</button>
    </form>
</body>

</html>