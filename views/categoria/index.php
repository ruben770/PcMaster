<h3>Gestionar Categorías</h3>
<hr>
<br>
<a href="<?= base_url ?>Categoria/crear" class="waves-effect waves-light btn"><i class="material-icons right">library_add</i>Crear Categoria</a>
<table border="1" class="responsive-table centered highlight">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre de Categoría</th>
        </tr>
    </thead>
    <?php while ($cat = $categorias->fetch_object()) : ?>
        <tr>
            <td><?= $cat->id; ?></td>
            <td><?= $cat->nombre; ?></td>
        </tr>
    <?php endwhile; ?>

</table>