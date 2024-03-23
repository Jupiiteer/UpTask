<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nueva contraseña</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <?php if ($mostrar) { ?>

            <form action="/reestablecer" method="post" class="formulario">
                <div class="campo">
                    <label for="password">Nueva Contraseña </label>
                    <input type="password" id="password" placeholder="Tu Nueva Contraseña" name="password">
                </div>
                <div class="campo-submit">
                    <input type="submit" value="Guardar Contraseña" class="boton">
                </div>
            </form>

        <?php } ?>
        <div class="acciones">
            <p>¿Aún no tienes una cuenta? <a href="/crear">Crear cuenta</a></p>
            <p>¿Olvidaste tu contraseña? <a href="/olvide">Recuperar Contraseña</a></p>
        </div>
    </div> <!--.contenedor-sm-->
</div>