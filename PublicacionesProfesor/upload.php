<?php
   
   echo'
   <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            background: url("imagenes/pito.jpg") no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: white;
        }

        .header {
            background: rgba(0, 123, 255, 0.9);
            padding: 10px 20px;
            border-radius: 8px;
            width: 100%;
            box-sizing: border-box;
            animation: fadeIn 1s;
            margin-bottom: 20px;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-content img {
            height: 75px;
        }

        .header-content p {
            font-size: 1.2em;
            font-weight: bold;
        }

        .main_container {
            width: 60%;
            background-color: rgba(255, 255, 255, 0.77);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 20px auto;
            animation: fadeIn 1s;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .solicitud img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .solicitud h3 {
            margin-bottom: 20px;
            color: rgba(0, 0, 0, 0.788);
        }

        .formulario {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .formulario input[type="file"] {
            display: block;
            margin: 0 auto 20px auto;
        }

        .formulario input[type="submit"] {
            background-color: rgba(0, 123, 255, 0.7);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 0 auto;
            display: block;
        }

        .formulario input[type="submit"]:hover {
            background-color: rgba(0, 68, 148, 0.7);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        input{
            color:black;
        }

        p{
           color:black;
        }

        a{
            text-decoration:none;
        }
        
        button{
            background-color: rgba(0, 123, 255, 0.7);
            color: white;
            font-family:Arial;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 0 auto;
            display: block;
        }

        button:hover{
            background-color: rgba(0, 68, 148, 0.7);
        }

        .titulo{
            color:white;
        }
   </style>';

   session_start(); // LLamamos a la función "session_start()" para utilizar las variables de sesión.

   if($_FILES['archivo']['error'] === UPLOAD_ERR_OK) // Verificamos si el archivo se envió correctamente.
   {
      $nombreArchivo=$_FILES['archivo']['name']; // Guardamos el nombre del archivo.
      $ubicacionTemporal=$_FILES['archivo']['tmp_name']; // Ubicamos temporalmente el archivo.
      $ubicacionFinal="C:/wamp64/www/proyecto_USM/PublicacionesProfesor/publicaciones/$nombreArchivo"; // Definimos la ruta final del archivo.
      
      $existe_archivo=file_exists("C:/wamp64/www/proyecto_USM/PublicacionesProfesor/publicaciones/$nombreArchivo"); // Almacenamos en la "existe_archivo" si el archivo a publicar existe o no.
      
      if($existe_archivo) // Verificamos si el archivo a publicar ya existe.
      {
        echo'<div class="header">
        <div class="header-content">
            <img src="imagenes/Logo_USM_Horizontal.png" alt="Logo">
            <p class="titulo">Universidad Santa Maria</p>
            <p class="titulo">Periodo: 2024-2025</p>
        </div>
    </div>

    <div class="main_container">
        <div class="solicitud">
          <p>El archivo a publicar ya existe o el archivo tiene el mismo nombre a un archivo ya publicado.</p>"
          '.'<a href="menu_index.php"><button>Regresar al menú</button></a>'.'

        </div>
    </div>';

        exit(); // Finalizamos el programa.
      }

      if(move_uploaded_file($ubicacionTemporal,$ubicacionFinal)) // Verificamos si el archivo se subió correctamente.
      {  
         date_default_timezone_set("America/Caracas"); // Definimos la zona horaria.
         
         $fecha=date("d \/ m \/ Y")."/"; // Guardamos la fecha actual del sistema en la variable "fecha".
         $hora=date("H\:i"); // Guardamos la hora actual del sistema en la variable "hora".

         $fecha_completa=$fecha." Hora ".$hora; // Guardamos la fecha completa en la que se subió el archivo a publicar.
         
         $archivo_subido="publicaciones/".$nombreArchivo; // Almacenamos la ruta y el nombre del archivo subido.
         
         if($_SESSION['total']==null) // Verfiricamos si la variable de sesión "total" esta vacía, que viene del archivo "publicaciones_subidas.php".
         {
            $archivo1=fopen("Public/publicaciones.txt","w+"); // Abrimos el achivo "publicaciones.txt" en modo escritura.
   
               fwrite($archivo1,$archivo_subido."\n"); // Agregamos el archivo.
             
            fclose($archivo1); // Cerramos el archivo "publicaciones.txt".
            
            $archivo2=fopen("Fechas/fechas.txt","w+"); // Abrimos el archivo "fechas.txt" en modo escritura.
            
              fwrite($archivo2,$fecha_completa."\n"); // Agregamos la fecha en la que se subió el archivo.
 
            fclose($archivo2); // Cerramos el archivo "fechas.txt".

            $archivo1=fopen("C:/wamp64/www/proyecto_USM/parte_alumnos/Public/publicaciones.txt","w+"); // Abrimos el achivo "publicaciones.txt" en modo escritura.
   
               fwrite($archivo1,$archivo_subido."\n"); // Agregamos el archivo.
             
            fclose($archivo1); // Cerramos el archivo "publicaciones.txt".
            
            $archivo2=fopen("C:/wamp64/www/proyecto_USM/parte_alumnos/Fechas/fechas.txt","w+"); // Abrimos el archivo "fechas.txt" en modo escritura.
            
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

            $archivo1=fopen("C:/wamp64/www/proyecto_USM/parte_alumnos/Public/publicaciones.txt","a+"); // Abrimos el achivo "publicaciones.txt" en modo escritura.
   
               fwrite($archivo1,$archivo_subido."\n"); // Agregamos el archivo.
             
            fclose($archivo1); // Cerramos el archivo "publicaciones.txt".

            $archivo2=fopen("C:/wamp64/www/proyecto_USM/parte_alumnos/Fechas/fechas.txt","a+"); // Abrimos el archivo "fechas.txt".
            
              fwrite($archivo2,$fecha_completa."\n"); // Agregamos la fecha en la que se subió el archivo.
 
            fclose($archivo2); // Cerramos el archivo "fechas.txt".
         }
         
         echo'<div class="header">
        <div class="header-content">
            <img src="imagenes/Logo_USM_Horizontal.png" alt="Logo">
            <p class="titulo">Universidad Santa Maria</p>
            <p class="titulo">Periodo: 2024-2025</p>
        </div>
    </div>

    <div class="main_container">
        <div class="solicitud">
            <p>El archivo se ha subido correctamente.</p>
            <img src="imagenes/correcto.png"/>
            <a href="menu_index.php"><button>Regresar al menu</button></a>

        </div>
    </div>';
         
         //echo "El archivo se ha subido correctamente.";
         //echo"<br></br>";

         //echo'<a href="menu.php"><button>Regresar al menu</button></a>';
      } 
      else // Verificamos si el archivo no se pudo subir.
      {  
        echo'<div class="header">
        <div class="header-content">
            <img src="imagenes/Logo_USM_Horizontal.png" alt="Logo">
            <p class="titulo">Universidad Santa Maria</p>
            <p class="titulo">Periodo: 2024-2025</p>
        </div>
    </div>

    <div class="main_container">
        <div class="solicitud">
            <p>Error al subir el archivo.</p>
            <img src="imagenes/error.png"/>
            <a href="menu_index.php"><button>Regresar al menu</button></a>

        </div>
    </div>';
        
      }
   }
   else // Verificamos si el archivo presentó un error.
   {  
    echo'<div class="header">
    <div class="header-content">
        <img src="imagenes/Logo_USM_Horizontal.png" alt="Logo">
        <p class="titulo">Universidad Santa Maria</p>
        <p class="titulo">Periodo: 2024-2025</p>
    </div>
</div>

<div class="main_container">
    <div class="solicitud">
        <p>Error al subir el archivo.</p>
        <img src="imagenes/error.png"/>
        <a href="menu_index.php"><button>Regresar al menu</button></a>

    </div>
</div>';

     exit();
   }
?>



