<aside id="lateral">

<!--Barra Lateral-->

<!--alertas-->
<?php if(isset($_SESSION['alerta']) && $_SESSION['alerta']=="Failed"):?>
    <div class="alerta error">
        <h4>Error al iniciar sesion, compruebe los datos</h4>
    </div>
<?php endif;?>
<?php Utils::deleteSession('alerta');?>

<!--login-->
<div id="login" class="block_aside">
    
<?php if (!isset($_SESSION['usuario'])):?>
        <h3>Entrar a la web</h3>
        <form action="<?=base_url;?>usuario/login" method="POST">
            <label for="Email">Email</label>
            <input type="email" name="email" id="">
            
            <label for="Password">Password</label>
            <input type="password" name="password" id="">
            
            <input type="submit" value="Enviar">
        </form>

        <li><a href="<?=base_url?>usuario/registro">Registrate si no tienes cuenta</a></li>
<?php endif;?>


<!--datos de sesion-->
<ul>
    <?php if (isset($_SESSION['admin'])):?>
        <h3>Administrador de la pagina</h3>
        <li><a href="<?=base_url?>categoria/index">Gestionar categorias</a></li>
        <li><a href="<?=base_url?>producto/gestion">Gestionar productos</a></li>
        <li><a href="<?=base_url?>pedido/gestionar">Gestionar pedidos</a></li>
    <?php endif;?>
    <h3>Mi carrito de compra</h3>
    <li><a href="<?=base_url;?>carrito/index">Mi carrito</a></li>
    <?php if (isset($_SESSION['usuario'])):?>
        <h3><?= $_SESSION['usuario']->nombre ;?> <?= $_SESSION['usuario']->apellidos ;?></h3> 
        <li><a href="<?=base_url?>pedido/lista">Mis pedidos</a></li>
        <a href="<?=base_url;?>usuario/logout" class="button rojo">Cerrar sesion</a>
    <?php endif;?>
</ul>
    
</div>
</aside>
<div id="central">