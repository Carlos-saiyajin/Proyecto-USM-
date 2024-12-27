<!DOCTYPE html>
<html lang="es"> <!-- Definimos el idioma en español -->
  
  <!-- Definimos el encabezado de la página : -->
  
  <head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificación Archivo</title>
  
  </head>
  
  <!-- Definimos el cuerpo de la página : -->
  
  <body>
    
    <!-- Definimos el formulario : -->

    <form action="Modificar Archivos.php" method="post">

      Opción elegida :
      <input type="text" name="opcion" value="<?php echo htmlspecialchars($opcion);?>">
      <br><br>

      Nombre del archivo a editar :
      <input type="text" name="file" value="<?php echo htmlspecialchars($nombreArchivo);?>">
      <br><br>

      Ingrese el texto a agregar :
      <br><br>

      <textarea name="texto" rows="10" cols="50"></textarea>
      <br><br>

      <input type="submit" value="Editar">

    </form>
  
  </body>

</html>
