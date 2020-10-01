<?php if (isset($pedidos) && $pedidos->num_rows > 0) : ?>
    <?php if (isset($gestion)) : ?>
        <h1>Gestion de pedidos</h1>
    <?php else : ?>
        <h1>Mis pedidos</h1>
    <?php endif; ?>

    <table>
        <tr>
            <th># de Pedido</th>
            <th>Costo</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
        <?php while ($pedido = $pedidos->fetch_object()) :
        ?>
            <tr>
                <td>
                    <a href="<?= base_url ?>pedido/detalle&id=<?= $pedido->id ?>"><?= $pedido->id ?></a>
                </td>
                <td>
                    $ <?= $pedido->costo ?>
                </td>
                <td>
                    <?= $pedido->fecha ?>
                </td>
                <td>
                    <?= Utils::showStatus($pedido->estado) ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else : ?>
    <?php if (isset($gestion)) : ?>
        <h1>Aún no hay pedidos</h1>
    <?php else : ?>
        <h1>Aún no tienes pedidos, agrega productos a tu carrito y finaliza el registro para hacer un pedido.</h1>
    <?php endif; ?>

<?php endif; ?>