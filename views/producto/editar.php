<h1>Editar producto</h1>

<form action="<?=base_url?>producto/actualizar&id=<?=$pro->id;?>" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?=$pro->nombre;?>">
    
    <label for="descripcion">Descripcion</label>
    <textarea name="descripcion"><?=$pro->descripcion;?></textarea>
    
    <label for="precio">Precio</label>
    <input type="text" name="precio" value="<?=$pro->precio;?>">

    <label for="stock">Stock</label>
    <input type="number" name="stock" value="<?=$pro->stock;?>">

    <label for="categoria">categoria</label>
    <?php $categorias = Utils::showCategorias();?>

    <select name="categoria">
        <?php while( $cat = $categorias->fetch_object()):?>
          <option value="<?=$cat->id ;?>"
          <?=($cat->id == $pro->categoria_id) ?'selected' : '';?>>
                <?= $cat->nombre ;?>
            </option>
        <?php endwhile ;?>
    </select>
    
    <div id="small_img">
    <label for="imagen">Imagen</label>
    <?php if(!empty($pro->imagen || $pro->imagen != NULL)):?>    
        <img src="<?=base_url?>uploads/images/<?=$pro->imagen;?>">
    <?php endif;?>    
        <input type="file" name="imagen">
    </div>

    <input type="submit" value="Cambiar">
    
</form>