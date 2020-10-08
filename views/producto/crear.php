<?php if (isset($edit) && isset($prod) && is_object($prod)) : ?>
    <h1>Editar un Producto: <?= $prod->nombre ?></h1>
    <?php $url_action = base_url . "Producto/save&id=" . $prod->id; ?>
<?php else : ?>
    <h1>Añadir Nuevos Productos</h1>
    <?php $url_action = base_url . "Producto/save"; ?>
    <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
        <strong class="alert_green">Producto añadido</strong>
    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed' && isset($_SESSION['error'])) : ?>
        <strong class="alert_red">Registro fallido, <?php echo $_SESSION['error'] ?></strong>
    <?php endif; ?>
    <?php Utils::deleteSession('register'); ?>
    <?php Utils::deleteSession('error'); ?>
<?php endif; ?>
<div class="form_container">

    <form action="<?= $url_action ?>" method="post" enctype="multipart/form-data">
        <label for="categoria">Categoria</label>
        <?php $categorias = Utils::showCategorias() ?>
        <select name="categoria" required>
            <?php while ($cat = $categorias->fetch_object()) : ?>
                <option value="<?= $cat->id ?>" <?= isset($prod) && is_object($prod) && $cat->id == $prod->categoria_id ? 'selected' : '' ?>>
                    <?= $cat->nombre ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= isset($prod) && is_object($prod) ? $prod->nombre : '' ?>">

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" placeholder="opcional" rows="4"><?= isset($prod) && is_object($prod) ? $prod->descripcion : '' ?></textarea>

        <label for="precio">Precio</label>
        <input type="number" name="precio" step="0.01" min="0" value="<?= isset($prod) && is_object($prod) ? $prod->precio : '' ?>">

        <label for="stock">Stock</label>
        <input type="number" name="stock" min="0" value="<?= isset($prod) && is_object($prod) ? $prod->stock : '' ?>">

        <label for="oferta">Oferta</label>
        <input type="text" name="oferta" placeholder="opcional" maxlength="2" value="<?= isset($prod) && is_object($prod) ? $prod->oferta : '' ?>">

        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" value="<?= isset($prod) && is_object($prod) ? $prod->fecha : '' ?>">

        <label for="imagen">Imagen</label>
        <?php if (isset($prod) && is_object($prod) && !empty($prod->imagen)) :  ?>
            <img src="<?= base_url ?>uploads/images/<?= $prod->imagen ?>" alt="" class="thumb">
        <?php endif; ?>
        <input type="file" name="imagen">
        <input type="submit" value="Guardar">


    </form>
</div>