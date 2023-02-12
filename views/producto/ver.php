<?php 
    if (isset($_SESSION['carrito'])) {
        # code...
        $en_carrito = false;
        foreach($_SESSION['carrito'] as $indice => $valor){
            if ($valor['id_producto'] == $_GET['id']) {
                # code...
                $en_carrito = true;
            }
        }
    }
;?>
<?php if($producto->num_rows==0) : ?>

<h2>No existe el producto</h2>

<?php else:?>
    <?php $pro = $producto->fetch_object()?>
        <div class="producto_vista">
            <div class="image">
                <img src="<?=base_url;?>uploads/images/<?=($pro->imagen != NULL || !empty($pro->imagen)) ? $pro->imagen : 'camiseta.png';?>" alt="imagen del producto">
            </div>
            <div class="producto_data">
                <h2><?=$pro->nombre;?></h2>
                <h3><?=$pro->descripcion;?></h3>
                <h5><?=$pro->stock;?> articulos disponibles</h5>
                <h5><?=$pro->precio;?>$</h5>
                <form action="<?=base_url?>carrito/add&id=<?=$pro->id;?>" method="post">
                    <?php if(isset($en_carrito) && $en_carrito == true):?>
                        <a href="<?=base_url?>carrito/index"><h2>Ya esta en el carrito</h2></a>
                        <?php elseif($pro->stock > 0): ?>
                        <label for="cantidad">cantidad</label>
                        <input type="number" name="cantidad" min="1" max="<?=$pro->stock;?>">
                        <input type="submit" value="enviar">
                    <?php else:?>
                    <h2>AGOTADO</h2>
                    <?php endif;?>
                </form>          
                
            </div>
        </div>
<?php endif;?>