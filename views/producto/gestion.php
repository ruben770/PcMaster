<h3>Gestión de Productos</h3>
<hr>
<br>
<a href="<?= base_url ?>Producto/crear" class="btn waves-effect waves-light"><i class="tiny material-icons right">add</i>Crear Producto</a>
<?php if (isset($_SESSION['deledit']) && $_SESSION['deledit'] == 'deleted') : ?>
    <strong class="alert_green">Producto eliminado</strong>
<?php elseif (isset($_SESSION['deledit']) && $_SESSION['deledit'] == 'deletefail' && isset($_SESSION['errord'])) : ?>
    <strong class="alert_red">Eliminacion de producto fallida, <?php echo $_SESSION['errord'] ?></strong>
<?php endif; ?>
<?php Utils::deleteSession('deledit'); ?>
<?php Utils::deleteSession('errord'); ?>
<table border="1" class="responsive-table centered highlight">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Oferta</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <?php while ($prod = $productos->fetch_object()) : ?>
        <tr>
            <td><?= $prod->id; ?></td>
            <td><a href="<?= base_url ?>Producto/ver&id=<?= $prod->id ?>"><?= $prod->nombre; ?></a></td>
            <td><?= $prod->precio; ?></td>
            <td><?= $prod->stock; ?></td>
            <td><?= $prod->oferta; ?></td>
            <td><?= $prod->fecha; ?></td>
            <td class="row">
                <a href="<?= base_url ?>Producto/editar&id=<?= $prod->id ?>" class="col s5 btn-small waves-effect waves-light center-align"><i class="tiny material-icons">edit</i></a>
                <a href="<?= base_url ?>Producto/eliminar&id=<?= $prod->id ?>" class="col s5 offset-s1 btn-small waves-effect waves-light center-align red darken-4"><i class="tiny material-icons">delete</i></a>
            </td>
        </tr>
    <?php endwhile; ?>

</table>