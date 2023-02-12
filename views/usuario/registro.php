<h1>Registrarse</h1>

<?php if (isset($_SESSION['alerta']) && $_SESSION['alerta']=="Complete"): ?>
    <div class="alerta">
        <h3>El registro ha sido completado con exito</h3>
    </div>
<?php elseif(isset($_SESSION['alerta']) && $_SESSION['alerta']=="Failed"):?>
    <div class="alerta error">
        <h3>El registro no pudo completarse con exito</h3>
    </div>
<?php endif;?>
<?php Utils::deleteSession('alerta');?>

<form action="<?=base_url;?>usuario/save" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required/>

    <label for="apellido">Apellidos</label>
    <input type="text" name="apellidos" required/>

    <label for="email">Email</label>
    <input type="email" name="email" required/>

    <label for="contraseña">Contraseña</label>
    <input type="password" name="password" required/>

    <input type="submit" value="Registrarse" />
</form>