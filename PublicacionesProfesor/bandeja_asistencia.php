<?php 

  session_start(); // LLamamos a la función "session_start()" para utilizar las variables de sesión.

  $array_A=[]; // Definimos el arreglo donde se almacenó las asistencias del archivo "select_bandeja.php".
  $array_I=[]; // Definimos el arreglo donde se almacenó las inasistencias del archivo "select_bandeja.php".
  
  if(isset($_SESSION['array_A']) and isset($_SESSION['array_I'])) // Verificamos si las variables de sesión tienen algún valor.
  {
    $array_A=$_SESSION['array_A']; // Almacenamos en el arreglo "$array_A" las asistencias registradas.
    $array_I=$_SESSION['array_I']; // Alamacenamos en el arreglo "array_I" las inasistencias registradas.
  }
  
  $A=0; // Definimos el iterador para almacenar las asistencias.
  $I=0; // Definimos el iterador para almacenar las inasistencias.
  
  // Establecemos la conexión con la base de datos :
  
  $conexion=mysqli_connect("localhost","root","Carlos1010*","datos_login") or die("Hubo Problemas para conectarse a la base de datos."); 
  
  $sql1="SELECT * FROM alumnos"; // Definimos la acción 1.
  
  $accion1=mysqli_query($conexion,$sql1) or die(mysqli_error($conexion)); // Ejecutamos la acción 1.
  
  // Establecemos la conexión con la base de datos :
  
  $conexion2=mysqli_connect("localhost","root","Carlos1010*","bandeja_asistencia") or die("Hubo Problemas para conectarse a la base de datos.");
  
  $sql2="DELETE FROM alumnos"; // Definimos la acción 2.
  
  $accion2=mysqli_query($conexion2,$sql2) or die(mysqli_error($conexion2)); // Ejecutamos la acción 2.
  
  // Convertimos la tabla "datos_login" en un arreglo y la recorremos dentro del bucle "while()" :
  
  while($resultados1=mysqli_fetch_array($accion1)) 
  {
    $id=$resultados1['id']; // Almacenamos el "id" del alumno.
    $nombre=$resultados1['nombres']; // Almacenamos el "nombre" del alumno.
    $apellido=$resultados1['apellidos']; // Almacenamos el "apellido" del alumno.
    $correo_alumno=$resultados1['correo_alumno']; // Almacenamos el "correo" del alumno.
    
    if(!isset($array_A[$A]) and !isset($array_I[$I])) // Verificamos si en la posición de los arreglos no hay ningún valor.
    {
      $sql3="INSERT INTO alumnos (id,nombre,apellido,correo_alumno,asistencia,inasistencia) VALUES ('$id','$nombre','$apellido','$correo_alumno','','')"; // Definimos la acción 3.
      
      $accion2=mysqli_query($conexion2,$sql3) or die(mysqli_error($conexion2)); // Ejecutamos la acción 3.
    }
    else // Verficamos si en la posición de los arreglos tienen un valor. 
    {
      $sql3="INSERT INTO alumnos (id,nombre,apellido,correo_alumno,asistencia,inasistencia) VALUES ('$id','$nombre','$apellido','$correo_alumno','$array_A[$A]','$array_I[$I]')"; // Definimos la acción 3.
      
      $accion2=mysqli_query($conexion2,$sql3) or die(mysqli_error($conexion2)); // Ejecutamos la acción 3.
    }
    
    // Aumentamos los iteradores : 
  
    $A=$A+1;
    $I=$I+1;
  }
  
  $sql4="SELECT * FROM alumnos"; // Definimos la acción 4.
  
  $accion4=mysqli_query($conexion2,$sql4) or die(mysqli_error($conexion2)); // Ejecutamos la acción 4.
  
  $ID=[]; // Definimos el arreglo donde almacenaremos los "ID". 
  $i=0; // Definimos el iterador.
  
  // Convertimos la tabla "alumnos" en un arreglo lo recorremos para almacenar los "ID" :
  
  while($arreglo=mysqli_fetch_array($accion4))
  {
    $ID[$i]=$arreglo['id'];
    $i=$i+1; // Aumentamos el iterador.
  }
  
  $_SESSION['ID']=$ID; // Almacenamos el arreglo "ID" en la variable de sesión.
  
  $sql5="SELECT * FROM alumnos"; // Definimos la acción 5.
  
  $accion5=mysqli_query($conexion2,$sql4) or die(mysqli_error($conexion2)); // Ejecutamos la acción 5.
  
  // Definimos el encabezado de la tabla :
  
  echo'<table>';
  
    echo'<th>';
  
      echo'<td>'.'&nbsp'.'ID</td>';
      echo'<td>'.'&nbsp'.'Nombre</td>';
      echo'<td>'.'&nbsp'.'Apellido</td>';
      echo'<td>'.'&nbsp'.'Correo</td>';
      echo'<td>'.'&nbsp'.'Asistencia</td>';
      echo'<td>'.'&nbsp'.'Inasistencia</td>';
  
    echo'</th>';
  
  echo'</table>';
  
  // Convertimos la tabla "alumnos" en un arreglo ,lo almacenamos en "resultados4" y recorremos el arreglo :
  
  while($resultados5=mysqli_fetch_array($accion5))
  {
    // Imprimimos en pantalla los registros de la tabla "alumnos" :
    
    // Definimos la tabla : 
    
    echo'<table> 
     
      <tr>
        
        <td> '."&nbsp"."&nbsp"."&nbsp". $resultados5['id'].'</td>
        <td> '."&nbsp"."&nbsp". $resultados5['nombre'].'</td>
        <td> '."&nbsp"."&nbsp". $resultados5['apellido'].'</td>
        <td> '."&nbsp". $resultados5['correo_alumno'].'</td>
        <td> '."&nbsp". $resultados5['asistencia'].'</td>
        <td> '."&nbsp". $resultados5['inasistencia'].'</td>
  
        <form action="select_bandeja.php" method="post">
        
          <td>'."&nbsp"."&nbsp"."&nbsp".'
        
          <label>Selección : 
            
            <select name=verif[]>
        
              <option value="0">Asistente</option>
              <option value="1">Inasistente</option>
  
            </select>
          
          </label>
        
        </td>
          
      </tr>
    
    </table>';
  
  }
  
  echo'<br>'."&nbsp".
  
    '<input type="submit" value="Registrar">'."&nbsp"."&nbsp".'<input type="submit" name="vaciar" value="Vaciar Registro">
  
  </form>'; // Cierre del formulario.

?>