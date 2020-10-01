<h1>Gestión de Productos</h1>
<a href="<?= base_url ?>producto/crear" class="button button-small">Crear Producto</a>
<?php if (isset($_SESSION['deledit']) && $_SESSION['deledit'] == 'deleted') : ?>
    <strong class="alert_green">Producto eliminado</strong>
<?php elseif (isset($_SESSION['deledit']) && $_SESSION['deledit'] == 'deletefail' && isset($_SESSION['errord'])) : ?>
    <strong class="alert_red">Eliminacion de producto fallida, <?php echo $_SESSION['errord'] ?></strong>
<?php endif; ?>
<?php Utils::deleteSession('deledit'); ?>
<?php Utils::deleteSession('errord'); ?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Categoria</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Oferta</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>
    <?php while ($prod = $productos->fetch_object()) : ?>
        <tr>
            <td><?= $prod->id; ?></td>
            <td><?= $prod->categoria_id; ?></td>
            <td><?= $prod->nombre; ?></td>
            <td><?= $prod->descripcion; ?></td>
            <td><?= $prod->precio; ?></td>
            <td><?= $prod->stock; ?></td>
            <td><?= $prod->oferta; ?></td>
            <td><?= $prod->fecha; ?></td>
            <td>
                <a href="<?= base_url ?>producto/editar&id=<?= $prod->id ?>" class="button button-gestion">Editar</a>
                <a href="<?= base_url ?>producto/eliminar&id=<?= $prod->id ?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>

</table>