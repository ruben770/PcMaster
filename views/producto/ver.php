<?php if (isset($prod)) : ?>
    <div id="detail-product">
        <div class="image">
            <h3 class="center-align"><b><?= $prod->nombre ?></b></h3>
            <hr>
            <br>
            <?php if ($prod->imagen != null) : ?>
                <img class="materialboxed responsive-img" data-caption="<?= $prod->nombre ?>" src="<?= base_url ?>uploads/images/<?= $prod->imagen ?>" alt="">
            <?php else : ?>
                <img class="responsive-img" src="<?= base_url ?>assets/img/wasd.jpg" alt="">
            <?php endif; ?>
        </div>
        <div class="data">
            <p class="description"><?= $prod->descripcion ?></p>
            <p class="price"><b>$<?= $prod->precio ?></b></p>
            <a href="<?= base_url ?>Carrito/add&id=<?= $prod->id ?>" class="btn waves-effect waves-light center-align"><i class="tiny material-icons right">add_shopping_cart</i>
                <b>Agregar</b>
            </a>
        </div>
    </div>
<?php else : ?>
    <h3>El producto no existe</h3>
    <hr>
<?php endif; ?>