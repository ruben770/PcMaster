<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') : ?>
    <h1>Tu pedido se ha confirmado.</h1>
    <p>
        Tu pedido ha sido registrado con éxito, prosigue a pagar el monto total
        de tu orden con una transferencia bancaria a la cuenta X-X-X-X-X-X-X-X-X-X-X para que podamos enviártelo a casa lo más pronto posible.
    </p>
    <br>
    <?php if (isset($pedido)) : ?>
        <h3>Datos del pedido:</h3>
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
                            <img src="<?= base_url ?>assets/img/wasd.jpg" alt="" class="img_carrito">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
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

    <?php endif; ?>
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'failed' && isset($_SESSION['error'])) : ?>
    <strong class="alert_red">No se puede completar el pedido, <?php echo $_SESSION['error'] ?></strong>
<?php endif; ?>