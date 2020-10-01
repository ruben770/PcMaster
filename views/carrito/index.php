<h1>Carrito de compras</h1>


<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
    <p>Puedes añadir o eliminar productos en tu carrito</p>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Eliminar</th>
        </tr>
        <?php foreach ($carrito as $indice => $elemento) :
            $producto = $elemento['producto'];
        ?>
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
                    <?= $elemento['unidades'] ?>
                    <div class="updown-unidades">
                        <a href="<?= base_url ?>carrito/down&index=<?= $indice ?>" class="button button-carrito button-red">-</a>
                        <a href="<?= base_url ?>carrito/up&index=<?= $indice ?>" class="button button-carrito">+</a>
                    </div>
                </td>
                <td>
                    <a href="<?= base_url ?>carrito/delete&index=<?= $indice ?>" class="button button-carrito button-red">Quitar Producto</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <div class="delete-carrito">
        <a href="<?= base_url ?>carrito/deleteAll" class="button button-delete button-red">Vaciar Carrito</a>
    </div>
    <?php $stats = Utils::statsCarrito(); ?>
    <div class="total-carrito">
        <h3>Precio total: $ <?= $stats['total'] ?></h3>
        <a href="<?= base_url ?>pedido/hacer" class="button button-pedido">COMPRAR</a>
    </div>
<?php else : ?>
    <p>Tu carrito está vacío, añade productos que quieras comprar con el botón Añadir al Carrito.</p>
<?php endif; ?>