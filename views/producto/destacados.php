<h1>Algunos de nuestros productos</h1>
    
<?php while($pro = $productos->fetch_object()):?>
        <div class="product">
            <a href="<?=base_url?>producto/ver&id=<?=$pro->id;?>"><img src="<?=base_url;?>uploads/images/<?=($pro->imagen != NULL || !empty($pro->imagen)) ? $pro->imagen : 'camiseta.png';?>" alt="imagen del producto"></a>
                <a href="<?=base_url?>producto/ver&id=<?=$pro->id;?>"><h2><?=$pro->nombre;?></h2></a>
                <p><?=$pro->precio;?>$</p>
                <a href="<?=base_url?>producto/ver&id=<?=$pro->id;?>" class="button">Ver</a>
        </div>
<?php endwhile; ?>
