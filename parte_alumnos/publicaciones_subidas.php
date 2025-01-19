<?php
  
  $arreglo_archivos=[]; // Declaramos el arreglo donde se almacenarán los archivos subidos.
  $arreglo_fechas=[]; // Declaramos el arreglo donde se almacenarán las fechas de los archivos subidos.

  $i=null; // Declaramos el iterador que me guardará el número de archivos subidos.
 
  foreach(glob("C:/wamp64/www/proyecto_USM/PublicacionesProfesor/publicaciones/*.*") as $archivo) // Recorremos la carpeta "publicaciones" para obetener el número total de archivos subidos.
  { 
    $i++; // Aumentamos el iterador.
  } 

  $_SESSION['total']=$i; // Guardamos la cantidad total de archivos subidos dentro de la variable de sesión "total". 
  
  if($i!=null)
  {
    $a=0; // Declaramos el iterador que me permitirá almacenar los archivos subidos dentro del arreglo "arreglo_archivos".

    $archivo1=fopen("Public/publicaciones.txt","r"); // Abrimos el archivo "publicaciones.txt".
    
      while(!feof($archivo1)) // Recorremos el archivo.
      {
        $archivo=fgets($archivo1); // Obtenemos y guardamos la línea de texto del archivo.
        
        if($a!=$i)
        {
          $arreglo_archivos[$a]=$archivo; // Almacenamos línea de texto obtenida en el "arreglo_archivos".
          $a++; // Aumentamos el iterador.
        }
      
      }
  
    fclose($archivo1); // Cerramos el archivo "publicaciones.txt".
  
    $f=0; // Declaramos el iterador que me permitirá almacenar las fechas subidas dentro del arreglo "arreglo_fechas".

    $archivo2=fopen("Fechas/fechas.txt","r"); // Abrimos el archivo "fechas.txt".
   
      while(!feof($archivo2)) // Recorremos el archivo.
      {
        $fecha=fgets($archivo2); // Obtenemos y guardamos la línea de texto del archivo.
        
        if($f!=$i)
        {
          $arreglo_fechas[$f]=$fecha; // Almacenamos línea de texto obtenida en el "arreglo_fechas".
          $f++; // Aumentamos el iterador.
        }
        
      }
  
    fclose($archivo2); // Cerramos el archivo "fechas.txt".

    $_SESSION['arreglo_archivos']=$arreglo_archivos; // Almacenamos los archivos subidos en la variable de sesión "arreglo_archivos".
    $_SESSION['arreglo_fechas']=$arreglo_fechas; // Almacenamos las fechas de los archivos subidos en la variable de sesión "ärreglo_fechas". 
  }
  
?>