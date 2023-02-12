<table>
    <tr>
        <td>ID DEL PEDIDO</td>
        <td>DIRECCION</td>
        <td>GASTO</td>
        <td>ESTADO</td>
        <td>FECHA</td>
    </tr>
    <?php while($pedido = $pedidos->fetch_object()) :?>
        <tr>
            <td><?= $pedido->id;?></td>
            <td><?= $pedido->provincia;?>, <?= $pedido->localidad;?>, <?= $pedido->direccion;?></td>
            <td><?= $pedido->coste;?></td>
            <td><?= $pedido->estado;?></td>
            <td><?= $pedido->fecha;?> || <?= $pedido->hora;?></td>
            <td>
                <a href="<?=base_url?>pedido/detalles&usuario_id=<?= $pedido->usuario_id;?>&pedido_id=<?= $pedido->id;?>" class="button rojo_claro">Consultar</a>
            </td>
        </tr>
    <?php endwhile;?>
</table>