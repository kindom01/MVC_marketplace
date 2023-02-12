<?php if (isset($_SESSION['general']) && $_SESSION['general']=="Complete"): ?>

        <h1>TU pedido se ha realizado con exito, realiza el pago para proseguir</h1>

        <pre>
            DATOS DEL PEDIDO:
            Numero de pedido: <?=$pedido->id;?>.
            Total a pagar:  <?=$pedido->coste;?>$.

            Productos:
<?php while ($producto = $productos->fetch_object()) :?>
            NOMBRE:<?=$producto->nombre;?>.
            PRECIO:<?=$producto->precio;?> $.
            CANTIDAD:<?=$producto->unidades;?>.

<?php endwhile ;?>
        </pre>

<?php elseif(isset($_SESSION['general']) && $_SESSION['general']=="Failed"):?>

        <h1>Lo lamentamos pero tu pedido no pudo completarse</h1>

<?php endif;?>
<?php Utils::deleteSession('general');?>