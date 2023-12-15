<?php
require_once 'Modelo.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    $bd = new Modelo();
    if ($bd->getConexion() == null) {
        $mensaje = "Error, no hay conexión";
    } else {
        $tiendas = $bd->obtenerTiendas();
        $productos_precio = $bd->obtenerProductosyPrecio();
        if (isset($_POST['tienda'])) {
            $_SESSION['tienda'] = $tienda;
        }
        if (isset($_POST['cambiar'])) {
            session_unset();
            header('location:mcDaw.php');
        }
        if (isset($_POST['agregar'])) {
            if (isset($_POST['cantidad']) <= 0) {
                $mensaje = 'La cantidad del producto 
                seleccionado tiene que ser mayor que 0';
            } else {
                $productoCesta = new ProductoEnCesta($_POST['producto'], $_POST['cantidad']);
                if (isset($_SESSION['cesta'])) {
                    $cesta = $_SESSION['cesta'];
                } else {
                    $cesta = array();
                }
                $cesta[] = $productoCesta;
                $_SESSION['cesta'] = $cesta;
            }
        }
        if (isset($_POST['crearPedido'])) {
            if ($contenido_cesta == null) {
                $mensaje = 'No hay contenido en la cesta';
            } else {
                if ($bd->crearPedido($_SESSION['tienda'], $_SESSION['producto'])) {
                    session_destroy($cesta);
                    $mensaje='Pedido nº'
                }
            }
        }
    }
    ?>
    <div>
        <h1 style='color:red;'>
            <?php echo isset($mensaje) ? $mensaje : ''; ?>
        </h1>
    </div>
    <form action="mcDaw.php" method="post">
        <div>
            <?php
            if (!isset($_POST['selTienda'])) {
            ?>
                <h1 style='color:blue;'>Tienda</h1>
                <label for="tienda">Tienda</label><br />
                <select name="tienda">
                    <?php
                    foreach ($tiendas as $t) {
                        echo "<option value='" . $t->getCodigo() . "'" . ">" . $t->getNombre() . "</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="selTienda">Seleccionar tienda</button>
        </div>
    <?php
            } elseif (isset($_POST['selTienda'])) {
    ?>
        <div>
            <h1 style='color:blue;'>Añade productos a la cesta</h1>
            <h2 style='color:green;'>Datos Tienda: Nombre - Teléfono
                <button type="submit" name="cambiar">Cambiar Tienda</button>
            </h2>
            <table>
                <tr>
                    <td><label for="producto">Producto</label><br /></td>
                    <td><label for="cantidad">Cantidad</label><br /></td>
                    <td>Añadir a la cesta</td>
                </tr>
                <tr>
                    <td>
                        <select id="producto" name="producto">
                            <?php
                            foreach ($productos_precio as $pp) {
                                echo "<option value='" . $pp->getCodigo() . "'" . ">" . $pp->getNombre() . " - " . $pp->getPrecio() . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td><input id="cantidad" type="number" name="cantidad" value="1" /></td>
                    <td><button type="submit" name="agregar">+</button></td>
                </tr>
            </table>
        </div>
        <div>
            <h1 style='color:blue;'>Contenido de la cesta</h1>
            <table border="1" rules="all" width="25%">
                <tr>
                    <td><b>Producto</b></td>
                    <td><b>Cantidad</b></td>
                    <td><b>Precio</b></td>
                </tr>

                <?php
                foreach ($cesta as $c) {
                    echo '<tr>';
                    echo '<td align="left">' . $c[0] . '</td>';
                    echo '<td align="left">' . $c[1] . '</td>';
                    echo '<td align="left">' . $c[2] . '</td>';
                }
                ?>
            </table>
            <button type="submit" name="crearPedido">Crear Pedido</button>
        </div>
    <?php
            }
    ?>
    </form>
</body>

</html>