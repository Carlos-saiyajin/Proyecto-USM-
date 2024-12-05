<?php
   
   foreach(glob("Archivos Temporales/*.*") as $archivo) // Recorremos la carpeta "Archivos Temporales".
   {
      unlink($archivo); // Eliminamos los archivos uno por uno.
   }

   echo" Todos los archivos se eliminaron correctamente.";
   
?>