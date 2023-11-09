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
    if ($bd->getConexion() != null) {
        //Obtener usuarios
        $usuarios = $bd->obtenerUsuarios();
        //Mostramos los usuarios en una tabla
    ?>
        <form action="" method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Perfil</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($usuarios as $u) {
                        echo '<tr>';
                        if (isset($_POST['modif']) and $_POST['modif'] == $u->getId()) {
                            //Pintar campos para poder modificar
                            echo '<td> <input type="text" name="id" disabled="disabled" value="' . $u->getId() . '"></td>';
                            echo '<td> <input type="text" name="dni" value="' . $u->getDni() . '"></td>';
                            echo '<td> <input type="text" name="nombre" value="' . $u->getNombre() . '"></td>';
                            echo '<td> <select name="perfil">';
                            echo '<option value="A" ' . marcarOptionSeleccionado('Administrador', $u->getPerfil()) . '>Administrador</option>';
                            echo '<option value="M" ' . marcarOptionSeleccionado('Mecánico', $u->getPerfil()) . '>Mecánico</option>';
                            echo '</select></td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="update" value="' . $u->getId() . '">Guardar</button>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="cancelar">Cancelar</button>';
                            echo '</td>';
                        } else {
                            echo '<td>' . $u->getId() . '</td>';
                            echo '<td>' . $u->getDni() . '</td>';
                            echo '<td>' . $u->getNombre() . '</td>';
                            echo '<td>' . $u->getPerfil() . '</td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="modif" value="' . $u->getId() . '"><img src="../img/modif25.png"/></button>';
                            echo '<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#a' . $u->getId() . '" name="avisar" value="' . $u->getId() . '"><img src="../img/delete25.png"/></button>';
                            echo '</td>';
                        }
                        echo '</tr>';

                        //Definir ventana modal
                    ?>
                        <!-- The Modal -->
                        <div class="modal" id="a<?php echo $u->getId(); ?>">
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
                                        echo '"', $u->getDni(), '"-', $u->getNombre();
                                        ?>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" name="borrar" value="<?php echo $u->getId(); ?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
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