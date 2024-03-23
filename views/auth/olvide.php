<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recuperar Acceso en UpTask</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
        <form action="/olvide" method="post" class="formulario" novalidate>
            <div class="campo">
                <label for="email">Email </label>
                <input type="email" id="email" placeholder="Tu Email" name="email">
            </div>
            <div class="campo-submit">
                <input type="submit" value="Enviar Instrucciones" class="boton">
            </div>
        </form>
        <div class="acciones">
            <p>¿Ya tienes una cuenta? <a href="/">Iniciar Sesión</a></p>
            <p>¿Aún no tienes una cuenta? <a href="/crear">Crear Cuenta</a></p>
        </div>
    </div> <!--.contenedor-sm-->
</div>