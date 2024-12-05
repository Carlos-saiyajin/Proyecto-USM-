<form action="Modificar Archivos.php" method="post">

  Opción elegida :
  <input type="text" name="opcion" value="<?php echo htmlspecialchars($opcion);?>">
  <br><br>

  Nombre anterior del archivo :
  <input type="text" name="file" value="<?php echo htmlspecialchars($nombreArchivo);?>">
  <br><br>

  Ingrese el nuevo nombre del archivo :
  <input type="text" name="new" required>
  <br><br>

  <input type="submit" value="Editar">

</form>