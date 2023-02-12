
<?php if(!isset($_SESSION['usuario'])):?>
    <h1>Logueate para continuar :D</h1>
<?php else :?>

    <h1>Gestor de pedidos</h1>
    <p><a href="<?=base_url?>carrito/index">Consultar mi lista de productos</a></p>
    <br>

    <h3>Domicilio a enviar</h3>
    <form action="<?=base_url?>pedido/add" method="post">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" required/>
        
        <label for="ciudad">Ciudad</label>
        <input type="text" name="localidad" required/>
        
        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" required/>

        <input type="submit" value="Confirmar pedido" class="button">

    </form>
<?php endif;
?>