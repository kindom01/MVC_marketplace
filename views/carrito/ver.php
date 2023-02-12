<h1>Carrito de compras</h1>

<table>
    <tr>
        <th>IMAGEN</th>
        <th>NOMBRE</th>
        <th>CANTIDAD</th>
        <th>PRECIO</th>
    </tr>
<?php
    $stats = Utils::statsCarrito();
    foreach($carrito as $indice => $elemento):
    $producto = $elemento['productos'];
?>
    <tr>
        <td><img src="<?=base_url?>uploads/images/<?=($producto->imagen != NULL || !empty($producto->imagen)) ? $producto->imagen : 'camiseta.png';?>" alt="Imagen del producto"></td>
        <td><a href="<?=base_url?>producto/ver&id=<?=$producto->id;?>"><?=$elemento['nombre_producto'];?></a></td>
        <td><?=$elemento['unidades'];?></td>
        <td><?=$elemento['precio'];?> $</td>
        <td>
            <a href="<?=base_url?>carrito/remove&id=<?=$producto->id;?>" class="button rojo_claro">Quitar</a>
        </td>
    </tr>

<?php endforeach; ?>
</table>

<table>
    <tr>
        <th>CANTIDAD DE ARTICULOS</th>
        <th>TOTAL A PAGAR</th>
    </tr>
    <tr>
        <th><?=$stats['count'];?> Articulos</th>
        <th><?=$stats['total'];?>$</th>
    </tr>
</table>

<a href="<?=base_url?>pedido/hacer" class="button confirmar">Confirmar pedido</a>
<a href="<?=base_url?>carrito/delete_all" class="button confirmar rojo">Quitar todo</a>