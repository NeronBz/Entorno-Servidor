<div class="container p-5 my-5 border">
    <!-- Mostrar piezas y dar opción a modificar y borrar -->
    <form action="" method="post">
        <label>Código Reparación:<?php echo $r->getId() ?></label>
        <label>Matrícula:<?php echo $r->getCoche() ?></label>
        <label>Fecha:<?php echo $r->getFecha() ?></label>
        <label>Tiempo:<?php echo $r->getTiempo() ?></label>
        <label>Pagado:<?php echo $r->getPagado() ?></label>
        <label>Usuario:<?php echo $r->getUsuario() ?></label>
        <label>PrecioH:<?php echo $r->getPrecioH() ?></label>
    </form>
</div>