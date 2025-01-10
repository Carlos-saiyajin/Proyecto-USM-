<?php
   
   session_start(); // LLamamos a la función "session_start()" para utilizar las variables de sesión.

   if($_FILES['archivo']['error'] === UPLOAD_ERR_OK) // Verificamos si el archivo se envió correctamente.
   {
      $nombreArchivo=$_FILES['archivo']['name']; // Guardamos el nombre del archivo.
      $ubicacionTemporal=$_FILES['archivo']['tmp_name']; // Ubicamos temporalmente el archivo.
      $ubicacionFinal="C:/wamp64/www/proyecto_USM/PublicacionesProfesor/publicaciones/$nombreArchivo"; // Definimos la ruta final del archivo.
  
      if(move_uploaded_file($ubicacionTemporal,$ubicacionFinal)) // Verificamos si el archivo se subió correctamente.
      {  
         date_default_timezone_set("America/Caracas"); // Definimos la zona horaria.
         
         $fecha_completa=date("d \/ m \/ Y"); // Guardamos la fecha actual del sistema en la variable "fecha_completa".
         
         // $_SESSION['fecha']=$fecha_completa;
         // $_SESSION['nombre_archivo']="publicaciones/".$nombreArchivo;
         
         $archivo_subido="publicaciones/".$nombreArchivo; // Almacenamos la ruta y el nombre del archivo subido.

         if($_SESSION['total']==null) // Verfiricamos si la variable de sesión "total" esta vacía, que viene del archivo "publicaciones_subidas.php".
         {
            $archivo1=fopen("Public/publicaciones.txt","w+"); // Abrimos el achivo "publicaciones.txt" en modo escritura.
   
               fwrite($archivo1,$archivo_subido."\n"); // Agregamos el archivo.
             
            fclose($archivo1); // Cerramos el archivo "publicaciones.txt".

            $archivo2=fopen("Fechas/fechas.txt","w+"); // Abrimos el archivo "fechas.txt" en modo escritura.
            
              fwrite($archivo2,$fecha_completa."\n"); // Agregamos la fecha en la que se subió el archivo.
 
            fclose($archivo2); // Cerramos el archivo "fechas.txt".
         }
         else // Verfiricamos si la variable de sesión "total" no esta vacía, que viene del archivo "publicaciones_subidas.php".
         {
            $archivo1=fopen("Public/publicaciones.txt","a+"); // Abrimos el achivo "publicaciones.txt" en modo escritura.
   
              fwrite($archivo1,$archivo_subido."\n"); // Agregamos el archivo.
             
            fclose($archivo1); // Cerramos el archivo "publicaciones.txt".

            $archivo2=fopen("Fechas/fechas.txt","a+"); // Abrimos el archivo "fechas.txt".
            
              fwrite($archivo2,$fecha_completa."\n"); // Agregamos la fecha en la que se subió el archivo.
 
            fclose($archivo2); // Cerramos el archivo "fechas.txt".
         }

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
      
      echo "Error al subir el archivo.";
      echo"<br><br>";
      echo'<a href="menu.php"><button>Regresar al menu</button></a>';
      exit();
   }
?>



