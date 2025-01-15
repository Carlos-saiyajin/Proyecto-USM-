<?php

   $opcion=$_POST['opcion']; // Guardamos la opción seleccionada.
   $nombreArchivo=$_POST['file']; // Guardamos el nombre anterior del archivo.
   
   if($opcion=="Cambiar Nombre") // Verificamos si la opción seleccionada es "Cambiar Nombre".
   {
      $new_name=$_POST['new']; // Guardamos el nuevo nombre del archivo.
      
      include("publicaciones_editadas.php"); // Incluimos el archivo "publicaciones_editadas.php".
      
      $editar=rename("C:/wamp64/www/proyecto_USM/PublicacionesProfesor/publicaciones/$nombreArchivo","C:/wamp64/www/proyecto_USM/PublicacionesProfesor/publicaciones/$new_name");
   
      if($editar) // Verificamos si el archivo se modificó correctamente.
      {
        echo" El Archivo se modificó correctamente.";
      }
      else // Verificamos si el archivo no se pudo modificar.
      {
        echo" El Archivo no se pudo modificar.";
      }
   }
   else if($opcion=="Agregar Texto") // Verificamos si la opción seleccionada es "Agregar Texto".
   {
      $texto=$_POST['texto']; // Guardamos el texto a agregar al archivo.
      
      $file_exist=file_exists("C:/wamp64/www/proyecto_USM/PublicacionesProfesor/publicaciones/$nombreArchivo"); // Verificamos sí el archivo existe.

      if($file_exist)
      {
        $archivo=fopen("C:/wamp64/www/proyecto_USM/PublicacionesProfesor/publicaciones/$nombreArchivo","a+"); // Abrimos el archivo.

        $edit=fwrite($archivo,"\n\n".$texto."\n\n"); // Agregamos el texto al archivo.

        if($edit) // Verficamos sí el texto se agrego correctamente.
        {
           echo"El texto se ha agregado correctamente.";
        }
        else // Verificamos sí el texto no se pudo agregaar.
        {
           echo"El texto no se pudo agregar.";
        }

        fclose($archivo); // Cerramos el archivo.
      }
      else
      {
         echo"No se pudo agregar el texto al archivo, por favor verifique si el archivo se encuentra en las publicaciones del profesor.";
      }
      
   }
   
   echo"<br></br>"; // Imprimimos saltos de línea.
   echo'<a href="menu.php"><button>Regresar al menú</button></a>'; // Boton que redirecciona al menú principal.

?>


