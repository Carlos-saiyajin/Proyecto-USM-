<?php

   if($_FILES['archivo']['error'] === UPLOAD_ERR_OK) // Verificamos si el archivo se envió correctamente.
   {
      goto salto; // Realizamos un salto a "salto".
   }
   else // Verificamos si el archivo presentó algún error de envio.
   {
      echo"Error: ".$_FILES['archivo']['error'];
      exit();
   } 
   
   salto:

   $nombreArchivo=$_FILES['archivo']['name']; // Guardamos el nombre del archivo.

?>

<!-- Confirmamos la eliminación del archivo -->

<form action="Eliminar un Archivo.php" method="post">

  ¿Desea eliminar el archivo? :
  <input type="text" name="file" value="<?php echo htmlspecialchars($nombreArchivo);?>">
  <br></br>
  <input type="submit" value="Confirmar"> <!-- Imprimimos el botón de Confirmar -->
  
</form>

<a href="menu.php"><button>Regresar al menú</button></a> <!-- Imprimimos el botón para regresar al menú -->

