<?php 
   
   $nombreArchivo=$_POST['file']; // Guardamos el nombre del archivo enviado.

   $verifArchivo=file_exists("C:/wamp64/www/proyecto_USM/PublicacionesProfesor/publicaciones/$nombreArchivo"); // Verificamos que el archivo exista.
   
   if($verifArchivo)
   {
      $eliminar=unlink("C:/wamp64/www/proyecto_USM/PublicacionesProfesor/publicaciones/$nombreArchivo"); // Eliminamos el archivo.
      
      if($eliminar) // Verificamos si el archivo se elimino correctamente.
      {
         echo" El Archivo se eliminó correctamente.";
      }
      else // Verificamos si el archivo no se pudo elimminar.
      {
         echo" El Archivo no se pudo eliminar.";
      } 
   }
   else
   {
      echo"El archivo no existe.";
   }
      
   echo"<br></br>"; // Imprimimos saltos de línea.
   echo'<a href="menu.php"><button>Regresar al menú</button></a>'; // Boton que redirecciona al menú principal.

?>