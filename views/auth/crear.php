<div class="contenedor crear">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en UpTask</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <form action="/crear" method="post" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre </label>
                <input type="text" id="nombre" placeholder="Tu Nombre" name="nombre" value="<?php echo $usuario->nombre; ?>">
            </div>
            <div class="campo">
                <label for="email">Email </label>
                <input type="email" id="email" placeholder="Tu Email" name="email" value="<?php echo $usuario->email; ?>">
            </div>
            <div class="campo">
                <label for="password">Contraseña </label>
                <input type="password" id="password" placeholder="Tu Contraseña" name="password">
            </div>
            <div class="campo">
                <label for="password2">Repetir Contraseña </label>
                <input type="password" id="password2" placeholder="Repetir Contraseña" name="password2">
            </div>
            <div class="campo-submit">
                <input type="submit" value="Crear Cuenta" class="boton">
            </div>
        </form>
        <div class="acciones">
            <p>¿Ya tienes una cuenta? <a href="/">Inicia Sesión</a></p>
            <p>¿Olvidaste tu contraseña? <a href="/olvide">Recuperar Contraseña</a></p>
        </div>
    </div> <!--.contenedor-sm-->
</div>