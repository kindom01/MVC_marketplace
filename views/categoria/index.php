<h1>Gestionar categorias</h1>

<?php if (isset($_SESSION['general']) && $_SESSION['general']=="Complete"): ?>
    <div class="alerta">
        <h3>La categoria se ha guradado con exito</h3>
    </div>
<?php elseif(isset($_SESSION['general']) && $_SESSION['general']=="Failed"):?>
    <div class="alerta error">
        <h3>La categoria no pudoo crearse</h3>
    </div>
<?php endif;?>
<?php Utils::deleteSession('general');?>

<a href="<?=base_url?>categoria/crear" class="button small">Crear categoria</a>

<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>OPCIONES</th>
    </tr>
<?php while($cat = $categorias->fetch_object()):?>
    <tr>
        <td><?=$cat->id;?></td>
        <td><?=$cat->nombre;?></td>
        <td>
            <a href="<?=base_url?>categoria/delete&id=<?=$cat->id;?>" class="button rojo_claro">Borrar</a>
            <a href="<?=base_url?>categoria/delete" class="button azul_claro">Editar</a>
        </td>
    </tr>
<?php endwhile; ?>
</table>