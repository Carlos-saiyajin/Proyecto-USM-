<!DOCTYPE html>
  <html lang="es">

  <head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/publicaciones.css">
    <title>Publicaciones</title>
   
  </head>
    
  <body>
    
    <div class="imagen_fondo">

      <header>
      
        <div class="logo">
           
          <img src="CSS/Imagenes/logo_usm.png"/>

        </div>
      
        <h1><u>Bienvenidos a las publicaciones del profesor :</u></h1>

        <form action="verificacion.php" method="post">
        
          <label for="op">Opciones:</label>
          <select name="opcion" id="op">
          
            <option value="upload">Subir Archivo</option>
            <option value="edit">Editar Archivo</option>
            <option value="delete">Eliminar Archivo</option>
          
          
          </select>

          <input type="submit" value="aceptar">
        
        </form>
      
        <a href="menu.php"><button>Regresar al menú</button></a>
      
      </header>

      <div id="main_container">
         
        <table>
          
          <thead>
            
            <th>Publicaciones Subidas  </th>
            <th>Fecha de la Publicación </th>
            
          </thead>
  
          <?php 
            
            session_start(); // LLamamos a la función "session_start()" para utilizar las variables de sesión.
            
            /*if(!isset($_SESSION['fecha']))
            {
              $fecha="0 / 0 / 0";
            }
            else if(isset($_SESSION['fecha']))
            {
              $fecha=$_SESSION['fecha'];
            } */
            
            include("publicaciones_subidas.php"); // Incluimos el archivo "publicaciones_subidas.php".
            
            $total_archivos=$i; // Almacenamos el numero total de archivos.
            $archivos_subidos=$arreglo_archivos; // almacenamos los archivoss subidos en el arreglo "archivos_subidos".
            $fechas_archivos=$arreglo_fechas; // Almacenamos las fechas de los archivos subidos en el arreglo "fechas_arhivos".

            $count=1; // Declaramos el iterador para enumerar los archivos.

            // Recorremos los arreglos "archivos_subidos" y "fechas_archivos" e imprimimos los enlaces de los archivos en pantalla :

            for($j=0;$j<$total_archivos;$j++) 
            {
              if(isset($archivos_subidos[$j])) // Verificamos si en la posición del arreglo "archivos_subidos" tiene algún valor.
              {
                // Imrpimimos en pantala :

                echo'<tr>';
                
                  echo'<td>'.$count.'.'.'&nbsp'.'<a href="'.$archivos_subidos[$j].'">'.$archivos_subidos[$j].'</a></td>';
                  echo'<td>'.$fechas_archivos[$j].'</td>';
                
                echo'</tr>';
              }
              else // Verificamos si en la posición del arreglo "archivos_subidos" no tiene algún valor.
              {
                goto salir; // Realizamos un salto a la etiqueta "salir".
              }

              salir:

              $count++; // Aumentamos el iterador.
              
            }
          
          ?>

        </table>
        
      </div>
    
    </div>

  </body>

</html>