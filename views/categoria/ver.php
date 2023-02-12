<?php if(empty($categoria_ob) || $categoria_ob == NULL):?>
<h1>La categoria no existe</h1>
<?php else:?>
<h1><?= $categoria_ob->nombre;?></h1>
<?php endif;?>

<?php if($productos->num_rows==0) : ?>

<h2>No hay productos para mostrar</h2>

<?php else:?>
    <?php while($pro = $productos->fetch_object()):?>
        <div class="product">
            <a href="<?=base_url?>producto/ver&id=<?=$pro->id;?>"><img src="<?=base_url;?>uploads/images/<?=($pro->imagen != NULL || !empty($pro->imagen)) ? $pro->imagen : 'camiseta.png';?>" alt="imagen del producto"></a>
                <a href="<?=base_url?>producto/ver&id=<?=$pro->id;?>"><h2><?=$pro->nombre;?></h2></a>
                <p><?=$pro->precio;?>$</p>
                <a href="<?=base_url?>producto/ver&id=<?=$pro->id;?>" class="button">Ver</a>
        </div>
    <?php endwhile; ?>
<?php endif;?>
