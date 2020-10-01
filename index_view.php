<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a PcParts</title>
</head>

<body>
    <!-- HEADER -->
    <header id="header">
        <div id="logo">
            <img src="assets/img/wasd.jpg" alt="PcPartsLogo">
            <a href="index.php">
                Pc Componentes para Todos
            </a>
        </div>
    </header>

    <!-- MENU -->
    <nav id="menu">
        <ul>
            <li><a href="">Inicio</a></li>
            <li><a href="">Categoria</a></li>
            <li><a href="">Categoria</a></li>
            <li><a href="">Categoria</a></li>
            <li><a href="">Categoria</a></li>
            <li><a href="">Categoria</a></li>
        </ul>
    </nav>

    <div id="content">
        <!-- BARRA LATERAL -->
        <aside id="lateral">
            <div id="login" class="block_aside">
                <h3>Inicia Sesión</h3>
                <form action="#" method="post">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="">
                    <input type="submit" value="Enviar">
                </form>
                <ul>
                    <li><a href="#">Mis Pedidos</a></li>
                    <li><a href="#">Gestion de Pedidos</a></li>
                    <li><a href="#">Administrar Categorias</a></li>
                </ul>


            </div>
        </aside>
        <!-- CONTENIDO CENTRAL -->
        <div id="central">
            <h1>Más Vendido</h1>
            <div class="product">
                <img src="assets/img/wasd.jpg" alt="">
                <h2>RTX 2080 TI</h2>
                <p>$15,000</p>
                <a href="" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/wasd.jpg" alt="">
                <h2>RTX 2080 TI</h2>
                <p>$15,000</p>
                <a href="" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/wasd.jpg" alt="">
                <h2>RTX 2080 TI</h2>
                <p>$15,000</p>
                <a href="" class="button">Comprar</a>
            </div>

        </div>
    </div>
    <!-- FOOTER -->
    <footer id="footer">
        <p>Desarrollado por Rubén Campos González &copy; <?= date('Y'); ?></p>
    </footer>
</body>

</html>