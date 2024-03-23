<div class="contenedor login">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <form action="/" method="post" class="formulario" novalidate>
            <div class="campo">
                <label for="email">Email </label>
                <input type="email" id="email" placeholder="Tu Email" name="email">
            </div>
            <div class="campo">
                <label for="password">Contraseña </label>
                <input type="password" id="password" placeholder="Tu Contraseña" name="password">
            </div>
            <div class="campo-submit">
                <input type="submit" value="Iniciar Sesión" class="boton">
            </div>
        </form>
        <div class="acciones">
            <p>¿Aún no tienes una cuenta? <a href="/crear">Crear cuenta</a></p>
            <p>¿Olvidaste tu contraseña? <a href="/olvide">Recuperar Contraseña</a></p>
        </div>
    </div> <!--.contenedor-sm-->
</div>