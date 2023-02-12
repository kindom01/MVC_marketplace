<h1>Gestionar productos</h1>

<?php if (isset($_SESSION['general']) && $_SESSION['general']=="Complete"): ?>
    <div class="alerta">
        <h3>El producto se ha añadido con exito</h3>
    </div>
<?php elseif(isset($_SESSION['general']) && $_SESSION['general']=="Failed"):?>
    <div class="alerta error">
        <h3>El producto no se pudo añadir :(</h3>
    </div>
<?php endif;?>
<?php Utils::deleteSession('general');?>

<a href="<?=base_url?>producto/crear" class="button small">Añadir producto</a>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
    </tr>
<?php while($prod = $productos->fetch_object()):?>
    <tr>
        <td><?=$prod->id;?></td>
        <td><?=$prod->nombre;?></td>
        <td><?=$prod->precio;?> $</td>
        <td><?=$prod->stock;?></td>
        <td>
            <a href="<?=base_url?>producto/borrar&id=<?=$prod->id?>" class="button rojo_claro">Borrar</a>
            <a href="<?=base_url?>producto/editar&id=<?=$prod->id?>" class="button azul_claro">Editar</a>
        </td>
    </tr>
<?php endwhile; ?>
</table>