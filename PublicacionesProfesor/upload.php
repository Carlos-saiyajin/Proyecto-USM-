<?php
   
   if($_FILES['archivo']['error'] === UPLOAD_ERR_OK) // Verificamos si el archivo se envió correctamente.
   {
      $nombreArchivo=$_FILES['archivo']['name']; // Guardamos el nombre del archivo.
      $ubicacionTemporal=$_FILES['archivo']['tmp_name']; // Ubicamos temporalmente el archivo.
      $ubicacionFinal="C:/wamp64/www/funcionando_login - copia/PublicacionesProfesor/publicaciones/$nombreArchivo"; // Definimos la ruta final del archivo.
  
      if(move_uploaded_file($ubicacionTemporal,$ubicacionFinal)) // Verificamos si el archivo se subió correctamente.
      {
         echo "El archivo se ha subido correctamente.";
         echo"<br></br>";

         echo'<a href="menu.php"><button>Regresar al menu</button></a>';
      } 
      else // Verificamos si el archivo no se pudo subir.
      {
         echo "Error al subir el archivo.";
         echo"<br></br>";

         echo'<a href="menu.php"><button>Regresar al menu</button></a>';
      }
   }
   else // Verificamos si el archivo presentó un error.
   {
      echo"Error: ".$_FILES['archivo']['error'];
      exit();
   }
?>



