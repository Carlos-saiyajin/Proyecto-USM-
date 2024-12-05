<?php

  if(isset($_POST['editar'])) // Verificamos si se presionó el botón "Modificar Archivo".
  {
    if($_FILES['archivo']['error'] === UPLOAD_ERR_OK) // Verificamos si el archivo se envió correctamente.
    {
      goto salto;
    }
    else
    {
      echo"Error: ".$_FILES['archivo']['error'];
      exit();
    } 
  }

  salto:

  $nombreArchivo=$_FILES['archivo']['name']; // Guardamos el nombre del archivo.

?>

<form action="opcion2_edit.php" method="post">
   
  Nombre del archivo a modificar :
  <input type="text" name="file" value="<?php echo htmlspecialchars($nombreArchivo);?>">
  <br></br>
  
  <label>opciones:</label>
  <select name="opcion">
      
    <option value="Cambiar Nombre">Cambiar Nombre</option>
    <option value="Agregar Texto">Agregar Texto</option>

  </select>

  <input type="submit" value="aceptar">

</form>

<a href="menu.php"><button>Regresar al menú</button></a>