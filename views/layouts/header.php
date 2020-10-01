<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= base_url ?>assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?= base_url ?>assets/css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC MASTER RACE</title>
</head>

<body>
    <!-- HEADER -->
    <header id="header">
        <div id="logo">
            <img src="<?= base_url ?>assets/img/wasd.jpg" alt="PcPartsLogo">
            <a href="<?= base_url ?>">
                Pc MASTER RACE
            </a>
        </div>
    </header>

    <!-- MENU -->
    <?php $categorias = Utils::showCategorias(); ?>
    <nav id="menu">
        <ul>
            <li><a href="<?= base_url ?>">Inicio</a></li>
            <?php while ($cat = $categorias->fetch_object()) : ?>
                <li><a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a></li>
            <?php endwhile; ?>
        </ul>
    </nav>

    <div id="content">