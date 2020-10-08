<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= base_url ?>assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
    <link type="text/css" rel="stylesheet" href="<?= base_url ?>assets/css/materialize.min.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC MASTER RACE</title>
</head>

<body id="body" class="container">
    <!-- MOBILE HAMBURGER ICON SIDEVAR TRIGGER-->
    <nav class=" navbar hide-on-large-only">
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo"></a>
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="large material-icons">menu</i></a>
        </div>
    </nav>
    <!-- HEADER -->
    <header id="header">
        <div class="row" id="logo">
            <div class="col s12 m12 l12 center-align">
                <img class="center-align" src="<?= base_url ?>assets/img/logomaster.png" alt="PcMaster">
            </div>
        </div>
        <!-- FIN DE CABECERA -->
        <!-- MOBILE SIDEBAR -->
        <!-- SIDEBAR-->
        <ul id="slide-out" class="sidenav">
            <?php if (!isset($_SESSION['identity'])) : ?>
                <li>
                    <h5><b>Bienvenido</b></h5>
                </li>
                <div class="collection">
                    <a href="<?= base_url ?>Usuario/loginpage" class="collection-item waves-effect waves-red">Iniciar Sesión</a>
                    <a href="<?= base_url ?>Usuario/register" class="collection-item waves-effect waves-red">Registrarse</a>
                </div>
            <?php else : ?>
                <li>
                    <div class="user-view">
                        <div class="background">
                            <img src="<?= base_url ?>assets/img/back.jpg">
                        </div>
                        <a href="#user"><img class="circle" src="<?= base_url ?>assets/img/wasd.jpg"></a>
                        <a href="#name"><span class="white-text name"><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellidos ?></span></a>
                        <a href="#email"><span class="white-text email"><?= $_SESSION['identity']->email ?></span></a>
                    </div>
                </li>
            <?php endif; ?>
            <li>
                <h5><b>Mi carrito</b></h5>
            </li>
            <div class="collection">
                <?php $stats = Utils::statsCarrito()
                ?>
                <a href="<?= base_url ?>Carrito/index" class="collection-item waves-effect waves-red">Productos únicos (<?= $stats['count'] ?>)</a>
                <a href="<?= base_url ?>Carrito/index" class="collection-item waves-effect waves-red">Total: $ <?= $stats['total'] ?></a>
                <a href="<?= base_url ?>Carrito/index" class="collection-item waves-effect waves-red">Ver el carrito</a>
            </div>
            <?php if (isset($_SESSION['admin'])) : ?>
                <li>
                    <h5><b>Administrar</b></h5>
                </li>
                <div class="collection">
                    <a href="<?= base_url ?>Categoria/index" class="collection-item waves-effect waves-red">Administrar Categorias</a>
                    <a href="<?= base_url ?>Producto/gestion" class="collection-item waves-effect waves-red">Gestion de Productos</a>
                    <a href="<?= base_url ?>Pedido/gestion" class="collection-item waves-effect waves-red">Gestion de Pedidos</a>
                </div>

            <?php endif; ?>
            <?php if (isset($_SESSION['identity'])) : ?>

                <div class="collection">
                    <a href="<?= base_url ?>Pedido/mis_pedidos" class="collection-item waves-effect waves-red">Mis Pedidos</a>
                    <a href="<?= base_url ?>Usuario/logout" class="collection-item waves-effect waves-red">Cerrar Sesión</a>
                </div>
            <?php endif; ?>
        </ul>
    </header>

    <!-- MENU -->
    <?php $categorias = Utils::showCategorias(); ?>
    <nav id="menu" class="hide-on-med-and-down">
        <ul>
            <li><a href="<?= base_url ?>">Inicio</a></li>
            <?php while ($cat = $categorias->fetch_object()) : ?>
                <li><a href="<?= base_url ?>Categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a></li>
            <?php endwhile; ?>
        </ul>
    </nav>


    <div class="content">
        <!-- MOBILE MENU -->
        <div id="mobile-bar" class="row hide-on-large-only">
            <div class="col s12">
                <ul class="tabs">
                    <?php $categorias = Utils::showCategorias(); ?>
                    <li class="tab col s4 hide"><a class="active" target="_self" href="<?= base_url ?>">Inicio</a></li>
                    <li class="tab col s4"><a target="_self" href="<?= base_url ?>">Inicio</a></li>
                    <?php while ($cat = $categorias->fetch_object()) : ?>
                        <li class="tab col s4"><a target="_self" href="<?= base_url ?>Categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
        <div class="row">
            <!-- CONTENIDO CENTRAL -->
            <div class="col s12 m11 l10 xl10" id="central">