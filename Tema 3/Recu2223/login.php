<?php
require_once 'Modelo.php';
?>
<?php
$bd = new Modelo();
if ($bd->getConexion() == null) {
    $mensaje = "Error, no hay conexión";
} else {
    if (isset($_POST['acceder'])) {
        if (empty($_POST['usuario']) or empty($_POST['ps'])) {
            //Mostrar error
            $mensaje = 'Error, rellena us y ps';
        } else {
            //Hacer login
            //Recuperar info del usuario
            $usuario = $bd->obtenerUsuario($_POST['usuario'], $_POST['ps']);
            if ($usuario == null) {
                $mensaje = 'Error, no existe usuario';
            } else {
                //Guardar usuario en sesión
                session_start();
                $_SESSION['usuario'] = $usuario;
                if ($usuario->getTipo() == 'A') {
                    header('location:crearCliente.php');
                } elseif ($usuario->getTipo() == 'C') {
                    $cliente = $bd->obtenerCliente($_POST['usuario']);
                    if ($cliente->getBaja() == 1) {
                        $mensaje = 'Este cliente está dado de baja';
                    } else {
                        header('location:misActividades.php');
                    }
                } else {
                    echo 'No funciona';
                }
            }
        }
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Recuperación T3 22_23</title>
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