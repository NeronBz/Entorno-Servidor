<?php
function marcarOptionSeleccionado($option, $optionSeleccionado)
{
    if ($option == $optionSeleccionado) {
        return 'selected="selected"';
    }
}
?>
<div class="container p-3 my-3 border">
    <!-- Crear Vehículo -->
    <form action="" method="post">
        <div class="row">
            <div class="col">
                <label>Pieza</label>
            </div>
            <div class="col">
                <label>Cantidad</label>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                $piezas = $bd->obtenerPiezas()
                ?>
                <select name="pieza">
                    <?php
                    foreach ($piezas as $p) {
                        echo '<option value="' . $p->getCodigo() . '">' . $p->getClase() . '-' . $p->getDescripcion() . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <input type="number" name="cantidad" value="1" />
            </div>
            <div class="col">
                <input type="submit" name="crearPR" value="Crear" class="btn btn-outline-dark" />
                <input type="reset" name="limpiar" value="Cancelar" class="btn btn-outline-dark" />
            </div>
        </div>
    </form>
</div>
<!-- The Modal -->
<div class="modal" id="crearPropietario">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Propietario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="" method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <label for="dni">DNI</label>
                    <input id="dni" type="text" name="dni" placeholder="1111111A">
                    <br>
                    <label for="nombre">Nombre</label>
                    <input id="nombre" type="text" name="nombre" placeholder="1111111A">
                    <br>
                    <label>Telefono</label>
                    <input type="text" name="telefono" placeholder="62210792">
                    <br>
                    <label>Email</label>
                    <input type="text" name="email" placeholder="aa@aa.com">
                    <br>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="insertarP" class="btn btn-success" data-bs-dismiss="modal">Crear</button>
                    <button type="button" name="cancelar" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>

        </div>
    </div>
</div>