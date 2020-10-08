<h3>Crear una nueva categoría</h3>

<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
    <strong class="alert_green">Categoría añadida</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed' && isset($_SESSION['error'])) : ?>
    <strong class="alert_red">Registro fallido, <?php echo $_SESSION['error'] ?></strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('error'); ?>
<div class="row add-category">
    <form action="<?= base_url ?>Categoria/save" method="post">
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">library_add</i>
            <input id="icon_prefix" type="text" name="nombre" required>
            <label for="icon_prefix">Nombre de categoría</label>
        </div>
        <div class="col s12 m6 boton">
            <button class="btn waves-effect waves-light" type="submit">Guardar<i class="material-icons right">send</i></button>
        </div>
    </form>
</div>