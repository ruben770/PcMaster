<h1>Crear una nueva categoría</h1>

<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
    <strong class="alert_green">Categoría añadida</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed' && isset($_SESSION['error'])) : ?>
    <strong class="alert_red">Registro fallido, <?php echo $_SESSION['error'] ?></strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('error'); ?>
<form action="<?= base_url ?>categoria/save" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required>
    <input type="submit" value="Guardar">
</form>