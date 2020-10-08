</div>
<!-- BARRA LATERAL -->
<div class="col hide-on-med-and-down l2 xl2" id="lateral">
    <div id="carrito" class="block_aside">
        <h5><b>Mi carrito</b></h5>
        <ul>
            <?php $stats = Utils::statsCarrito() ?>
            <li><a href="<?= base_url ?>Carrito/index">Productos (<?= $stats['count'] ?>)</a></li>
            <li><a href="<?= base_url ?>Carrito/index">Total: $ <?= $stats['total'] ?></a></li>
            <li><a href="<?= base_url ?>Carrito/index">Ver el carrito</a></li>
        </ul>
    </div>
    <br>
    <div id=" login" class="block_aside">
        <?php if (!isset($_SESSION['identity'])) : ?>
            <h5><b>Iniciar Sesión</b></h5>
            <form action="<?= base_url ?>Usuario/login " method="post">
                <div class="row">
                    <div class="input-field col 12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="icon_prefix" type="text" name="email">
                        <label for="icon_prefix">Email</label>
                    </div>
                    <div class="input-field col 12">
                        <i class="material-icons prefix">lock</i>
                        <input id="icon_password" type="password" name="password">
                        <label for="icon_password">Contraseña</label>
                    </div>
                    <button class="btn-small waves-effect waves-light center-align" type="submit">Iniciar Sesión</button>
                </div>

                <!-- <label for="email">Email</label>
                <input type="email" name="email" id="">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="">
                <input type="submit" value="Iniciar Sesión"> -->
            </form>
        <?php else : ?>
            <h5><b>Bienvenido, <?= $_SESSION['identity']->nombre ?></b></h5>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_login'])) : ?>
            <strong class="alert_red"><?= $_SESSION['error_login'] ?></strong>
        <?php endif; ?>
        <?php Utils::deleteSession('error_login'); ?>
        <ul>
            <?php if (isset($_SESSION['admin'])) : ?>
                <li><a href="<?= base_url ?>Categoria/index">Administrar Categorias</a></li>
                <li><a href="<?= base_url ?>Producto/gestion">Gestion de Productos</a></li>
                <li><a href="<?= base_url ?>Pedido/gestion">Gestion de Pedidos</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['identity'])) : ?>
                <li><a href="<?= base_url ?>Pedido/mis_pedidos">Mis Pedidos</a></li>
                <li><a href="<?= base_url ?>Usuario/logout">Cerrar Sesión</a></li>
            <?php else : ?>
                <li><a href="<?= base_url ?>Usuario/register">Registrarse</a></li>
            <?php endif; ?>
        </ul>


    </div>
</div>
</div>
</div>
<!-- FOOTER -->
<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12 valign-wrapper">
                <h5 class="white-text center-align">PC Master</h5>
            </div>
            <div class="col l4 offset-l2 s12 center-align">
                <h5 class="white-text">Mi Carrito</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="<?= base_url ?>Carrito/index">Productos (<?= $stats['count'] ?>)</a></li>
                    <li><a class="grey-text text-lighten-3" href="<?= base_url ?>Carrito/index">Total: $ <?= $stats['total'] ?></a></li>
                    <li><a class="grey-text text-lighten-3" href="<?= base_url ?>Carrito/index">Ver el carrito</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright valign-wrapper">
        <div class="container center-align">
            © Desarrollado por Rubén Campos González 2020.
            <a class="grey-text text-lighten-4 right" href="#">Ir Arriba</a>
        </div>
    </div>
</footer>
<script type="text/javascript" src="<?= base_url ?>assets/js/materialize.min.js"></script>
<script type="text/javascript" src="<?= base_url ?>assets/js/init.js"></script>
</body>

</html>