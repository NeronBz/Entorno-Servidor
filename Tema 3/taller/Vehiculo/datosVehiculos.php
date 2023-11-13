<?php
function marcarOptionSeleccionado($option, $optionSeleccionado)
{
    if ($option == $optionSeleccionado) {
        return 'selected="selected"';
    }
}
?>
<div class="container p-5 my-5 border">
    <!-- Mostrar piezas y dar opción a modificar y borrar -->
    <?php
    if (isset($vehiculos)) {
        //Mostramos los vehículos en una tabla
    ?>
        <form action="" method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Propietario</th>
                        <th>Matrícula</th>
                        <th>Color</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vehiculos as $v) {
                        echo '<tr>';
                        if (isset($_POST['modif']) and $_POST['modif'] == $v->getId()) {
                            //Pintar campos para poder modificar
                            echo '<td> <input type="text" name="id" disabled="disabled" value="' . $v->getId() . '"></td>';
                            echo '<td> <input type="text" name="dni" value="' . $v->getDni() . '"></td>';
                            echo '<td> <input type="text" name="nombre" value="' . $v->getNombre() . '"></td>';
                            echo '<td> <select name="perfil">';
                            echo '<option value="A" ' . marcarOptionSeleccionado('Administrador', $v->getPerfil()) . '>Administrador</option>';
                            echo '<option value="M" ' . marcarOptionSeleccionado('Mecánico', $v->getPerfil()) . '>Mecánico</option>';
                            echo '</select></td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="update" value="' . $v->getId() . '">Guardar</button>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="cancelar">Cancelar</button>';
                            echo '</td>';
                        } else {
                            echo '<td>' . $v->getId() . '</td>';
                            echo '<td>' . $v->getDni() . '</td>';
                            echo '<td>' . $v->getNombre() . '</td>';
                            echo '<td>' . $v->getPerfil() . '</td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="modif" value="' . $v->getId() . '"><img src="../img/modif25.png"/></button>';
                            echo '<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#a' . $v->getId() . '" name="avisar" value="' . $v->getId() . '"><img src="../img/delete25.png"/></button>';
                            echo '</td>';
                        }
                        echo '</tr>';

                        //Definir ventana modal
                    ?>
                        <!-- The Modal -->
                        <div class="modal" id="a<?php echo $v->getId(); ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Borrar usuario</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        ¿Está seguro que desea borrar el usuario?
                                        <?php
                                        echo '"', $v->getDni(), '"-', $v->getNombre();
                                        ?>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" name="borrar" value="<?php echo $v->getId(); ?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </form>
    <?php
    }
    ?>
</div>