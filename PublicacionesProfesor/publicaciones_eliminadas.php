<?php 

   session_start(); // LLamamos a la función "session_start()" para utilizar las variables de sesión.
   
   include("publicaciones_subidas.php");

   $arreglo_archivos=[]; // Declaramos el arreglo donde se almacenarón los archivos subidos en el script "publicaciones_subidas.php".
   $arreglo_fechas=[]; // Declaramos el arreglo donde se almacenarón las fechas de los archivos subidos en el script "publicaciones_subidas.php".
   $total=0; // Inicializamos la variable "$total" en 0.
   $i=0; // Inicializamos la variable "$i" en 0.

   if(isset($_SESSION['arreglo_archivos']) and isset($_SESSION['arreglo_fechas']) and $_SESSION['total']) // Verificamos si las variables de sesión tienen algún valor.
   {
      $arreglo_archivos=$_SESSION['arreglo_archivos']; // Almacenamos los archivos subidos en el arreglo "arreglo_archivos".
      $arreglo_fechas=$_SESSION['arreglo_fechas']; // Almacenamos las fechas de los archivos subidos en el arreglo "arreglo_fechas".
      $total=$_SESSION['total'];
   }

   /* Recorremos la carpeta "Public". para eliminar el archivo "publicaciones.txt" y de esta forma crear un archivo nuevo que 
      contenga los archivos subidos menos el archivo que se eliminó :
   */

   foreach(glob("Public/*.*") as $archivo) 
   {
      unlink($archivo); // Eliminamos el archivo mencionado.
   }

   /* Recorremos la carpeta "Fechas". para eliminar el archivo "fechas.txt" y de esta forma crear un archivo nuevo que 
      contenga las fechas de los archivos subidos menos la fecha del archivo que se eliminó :
   */

   foreach(glob("Fechas/*.*") as $archivo2)
   {
      unlink($archivo2); // Eliminamos el archivo mencionado.
   }
   
   $arreglo_nuevo=[]; // Declaramos el arreglo que almacenará los archivos subidos. 

   for($j=0;$j<$total;$j++) // Almacenamos los archivos subidos en el arreglo "$arreglo_archivos" en el arreglo "$arreglo_nuevo".
   {
      $total_char=strlen($arreglo_archivos[$j]); // Almaceanamos el total de caracteres del archivo.
      $arreglo_nuevo[$j]=substr($arreglo_archivos[$j],0,$total_char-1); // Almacenamos el nombre del archivo restando 1 carácter para evitar el problema de longitudes de caracteres diferentes. 
   }

   while($total!=0) // Recorremos el bucle mientras "$total" sea diferente de 0.
   {
      if($i==0 and $arreglo_nuevo[$i]!=$archivo_eliminar) // Verificamos si "$i" es igual a 0 y si el archivo a eliminar es diferente al primer archivo que se publicó.
      {
         $archivo1=fopen("Public/publicaciones.txt","w+"); // Abrimos el archivo "publicaciones.txt".
   
           fwrite($archivo1,$arreglo_nuevo[$i]."\n"); // Agregamos el archivo.
               
         fclose($archivo1); // Cerramos el archivo "publicaciones.txt".
         
         $archivo2=fopen("Fechas/fechas.txt","w+");
           
           fwrite($archivo2,$arreglo_fechas[$i]);

         fclose($archivo2);

         $i++; // Aumentamos el iterador.
      }
      else if($i==0 and $arreglo_nuevo[$i]==$archivo_eliminar) // Verificamos si "$i" es igual a 0 y si el archivo a eliminar es igual al primer archivo que se publicó.
      {
         $i=1; // Definimos el iterador igual a 1.
   
         $archivo1=fopen("Public/publicaciones.txt","w+"); // Abrimos el archivo "publicaciones.txt".
   
            fwrite($archivo1,$arreglo_nuevo[$i]."\n"); // Agregamos en el archivo "publicaciones.txt" el segundo archivo que se publicó.
               
         fclose($archivo1); // Cerramos el archivo "publicaciones.txt".
         
         $archivo2=fopen("Fechas/fechas.txt","w+");
           
           fwrite($archivo2,$arreglo_fechas[$i]);

         fclose($archivo2);

         $i++; // Aumentamos el iterador.
      } 
      else if($i!=0) // Verificamos si "$i" es diferente de 0.
      {
        if(isset($arreglo_nuevo[$i]) and $arreglo_nuevo[$i]!=$archivo_eliminar)
        {
            $archivo1=fopen("Public/publicaciones.txt","a+"); // Abrimos el archivo "publicaciones.txt". 
                
               fwrite($archivo1,$arreglo_archivos[$i]); // Agregamos el archivo.
               
            fclose($archivo1); // Cerramos el archivo "publicaciones.txt".
            
            $archivo2=fopen("Fechas/fechas.txt","a+");
           
              fwrite($archivo2,$arreglo_fechas[$i]);

            fclose($archivo2);

            $i++; // Aumentamos el iterador.
        }
        else
        {
            $i++; // Aumentamos el iterador.
        }
   
      }

      $total=$total-1; // Disminuimos el iterador.
   }

?>