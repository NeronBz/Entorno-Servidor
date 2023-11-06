<?php
//Ver si hay usuario logueado
session_start();
$us = null;
if (isset($_SESSION['usuario'])) {
    $us = $_SESSION['usuario'];
} else {
    //Redirigir al login
    header('location:../Usuario/login.php');
}

?>
<!-- Grey with black text -->
<nav class="navbar navbar-expand-sm bg-light navbar-light">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <?php
            if ($us->getPerfil == 'A') {
                echo '<li class="nav-item">
                <a class="nav-link active" href="">Usuarios</a>
            </li>';
            }
            ?>

            <li class="nav-item">
                <a class="nav-link" href="controllerPieza.php">Piezas</a>
            </li>
            <li class="nav-item">
                <?php echo $us != null ? $us->getNombre() : ""; ?>
            </li>
            <li class="nav-item">
                <?php echo $us->getNombre() ?>
                <a href="../taller/Usuario/login.php?accion=cerrar" class="nav-link active"></a>
            </li>
        </ul>
    </div>
</nav>