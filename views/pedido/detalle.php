<h1>Detalles del pedido</h1>
<?php if ((isset($pedido) && $pedido->usuario_id == $_SESSION['identity']->id) || isset($_SESSION['admin'])) : ?>

    <?php if (isset($_SESSION['admin'])) : ?>
        <h3>Cambiar el estado del pedido</h3>
        <form action="<?= base_url ?>Pedido/estado" method="post">
            <input type="hidden" name="id_pedido" value="<?= $pedido->id ?>">
            <select name="estado" id="">
                <option value="confirmed" <?= $pedido->estado == 'Confirmed' ? 'selected' : '' ?>>Pendiente de pago</option>
                <option value="preparation" <?= $pedido->estado == 'preparation' ? 'selected' : '' ?>>En preparación</option>
                <option value="ready" <?= $pedido->estado == 'ready' ? 'selected' : '' ?>>Envío en curso</option>
                <option value="sent" <?= $pedido->estado == 'sent' ? 'selected' : '' ?>>Entregado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
    <?php endif; ?>
    <h3>Domicilio a enviar:</h3>
    Estado: <?= $pedido->entidad ?> <br>
    Municipio: <?= $pedido->municipio ?> <br>
    Dirección: <?= $pedido->direccion ?><br>
    <h3>Datos del pedido:</h3>
    Estado del pedido: <?= Utils::showStatus($pedido->estado) ?> <br>
    Numero de pedido: <?= $pedido->id ?> <br>
    Total a pagar: $<?= $pedido->costo ?> <br>
    Productos: <br>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php while ($producto = $productos_pedido->fetch_object()) : ?>

            <tr>
                <td>
                    <?php if ($producto->imagen != null) : ?>
                        <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="" class="img_carrito">
                    <?php else : ?>
                        <img src="<?= base_url ?>assets/img/logomaster.png" alt="" class="img_carrito">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url ?>Producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                </td>
                <td>
                    $ <?= $producto->precio ?>
                </td>
                <td>
                    <?= $producto->unidades ?>
                </td>
            </tr>

        <?php endwhile; ?>
    </table>
<?php else : ?>
    <?php header('Location:' . base_url); ?>
<?php endif; ?>