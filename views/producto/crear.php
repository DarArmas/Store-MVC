<?php if (isset($edit) && isset($pro) && is_object($pro)) : ?>
    <h1>Editar producto <?= $pro->nombre ?></h1>
    <?php $url_action = base_url . "producto/save&id=" . $pro->id; ?>
<?php else: ?>
    <h1>Añadir nuevos producto</h1>
    <?php $url_action = base_url . "producto/save"; ?>
<?php endif; ?>

<div class="form_container">
    <form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
        <!--PARA PODER SUBIR IMAGENES-->
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value='<?= isset($pro) && is_object($pro) ? $pro->nombre : '' ?>' />

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"> <?= isset($pro) && is_object($pro) ? $pro->descripcion : '' ?></textarea>

        <label for="precio">Precio</label>
        <input type="text" name="precio" value='<?= isset($pro ) && is_object($pro) ? $pro->precio : '' ?>' />

        <label for="stock">Stock</label>
        <input type="number" name="stock" value='<?= isset($pro) && is_object($pro) ? $pro->stock : '' ?>' />

        <?php $categorias = Utils::showCategorias(); ?> <!--GUARDAME TODAS LAS CATEGORIAS-->

        <label for="categoria">Categoria</label>
        <select name="categoria">
            <?php while ($cat = $categorias->fetch_object()): ?>
                <option value="<?= $cat->id ?>" <?= isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : '' ?>>
                    <!--<option value="4" selected>  CON LA PROPIEDAD SELECTED ESE OPCION SE VA A PONER SELECCIONADO-->
                    <?= $cat->nombre ?>
                </option>
            <?php endwhile; ?>
        </select>


        <label for="imagen">Imagen</label>
        <?php if (isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>
            <img src="<?= base_url ?>/uploads/images/<?= $pro->imagen ?>" class="thumb"/><br/>
        <?php endif; ?>
        <input type="file" name="imagen"/>
        <input type="submit" value="Añadir producto"/>
    </form>
</div>