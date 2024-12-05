<form action="Modificar Archivos.php" method="post">

  Opción elegida :
  <input type="text" name="opcion" value="<?php echo htmlspecialchars($opcion);?>">
  <br><br>

  Nombre del archivo a editar :
  <input type="text" name="file" value="<?php echo htmlspecialchars($nombreArchivo);?>">
  <br><br>

  Ingrese el texto a agregar : 
  <input type="text" name="texto" required>
  <br><br>

  <input type="submit" value="Editar">

</form>