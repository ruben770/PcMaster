<h3>Carrito de compras</h3>
<hr>
<br>


<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
    <p>Puedes añadir o eliminar productos en tu carrito</p>
    <table class="responsive-table centered striped">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <?php foreach ($carrito as $indice => $elemento) :
            $producto = $elemento['producto'];
        ?>
            <tr>
                <td>
                    <?php if ($producto->imagen != null) : ?>
                        <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="" class="img_carrito">
                    <?php else : ?>
                        <img src="<?= base_url ?>assets/img/logomaster.png" alt="" class="img_carrito">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                </td>
                <td>
                    $ <?= $producto->precio ?>
                </td>
                <td>
                    <a href="<?= base_url ?>carrito/down&index=<?= $indice ?>" class="col s4 m3 offset-m2 btn-small waves-effect waves-light red darken-4"><i class="tiny material-icons center-align">remove</i></a>
                    <span class="col s2"><?= $elemento['unidades'] ?></span>
                    <a href="<?= base_url ?>carrito/up&index=<?= $indice ?>" class="col s4 m3 btn-small waves-effect waves-light"><i class="tiny material-icons center-align">add</i></a>
                </td>
                <td>
                    <a href="<?= base_url ?>carrito/delete&index=<?= $indice ?>" class="col s6 offset-s4 pull-s2 m4 offset-m4 l6 offset-l2 btn-small waves-effect waves-light red darken-4 center-align"><i class="tiny material-icons center-align">delete</i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <div class="row">
        <a href="<?= base_url ?>carrito/deleteAll" class="col s2 offset-s1 white-text btn-small waves-effect waves-light red darken-4 ">Vaciar Carrito</a>
    </div>
    <?php $stats = Utils::statsCarrito(); ?>
    <div class="row">
        <h4 class="col s12"><b>Precio total:</b> $ <?= $stats['total'] ?></h4>
        <a href="<?= base_url ?>pedido/hacer" class="col s3 offset-s1 white-text btn-small waves-effect waves-light">COMPRAR</a>
    </div>
<?php else : ?>
    <p>Tu carrito está vacío, añade productos que quieras comprar con el botón Añadir al Carrito.</p>
<?php endif; ?>