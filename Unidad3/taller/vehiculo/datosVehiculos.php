
<div class="container p-2 my-2 border">
    <!-- Mostrar usuarios y dar opción a modificar y borrar -->
    <?php
    if (isset($_SESSION['propietario'])) {
        //Mostramos las piezas en una tabla
        $vehiculos=$bd->obtenerVehiculos($_SESSION['propietario']);
    ?>
        <form action="#" method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Propietario</th>
                        <th>Matricula</th>
                        <th>Color</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($vehiculos as $v) {
                        echo '<tr>';
                        if (isset($_POST['modif']) and $_POST['modif'] == $v->getCodigo()) {
                            //Pintar campos para poder modificar
                            echo '<td> <input type="text" name="codigo" disabled="disabled" value="' . $v->getCodigo() . '"/></td>';
                            echo '<td> <input type="text" name="propietario" disabled="disabled" value="' . $v->getPropietario() . '"/></td>';
                            echo '<td> <input type="text" name="matricula" value="' . $v->getMatricula() . '"/></td>';
                            echo '<td> <input type="color" name="color" value="' . $v->getColor() . '"/></td>';
                            echo '</select></td>';
                            echo '<td>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="update" value="' . $v->getCodigo() . '">Guardar</button>';
                            echo '<button type="submit" class="btn btn-outline-dark" name="cancelar">Cancelar</button>';
                            echo '</td>';
                        } else {
                        }
                        echo '<td>' . $v->getCodigo() . '</td>';
                        echo '<td>' . $v->getPropietario() . '</td>';
                        echo '<td>' . $v->getMatricula() . '</td>';
                        echo '<td> <input type="color" name="color" disabled="disabled" value="' . $v->getColor() . '"/></td>';
                        echo '<td>';
                        echo '<button type="submit" class="btn btn-outline-dark" name="modif" value="' . $v->getCodigo() . '"><img src="../icon/modif25.png"/></button>';
                        echo '<button type="button" class="btn btn-outline-dark"  data-bs-toggle="modal"  data-bs-target="#a' . $v->getCodigo() . '" - ' . $v->getPropietario() . '"><img src="../icon/delete25.png"/></button>';
                        echo '</td>';

                        echo '</tr>';

                        //Definir ventana modal
                    ?>
                        <!-- The Modal -->
                        <div class="modal" id="a<?php echo $v->getCodigo(); ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Borrar Vehiculo</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        ¿Está seguro que desea borrar el vehiculo
                                        <?php
                                        echo '-', $v->getMatricula();
                                        ?>?
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