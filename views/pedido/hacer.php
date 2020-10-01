<?php if (isset($_SESSION['identity'])) : ?>
    <h1>Preparemos los detalles de tu pedido</h1>
    <p>
        <a href="<?= base_url ?>carrito/index">Ve tus productos y precios.</a>
    </p>
    <br>
    <h3>Datos de tu domicilio para el envío:</h3>
    <form action="<?= base_url ?>pedido/add" method="post">
        <label for="estado">Estado</label>
        <input type="text" name="estado" required>

        <label for="municipio">Municipio</label>
        <input type="text" name="municipio" required>

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" required>

        <input type="submit" value="Confirmar Pedido">

    </form>
<?php else : ?>
    <h1>Identificación es necesaria.</h1>
    <p>Necesitas iniciar sesión en para poder pagar tu pedido.</p>
<?php endif; ?>