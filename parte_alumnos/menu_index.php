<?php
  
  session_start(); // LLamamos a la función "session_start()" para utilizar las variables de sesión.

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones</title>
    <link rel="stylesheet" href="CSS/publicaciones.css">
    
</head>
<body>
    <div class="header">
        <div class="header-content">
            <img src="imagenes/Logo_USM_Horizontal.png" alt="Logo">
            <div class="welcome-message">¡Publicaciones del profesor!</div>
            <div class="date" id="date"></div>
        </div>
    </div>

    <div class="main_container">
        <div class="buttons">
            <a href="menu.php">
                <button class="menu">Regresar al menú</button>
            </a>
        </div>

        <table>
            <thead>
                <tr>
                    <th class="table_head">Publicaciones Subidas</th>
                    <th class="table_head">Fecha de la Publicación</th>
                </tr>
            </thead>
            
            <tbody>
                
                <?php
                    
                    include("publicaciones_subidas.php"); // Incluimos el archivo "publicaciones_subidas.php".
                    
                    $total_archivos=$i; // Almacenamos el numero total de archivos.
                    $archivos_subidos=$arreglo_archivos; // Almacenamos los archivos subidos en el arreglo "archivos_subidos".
                    $fechas_archivos=$arreglo_fechas; // Almacenamos las fechas de los archivos subidos en el arreglo "fechas_arhivos".
                    $count=1; // Declaramos el iterador para enumerar los archivos.

                    // Recorremos los arreglos "archivos_subidos" y "fechas_archivos" e imprimimos los enlaces de los archivos en pantalla :
                    
                    for($j=0;$j<$total_archivos;$j++) 
                    {
                        if(isset($archivos_subidos[$j])) // Verificamos si en la posición del arreglo "archivos_subidos" tiene algún valor.
                        {
                            echo '<tr>';
                            echo '<td>'.$count.'.&nbsp;<a class="enlaces" href="'.$archivos_subidos[$j].'">'.$archivos_subidos[$j].'</a></td>';
                            echo '<td>'.$fechas_archivos[$j].'</td>';
                            echo '</tr>';
                        }
                        else // Verificamos si en la posición del arreglo "archivos_subidos" no tiene algún valor.
                        {
                            goto salir; // Realizamos un salto a la etiqueta "salir".
                        }
                        
                        salir:

                        $count++; // Aumentamos el iterador.
                    }
                ?>
            
            </tbody>
        
        </table>
    
    </div>
    
    <script>
        // Set the date in the header
        document.getElementById('date').textContent = new Date().toLocaleDateString();
    </script>

</body>
</html>
