<main class="devwebcamp">
    <h2 class="devwebcamp__heading"><?php echo $titulo; ?></h2>
    <p class="devwebcamp__descripcion">Conoce la conferencia mas importante de latinoamerica</p>

    <div class="devwebcamp__grid">
        <div <?php aos_animacion();  ?> class="devwebcamp__imagen">
            <picture>
                <source srcset="build/img/sobre_devwebcamp.avif" type="image/avif">
                <source srcset="build/img/sobre_devwebcamp.webp" type="image/webp">
                <img loading="lazy" width="200" height="300" src="build/img/sobre_devwebcamp.jpg" alt="imagen DevWebCamp">
            </picture>
        </div>

        <div <?php aos_animacion();  ?> class="devwebcamp__contenido">
            <p class="devwebcamp__texto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis suscipit delectus, ipsum aperiam aliquid minus eius vitae commodi et tenetur praesentium beatae rerum fuga perferendis sit veniam, eos doloribus. Perferendis.</p>
            <p class="devwebcamp__texto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis suscipit delectus, ipsum aperiam aliquid minus eius vitae commodi et tenetur praesentium beatae rerum fuga perferendis sit veniam, eos doloribus. Perferendis.</p>

        </div>
    </div>
</main>