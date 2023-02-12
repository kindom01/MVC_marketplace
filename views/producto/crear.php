<h1>Añadir producto</h1>

<form action="<?=base_url?>producto/save" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre">
    
    <label for="descripcion">Descripcion</label>
    <textarea name="descripcion"></textarea>
    
    <label for="precio">Precio</label>
    <input type="text" name="precio">

    <label for="stock">Stock</label>
    <input type="number" name="stock">

    <label for="categoria">categoria</label>
    <?php $categorias = Utils::showCategorias();?>

    <select name="categoria">
        <?php while( $cat = $categorias->fetch_object()):?>
          <option value="<?=$cat->id ;?>">
                <?= $cat->nombre ;?>
            </option>
        <?php endwhile ;?>
    </select>

    <label for="imagen">Imagen</label>
    <input type="file" name="imagen">

    <input type="submit" value="Crear">

</form>