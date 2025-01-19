<?php
  
  session_start(); // LLamamos a la función "session_start()" para utilizar las variables de sesión.

  $archivo_select="publicaciones/".$nombreArchivo; // Guardamos la ruta y el nombre del archivo seleccionado.
  $archivo_editado="publicaciones/".$new_name; // Guardamos la ruta y nuevo nombre del archivo editado.
  $arreglo_archivos=[]; // Declaramos el arreglo donde se almacenarón los archivos subidos en el script "publicaciones_subidas.php".
  $arreglo_fechas=[]; // Declaramos el arreglo donde se almacenarón las fechas de los archivos subidos en el script "publicaciones_subidas.php".
  $total=0; // Inicializamos la variable "$total" en 0.
  $i=0; // Inicializamos la variable "$i" en 0.

  if(isset($_SESSION['arreglo_archivos']) and isset($_SESSION['arreglo_fechas']) and $_SESSION['total']) // Verificamos si las variables de sesión tienen algún valor.
  {
    $arreglo_archivos=$_SESSION['arreglo_archivos']; // Almacenamos los archivos subidos en el arreglo "arreglo_archivos".
    $arreglo_fechas=$_SESSION['arreglo_fechas']; // Almacenamos las fechas de los archivos subidos en el arreglo "arreglo_fechas".
    $total=$_SESSION['total']; // Almacenamos el número total de archivos subidos.
  }

  /* Recorremos la carpeta "Public". para eliminar el archivo "publicaciones.txt" y de esta forma crear un archivo nuevo que 
    contenga los archivos subidos con el nuevo nombre del archivo editado, lo mismo con la parte de alumno : 
  */

  foreach(glob("Public/*.*") as $archivo) 
  {
    unlink($archivo); // Eliminamos el archivo mencionado.
  }

  foreach(glob("C:/wamp64/www/proyecto_USM/parte_alumnos/Public/*.*") as $archivo) 
  {
    unlink($archivo); // Eliminamos el archivo mencionado.
  }

  $arreglo_nuevo=[]; // Declaramos el arreglo que almacenará los archivos subidos. 

  for($j=0;$j<$total;$j++) // Almacenamos los archivos subidos en el arreglo "$arreglo_archivos" en el arreglo "$arreglo_nuevo".
  {
    $total_char=strlen($arreglo_archivos[$j]); // Almaceanamos el total de caracteres del archivo.
    $arreglo_nuevo[$j]=substr($arreglo_archivos[$j],0,$total_char-1); // Almacenamos el nombre del archivo restando 1 carácter para evitar el problema de longitudes de caracteres diferentes. 
  }

  while($total!=0) // Recorremos el bucle mientras "$total" sea diferente de 0.
  {
    if($i==0 and $arreglo_nuevo[$i]!=$archivo_select) // Verificamos si "$i" es igual a 0 y si el archivo editado es diferente al primer archivo que se publicó.
    {
      $archivo1=fopen("Public/publicaciones.txt","w+"); // Abrimos el archivo "publicaciones.txt".
   
        fwrite($archivo1,$arreglo_nuevo[$i]."\n"); // Agregamos el archivo.
               
      fclose($archivo1); // Cerramos el archivo "publicaciones.txt".
      
      $archivo1=fopen("C:/wamp64/www/proyecto_USM/parte_alumnos/Public/publicaciones.txt","w+"); // Abrimos el archivo "publicaciones.txt".
   
        fwrite($archivo1,$arreglo_nuevo[$i]."\n"); // Agregamos el archivo.
               
      fclose($archivo1); // Cerramos el archivo "publicaciones.txt".

      $i++; // Aumentamos el iterador.
    }
    else if($i==0 and $arreglo_nuevo[$i]==$archivo_select) // Verificamos si "$i" es igual a 0 y si el archivo editado es igual al primer archivo que se publicó.
    {
      $archivo1=fopen("Public/publicaciones.txt","w+"); // Abrimos el archivo "publicaciones.txt".
   
        fwrite($archivo1,$archivo_editado."\n"); // Agregamos en el archivo "publicaciones.txt" el segundo archivo que se publicó.
               
      fclose($archivo1); // Cerramos el archivo "publicaciones.txt".
      
      $archivo1=fopen("C:/wamp64/www/proyecto_USM/parte_alumnos/Public/publicaciones.txt","w+"); // Abrimos el archivo "publicaciones.txt".
   
        fwrite($archivo1,$archivo_editado."\n"); // Agregamos en el archivo "publicaciones.txt" el segundo archivo que se publicó.
               
      fclose($archivo1); // Cerramos el archivo "publicaciones.txt".

      $i++; // Aumentamos el iterador.
    } 
    else if($i!=0) // Verificamos si "$i" es diferente de 0.
    {
      if(isset($arreglo_nuevo[$i]) and $arreglo_nuevo[$i]==$archivo_select) // Verificamos si en la posición del arreglo contiene algún valor y si el archivo publicado es igual al archivo editado.
      {
        $archivo1=fopen("Public/publicaciones.txt","a+"); // Abrimos el archivo "publicaciones.txt". 
                
          fwrite($archivo1,$archivo_editado."\n"); // Agregamos el archivo.
               
        fclose($archivo1); // Cerramos el archivo "publicaciones.txt".
        
        $archivo1=fopen("C:/wamp64/www/proyecto_USM/parte_alumnos/Public/publicaciones.txt","a+"); // Abrimos el archivo "publicaciones.txt". 
                
          fwrite($archivo1,$archivo_editado."\n"); // Agregamos el archivo.
               
        fclose($archivo1); // Cerramos el archivo "publicaciones.txt".

        $i++; // Aumentamos el iterador.
      }
      else if(isset($arreglo_nuevo[$i]) and $arreglo_nuevo[$i]!=$archivo_select) // Verificamos si en la posición del arreglo contiene algún valor y si el archivo publicado es diferente al archivo editado.
      {
        $archivo1=fopen("Public/publicaciones.txt","a+"); // Abrimos el archivo "publicaciones.txt". 
                
          fwrite($archivo1,$arreglo_nuevo[$i]."\n"); // Agregamos el archivo.
               
        fclose($archivo1); // Cerramos el archivo "publicaciones.txt".
        
        $archivo1=fopen("C:/wamp64/www/proyecto_USM/parte_alumnos/Public/publicaciones.txt","a+"); // Abrimos el archivo "publicaciones.txt". 
                
          fwrite($archivo1,$arreglo_nuevo[$i]."\n"); // Agregamos el archivo.
               
        fclose($archivo1); // Cerramos el archivo "publicaciones.txt".

        $i++; // Aumentamos el iterador.
      }
   
    }

    $total=$total-1; // Disminuimos el iterador.
  }

?>