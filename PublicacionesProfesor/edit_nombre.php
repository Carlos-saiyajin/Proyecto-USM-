<div class="header">
        <div class="header-content">
            <img src="imagenes/Logo_USM_Horizontal.png" alt="Logo">
            <p class="titulo">Universidad Santa Maria</p>
            <p class="titulo">Periodo: 2024-2025</p>
        </div>
    </div>

    <div class="main_container">
        <div class="solicitud">
        <form action="Modificar Archivos.php" method="post">

<p>Opción elegida : <br><br><input class="button" type="text" name="opcion" value="<?php echo htmlspecialchars($opcion);?>"></p>

<p>Nombre anterior del archivo : <br><br><input class="button" type="text" name="file" value="<?php echo htmlspecialchars($nombreArchivo);?>"></p>

<p>Ingrese el nuevo nombre del archivo : <br><br><input class="button" type="text" name="new" required></p>

<input class="button" type="submit" value="Editar">

</form>

  </div>
</div>
