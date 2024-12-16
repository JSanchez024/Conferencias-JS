<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Registrate en DevWebCamp</p>

<<<<<<< HEAD
    <?php
    require_once __DIR__ . '/../templates/alertas.php'
    ?>

    <form method="POST" action="/registro" class="formulario">
=======
    <form class="formulario">
>>>>>>> c8439cb4129c9dac12c1c6c1f1bc9a783d21830e

        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input 
                type="text"
                class="formulario__input"
                placeholder="Tu Nombre"
                id="nombre"
                name="nombre"
<<<<<<< HEAD
                value="<?php echo $usuario->nombre; ?>"
=======
>>>>>>> c8439cb4129c9dac12c1c6c1f1bc9a783d21830e
            >
        </div>
        
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input 
                type="text"
                class="formulario__input"
                placeholder="Tu Apellido"
                id="apellido"
                name="apellido"
<<<<<<< HEAD
                value="<?php echo $usuario->apellido; ?>"
=======
>>>>>>> c8439cb4129c9dac12c1c6c1f1bc9a783d21830e
            >
        </div>

        

        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input 
                type="email"
                class="formulario__input"
                placeholder="Tu Email"
                id="email"
                name="email"
<<<<<<< HEAD
                value="<?php echo $usuario->email; ?>"
=======
>>>>>>> c8439cb4129c9dac12c1c6c1f1bc9a783d21830e
            >
        </div>

        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Tu Password"
                id="password"
                name="password"
            >
        </div>

        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir Password</label>
            <input 
                type="password"
                class="formulario__input"
                placeholder="Repetir Password"
                id="password2"
                name="password2"
            >
        </div>

        <input 
            type="submit" 
            class="formulario__submit"
            value="Crear Cuenta"
        >
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes una cuenta? Iniciar Sesion</a>
        <a href="/olvide" class="acciones__enlace">¿Olvidaste tu Password?</a>
    </div>

</main>