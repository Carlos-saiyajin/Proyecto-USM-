<?php

   $verif=$_POST['opcion']; // Guardamos dentro de la variable "verif" la opción a ejecutar enviada por el profesor.

   if($verif=="upload") // Verificamos si la opción ingresada es subir archivo.
   {
      include("subir_publicacion.html"); // Redireccionamos al archivo "upload.php".
   }
   else if($verif=="edit") // Verificamos si la opción ingresada es editar archivo.
   {
      // Solicitamos el archivo a modificar : 

      echo'<form action="opcion_edit.php" method="post" enctype="multipart/form-data">
           
         <input type="file" name="archivo" required>
         <br></br>
         <input type="submit" name="editar" value="Modificar Archivo">
         
      </form>';
   }
   else if($verif=="delete") // Verificamos si la opción ingresada es eliminar archivo.
   {
      // Solicitamos el archivo a eliminar :

      echo'<html>
   
         <body>
         
            <form action="opcion_delete.php" method="post" enctype="multipart/form-data">
               <input type="file" name="archivo">
               <br></br>
               <input type="submit" name="borrar" value="Eliminar Archivo">
            </form>
         
         </body>
      </html>';
   }

?>