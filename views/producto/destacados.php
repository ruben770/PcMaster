<h2 class="center-align"><b>Productos destacados</b></h2>
<hr> <br>

<div class="row">
    <?php while ($prod = $productos->fetch_object()) : ?>
        <div class="card hoverable col s10 offset-s1 m3 offset-m1 l3 offset-l1">
            <div class="card-image">
                <a href="<?= base_url ?>producto/ver&id=<?= $prod->id ?>">
                    <?php if ($prod->imagen != null) : ?>
                        <img class="responsive-img" src="<?= base_url ?>uploads/images/<?= $prod->imagen ?>">
                    <?php else : ?>
                        <img src="<?= base_url ?>assets/img/logomaster.png">
                    <?php endif; ?>
                    <a href="<?= base_url ?>carrito/add&id=<?= $prod->id ?>" class="btn-floating hoverable halfway-fab waves-effect waves-light red"><i class="material-icons">add_shopping_cart</i></a>
                </a>
            </div>
            <div class="card-content">
                <a href="<?= base_url ?>producto/ver&id=<?= $prod->id ?>" class="truncate"><?= $prod->nombre ?></a>
                <p>$ <?= $prod->precio ?></p>
            </div>
        </div>
    <?php endwhile; ?>
</div>