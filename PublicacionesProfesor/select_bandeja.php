<?php

session_start(); // LLamamos a la función "session_start()" para utilizar las variables de sesión.

if((!isset($_POST['vaciar'])) and (!isset($_POST['si'])) and (!isset($_POST['no']))) // Verificamos si no se presionó el botón "Vaciar Registro" y los botones "si" y "no".
{
   $asistencias=$_POST['verif']; // Almacenamos las asistencias y inasistencias.
   $ID=$_SESSION['ID']; // Almacenamos los ID de los alumnos asistentes y inasistentes.

   // Establecemos la conexión con la base de datos :

   $conexion=mysqli_connect("localhost","root","Carlos1010*","bandeja_asistencia") or die("Hubo Problemas para conectarse a la base de datos.");

   $sql1="SELECT * FROM alumnos"; // Definimos la acción 1.

   $accion1=mysqli_query($conexion,$sql1); // Ejecutamos la acción 1.

   $i=0; // Declaramos el iterador "i" para manejar las asistencias.
   $j=0; // Declaramos el iterador "j" para manejar los ID.

   // Convertimos la tabla alumnos en un arreglo y recorremos la tabla para registrar las asistencias e inasistencias :

   while($resultados1=mysqli_fetch_array($accion1))
   {
      if($ID[$j]==$resultados1['id']) // Verificamos que el "ID" sea igual al "id" de la tabla.
      { 
        if($asistencias[$i]=="nulo" and $resultados1['asistencia']==0)
        {
            $nuevo_valor=0;
 
            $sql7="UPDATE alumnos SET asistencia='$nuevo_valor' WHERE id='$ID[$j]'";
 
            $accion7=mysqli_query($conexion,$sql7) or die(mysqli_error($conexion));
        }
        else if($asistencias[$i]=="nulo" and $resultados1['inasistencia']==0)
        {
            $nuevo_valor=0;
 
            $sql8="UPDATE alumnos SET inasistencia='$nuevo_valor' WHERE id='$ID[$j]'";
 
            $accion8=mysqli_query($conexion,$sql8) or die(mysqli_error($conexion));
        }
        else if($asistencias[$i]=="nulo" and $resultados1['asistencia']!=0)
        {
            $nuevo_valor=$resultados1['asistencia'];
 
            $sql9="UPDATE alumnos SET asistencia='$nuevo_valor' WHERE id='$ID[$j]'";
 
            $accion9=mysqli_query($conexion,$sql9) or die(mysqli_error($conexion));
        }
        else if($asistencias[$i]=="nulo" and $resultados1['inasistencia']!=0)
        {
            $nuevo_valor=$resultados1['inasistencia'];
 
            $sql10="UPDATE alumnos SET inasistencia='$nuevo_valor' WHERE id='$ID[$j]'";
        }
        else if($asistencias[$i]==0 and $resultados1['asistencia']==0) // Verificamos si el alumno estuvo asistente y si no tiene asistencias registradas.
        {
           $nuevo_valor=1; // Definimos el valor de la asistencia.
          
           $sql2="UPDATE alumnos SET asistencia='$nuevo_valor' WHERE id='$ID[$j]'"; // Definimos la acción 2.

           $accion2=mysqli_query($conexion,$sql2) or die(mysqli_error($conexion)); // Ejecutamos la acción 2.
        }
        else if($asistencias[$i]==1 and $resultados1['inasistencia']==0) // Verificamos si el alumno estuvo inasistente y si no tiene inasistencias registradas.
        { 
           $nuevo_valor=1; // Definimos el valor de la inasistencia.
          
           $sql3="UPDATE alumnos SET inasistencia='$nuevo_valor' WHERE id='$ID[$j]'"; // Definimos la acción 3.

           $accion3=mysqli_query($conexion,$sql3) or die(mysqli_error($conexion)); // Ejecutamos la acción 3.
        }
        else if($asistencias[$i]==0 and $resultados1['asistencia']!=0) // Verificamos si el alumno estuvo asistente y si tiene asistencias registradas.
        {
           $nuevo_valor=$resultados1['asistencia']+1; // Definimos el valor de la asistencia.

           $sql4="UPDATE alumnos SET asistencia='$nuevo_valor' WHERE id='$ID[$j]'"; // Definimos la acción 4.

           $accion4=mysqli_query($conexion,$sql4) or die(mysqli_error($conexion)); // Ejecutamos la acción 4.
        }
        else if($asistencias[$i]==1 and $resultados1['inasistencia']!=0) // Verificamos si el alumno estuvo inasistente y si tiene inasistencias registradas.
        {
           $nuevo_valor=$resultados1['inasistencia']+1; // Definimos el valor de la inasistencia.

           $sql5="UPDATE alumnos SET inasistencia='$nuevo_valor' WHERE id='$ID[$j]'"; // Definimos la acción 5.

           $accion5=mysqli_query($conexion,$sql5) or die(mysqli_error($conexion)); // Ejecutamos la acción 5.
        }
       
        $i=$i+1; // Aumentamos los iteradores.
        $j=$j+1; // Aumentamos los iteradores.
     }

   }

   $array_A=[]; // Definimos el arreglo donde almacenaremos las asistencias.
   $array_I=[]; // Definimos el arreglo donde almacenaremos las inasistencias.

   $A=0; // Definimos el iterador para almacenar las asistencias.
   $I=0; // Definimos el iterador para almacenar las inasistencias.

   $sql6="SELECT * FROM alumnos"; // Definimos la acción 6.

   $accion6=mysqli_query($conexion,$sql6); // Ejecutamos la acción 6.

   // Convertimos la tabla "alumnos" en un arreglo y la recorremos para almacenar las asistencias e inasistencias :

   while($resultados2=mysqli_fetch_array($accion6))
   {
     $array_A[$A]=$resultados2['asistencia'];
     $array_I[$I]=$resultados2['inasistencia'];
   
     // Aumentamos los iteradores :

     $A=$A+1; 
     $I=$I+1; 
   }

   $_SESSION['array_A']=$array_A; // Alamacenamos las asisencias registradas dentro de la variable de sesión "array_A".
   $_SESSION['array_I']=$array_I; // Alamacenamos las inasistencias registradas dentro de la variable de sesión "array_I".
   
   mysqli_close($conexion) or die("Hubo Problemas para cerrar la conexión con la base de datos."); // Cerramos sesión con la base de datos.

   header("Location: bandeja_asistencia.php"); // Redireccionamos a la página "bandeja_asistencia.php".
}

if(isset($_POST['vaciar'])) // Verficamos si se presionó el botón "Vaciar Registro".
{
   // Solicitamos la validación para vaciar el registro de las asistencias :

   echo'<form action="select_bandeja.php" method="post">
     
     <p> ¿ Desea Vaciar el registro ? </p>

     <input type="submit" name="si" value="Si">
     <input type="submit" name="no" value="NO"> 
      
   </form>';
}

if(isset($_POST['si']))
{
  // Establecemos la conexión con la base de datos : 
  
  $conexion=mysqli_connect("localhost","root","Carlos1010*","bandeja_asistencia") or die("Hubo Problemas para conectarse a la base de datos.");
  
  $asistencia=0;
  $inasistencia=0;
  
  $sql5="UPDATE alumnos SET asistencia='$asistencia' AND inasistencia='$inasistencia'";
   
  $accion5=mysqli_query($conexion,$sql5);
   
  $array_A=[];
  $array_I=[];
  
  $_SESSION['array_A']=$array_A;
  $_SESSION['array_I']=$array_I;
  
  mysqli_close($conexion);
  
  header("Location: bandeja_asistencia.php");
}
else if(isset($_POST['no']))
{ 
   header("Location: bandeja_asistencia.php"); // Redireccionamos a la página "bandeja_asistencia.php".
}

?>