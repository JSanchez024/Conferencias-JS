<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion Personal</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre</label>
        <input 
            type="text"
            class="formulario__input"
            id="nombre"
            name="nombre"
            placeholder="Nombre Ponente"
            value="<?php echo $ponente->nombre ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="apellido" class="formulario__label">Apellido</label>
        <input 
            type="text"
            class="formulario__input"
            id="apellido"
            name="apellido"
            placeholder="Apellido Ponente"
            value="<?php echo $ponente->apellido ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="ciudad" class="formulario__label">Ciudad</label>
        <input 
            type="text"
            class="formulario__input"
            id="ciudad"
            name="ciudad"
            placeholder="Ciudad Ponente"
            value="<?php echo $ponente->ciudad ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="pais" class="formulario__label">Pais</label>
        <input 
            type="text"
            class="formulario__input"
            id="pais"
            name="pais"
            placeholder="Pais Ponente"
            value="<?php echo $ponente->pais ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">
        <label for="imagen" class="formulario__label">Imagen</label>
        <input 
            type="file"
            class="formulario__input formulario__input--file"
            id="imagen"
            name="imagen"
        >
    </div>
    
</fieldset>