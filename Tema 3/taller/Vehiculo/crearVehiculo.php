<div class="container p-3 my-3 border">
    <!-- Crear Vehículo -->
    <form action="" method="post">
        <div class="row">
            <div class="col">
                <label>Propietario</label>
            </div>
            <div class="col">
                <label>Matrícula</label>
            </div>
            <div class="col">
                <label>Color</label>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                $propietarios = $bd->obtenerPropietarios()
                ?>
                <select name="propietario">
                    <?php foreach ($propietarios as $p) {
                        echo '<option value="' . $p->getId() . '">' . $p->getDni() . '-' . $p->getNombre() . '</option>';
                    }
                    ?>
                </select>
                <button type="button" name="crearP" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#crearPropietario">+</button>
            </div>
            <div class="col">
                <input type="text" name="matricula" placeholder="1234ABC" pattern="[0-9]{4}[A-Z]{3}" />
            </div>
            <div class="col">
                <input type="color" name="color">
            </div>
            <div class="col">
                <input type="submit" name="crear" value="Crear" class="btn btn-outline-dark" />
                <input type="submit" name="mostrarV" value="Vehículos" class="btn btn-outline-dark" />
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