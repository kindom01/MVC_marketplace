<?php if(isset($_SESSION['admin'])):?>
    <h2>Cambiar estado de la compra</h2>
    <form action="<?=base_url?>pedido/estado&pedido_id=<?=$_GET['pedido_id'];?>" method="post">
    <label for="estado">Estado</label>
        <select name="estado">
            <option value="Pendiente">Pendiente</option>
            <option value="Preparacion">Preparacion</option>
            <option value="Preparado">Preparado</option>
            <option value="Enviado">Enviado</option>
            <option value="Completado">Completado</option>
        </select>
        <input type="submit" value="Cambiar estado">
    </form>
    <br>
    <h3>DETALLES</h3>
    <br>
<?php endif;?>

<pre>
    DATOS DEL PEDIDO:
    Numero de pedido: <?=$_GET['pedido_id'];?>.
    Total a pagar:  <?=$pedido->coste;?>$.

    Productos:
<?php while ($producto = $productos->fetch_object()) :?>
    NOMBRE:<?=$producto->nombre;?>.
    PRECIO:<?=$producto->precio;?> $.
    CANTIDAD:<?=$producto->unidades;?>.

<?php endwhile ;?>
</pre>