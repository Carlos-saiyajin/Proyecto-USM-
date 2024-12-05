<?php
  
   $nueva=mkdir("Archivos Temporales",0777); // Creamos la Carpeta "Archivos Temporales".
    
   if($nueva) // Verificamos si se creo la carpeta.
   {
      echo" La Carpeta se ha creado correctamente.";
   }
   else // Verificamos si no se creo la carpeta.
   {
      echo" No se pudo crear la carpeta.";
   }
?>