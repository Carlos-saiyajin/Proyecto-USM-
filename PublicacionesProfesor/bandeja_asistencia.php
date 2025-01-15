<!DOCTYPE html>
<html lang="es"> <!-- Definimos el idioma en español. -->
    
    <head> 
      
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Asistencias Alumnos</title>
      <link rel="stylesheet" href="CSS/bandeja_asistencia.css">
    
    </head>
    
    <body>

        <div class="container">
          
            <div class="header">
              
                <h2>Bandeja De Asistencias</h2>
                
                <div class="header-buttons">
                   
                   <a href="menu.php">Menú</a>
                
                </div>
            
            </div>

            <div class="user-list">
            
                <?php 

                  session_start(); 

                  $array_A=[];
                  $array_I=[];

                  if(isset($_SESSION['array_A']) and isset($_SESSION['array_I'])) 
                  {
                    $array_A = $_SESSION['array_A'];
                    $array_I = $_SESSION['array_I'];
                  }

                  $A=0;
                  $I=0;

                  $conexion=mysqli_connect("localhost","root","","datos_login") or die("Hubo Problemas para conectarse a la base de datos."); 

                  $sql1="SELECT * FROM profe_y_alumno";
                  $accion1=mysqli_query($conexion, $sql1) or die(mysqli_error($conexion));

                  $conexion2 = mysqli_connect("localhost", "root", "", "bandeja_asistencia") or die("Hubo Problemas para conectarse a la base de datos.");
                  $sql2="DELETE FROM alumnos";
                  $accion2=mysqli_query($conexion2, $sql2) or die(mysqli_error($conexion2));

                  while($resultados1=mysqli_fetch_array($accion1)) 
                  {
                    if($resultados1['accesos']==0)
                    {
                      $id=$resultados1['id'];
                      $nombre=$resultados1['nombres'];
                      $apellido=$resultados1['apellidos'];
                      $correo_alumno=$resultados1['mail'];

                      if (!isset($array_A[$A]) and !isset($array_I[$I])) 
                      {
                        $sql3="INSERT INTO alumnos (id, nombre, apellido, correo_alumno, asistencia, inasistencia) VALUES ('$id', '$nombre', '$apellido', '$correo_alumno', '', '')";
                        $accion2=mysqli_query($conexion2, $sql3) or die(mysqli_error($conexion2));
                      } 
                      else 
                      {
                        $sql3="INSERT INTO alumnos (id, nombre, apellido, correo_alumno, asistencia, inasistencia) VALUES ('$id', '$nombre', '$apellido', '$correo_alumno', '$array_A[$A]', '$array_I[$I]')";
                        $accion2=mysqli_query($conexion2, $sql3) or die(mysqli_error($conexion2));
                      }

                      $A++;
                      $I++;
                    }
                          
                  }
  
                  $sql4="SELECT * FROM alumnos";
                  $accion4=mysqli_query($conexion2, $sql4) or die(mysqli_error($conexion2));

                  $ID=[];
                  $i=0;

                  while ($arreglo = mysqli_fetch_array($accion4)) 
                  {
                    $ID[$i]=$arreglo['id'];
                    $i++;
                  }

                  $_SESSION['ID'] = $ID;

                  $sql5="SELECT * FROM alumnos";
                  $accion5=mysqli_query($conexion2, $sql4) or die(mysqli_error($conexion2));

                  echo'<table>';
                     
                  echo'<tr>';
                          
                    echo'<th>ID</th>';
                    echo'<th>Nombre</th>';
                    echo'<th>Apellido</th>';
                    echo'<th>Correo</th>';
                    echo'<th>Asistencia</th>';
                    echo'<th>Inasistencia</th>';
                    echo'<th>% Asistencia</th>';
                    echo'<th>% Inasistencia</th>';
                    echo'<th>Selección</th>';
                        
                  echo'</tr>';

                  while($resultados5=mysqli_fetch_array($accion5)) 
                  {
                          
                    if($resultados5['asistencia']==0 and $resultados5['inasistencia']==0) 
                    {
                      $porcentaje_A=0;
                      $porcentaje_I=0;
                    } 
                    else 
                    {
                      $total=$resultados5['asistencia']+$resultados5['inasistencia'];
                      $porcentaje_A=($resultados5['asistencia']*100)/($total);
                      $porcentaje_I=($resultados5['inasistencia']*100)/($total);
                    }

                    echo'<tr>';
                              
                      echo'<td>' . $resultados5['id'] . '</td>';
                      echo'<td>' . $resultados5['nombre'] . '</td>';
                      echo'<td>' . $resultados5['apellido'] . '</td>';
                      echo'<td>' . $resultados5['correo_alumno'] . '</td>';
                      echo'<td>' . $resultados5['asistencia'] . '</td>';
                      echo'<td>' . $resultados5['inasistencia'] . '</td>';
                      echo'<td>' . number_format($porcentaje_A, 2) . '%</td>';
                      echo'<td>' . number_format($porcentaje_I, 2) . '%</td>';
                                
                      echo'<td>
                              
                        <form action="select_bandeja.php" method="post">
                                  
                          <select name="verif[]">
                                          
                            <option value="0">Asistente</option>
                            <option value="1">Inasistente</option>
                            <option value="nulo">No Asignar</option>
                                        
                          </select>
                                  
                      </td>';
                            
                    echo '</tr>';
                  }

                  echo'</table>';
                   
                  echo'<div class="action-buttons">';
                       
                    echo'<button type="submit">Registrar</button>';
                    echo'<button type="submit" name="vaciar" value="Vaciar">Vaciar Registro</button>';
                       
                    echo'</form>'; // Cierre del formulario.
                    
                  echo'</div>';
                
                ?>
        
            </div>
    
        </div>

    </body>

</html>
