<div class="container p-5 my-5 border">
    <!-- Mostrar piezas y dar opción a modificar y borrar -->
    <?php
    if (isset($_SESSION['propietario'])) {
        $vehiculos = $bd->obtenerVehiculos($_SESSION['propietario']);
        //Mostramos los vehículos en una tabla
    ?>
        <form action="" method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Matrícula</th>
                        <th>Color</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vehiculos as $v) {
                        echo '<tr>';
                        if (isset($_POST['modif']) and $_POST['modif'] == $v->getCodigo()) {
                            //Pintar campos para poder modificar
                            echo '<td> <input type="text" name="codigo" disabled="disabled" value="' . $v->getCodigo() . '"></td>';
                            echo '<td> <input type="text" name="matricula" value="' . $v->getMatricula() . '"></td>';
                            echo '<td> <input type="color" name="color" value="' . $v->getColor() . '"></td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="update" value="' . $v->getCodigo() . '">Guardar</button>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="cancelar">Cancelar</button>';
                            echo '</td>';
                        } else {
                            echo '<td>' . $v->getCodigo() . '</td>';
                            echo '<td>' . $v->getMatricula() . '</td>';
                            echo '<td> <input type="color" name="color" disabled="disabled" value="' . $v->getColor() . '"></td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="modif" value="' . $v->getCodigo() . '"><img src="../img/modif25.png"/></button>';
                            echo '<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#a' . $v->getCodigo() . '" name="avisar" value="' . $v->getCodigo() . '"><img src="../img/delete25.png"/></button>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="mostrarR" value="' . $v->getCodigo() . '">Reparaciones</button>';
                            echo '</td>';
                        }
                        echo '</tr>';

                        //Definir ventana modal
                    ?>
                        <!-- The Modal -->
                        <div class="modal" id="a<?php echo $v->getCodigo(); ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Borrar usuario</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        ¿Está seguro que desea borrar el vehículo?
                                        <?php
                                        echo $v->getMatricula();
                                        ?>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" name="borrar" value="<?php echo $v->getCodigo(); ?>" class="btn btn-danger" data-bs-dismiss="modal">Borrar</button>
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