<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recupera tu Acceso a DevWebCamp</p>

<<<<<<< HEAD
    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form method="POST" action="/olvide" class="formulario">
=======
    <form class="formulario">
>>>>>>> c8439cb4129c9dac12c1c6c1f1bc9a783d21830e
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Tu Email"
                id="email"
                name="email"
            >
        </div>

        <input 
            type="submit" 
            class="formulario__submit"
            value="Enviar Instrucciones"
        >
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una Cuenta? Iniciar Sesion</a>
        <a href="/registro" class="acciones__enlace">¿Aun no tienes una cuenta? Obten una</a>
    </div>

</main>