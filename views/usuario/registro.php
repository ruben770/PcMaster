<h1>Registro de Usuarios</h1>
<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
    <strong class="alert_green">Registro completado</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed' && isset($_SESSION['error'])) : ?>
    <strong class="alert_red">Registro fallido, <?php echo $_SESSION['error'] ?></strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>
<?php Utils::deleteSession('error'); ?>

<form action="<?= base_url ?>Usuario/save" method="post">
    <label for="nombre">Nombre</label>
    <?php if (isset($_SESSION['data'])) : ?>
        <?php var_dump($_SESSION['data'][0]) ?>
    <?php endif; ?>
    <input type="text" name="nombre" value="">

    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos">

    <label for="email">Email</label>
    <input type="email" name="email">

    <label for="password">Contraseña</label>
    <input type="password" name="password">

    <input type="submit" value="Registrarse">

</form>
<?php Utils::deleteSession('data'); ?>