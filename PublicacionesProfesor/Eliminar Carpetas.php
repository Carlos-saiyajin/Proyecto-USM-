<?php
   
   $eliminar=rmdir("Archivos temporales"); // Eliminamos la Carpeta "Archivos temporales".
   
   if($eliminar) // Verificamos si la carpeta se elimino correctamente.
   {
      echo" La Carpeta se elimino correctamente.";
   }
   else // Verificamos si la carpeta no se elimino.
   { 
      echo" La Carpeta no se pudo elimminar.";
   }

?>