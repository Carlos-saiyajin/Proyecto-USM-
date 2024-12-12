<?php
    
   session_start();
    
   if(isset($_POST['enviar1']))
   {
      $sacos_harina=$_POST['harina'];

      echo'<h3>Departamento de almacén :</h3>';
      echo"- Se recibe la materia prima solicitada.";
      echo"<br>";
      echo"- Se realiza la revisión y control de la materia prima.";
      echo"<br></br>";

      echo'<form action="diagrama_pan.php" method="post">
      Indique si la materia prima esta en buen estado : 
      <input type="text" name="estado" placeholder=" Si / No">
      <input type="submit" name="verif1" value="Indicar">
      </form>';
      exit();
   }

   if(isset($_POST['verif1']))
   {
      $harina_estado=$_POST['estado'];

      if($harina_estado=="no" or $harina_estado=="No" or $harina_estado=="NO")
      {
         echo"- Se devuelve la materia prima recibida.";
         echo"<br></br>";
         echo'<form action="diagrama_pan.php" method="post">
         ¿Cuantos sacos de harina desea solicitar nuevamente? : 
         <input type="float" name="harina">
         <br></br>
         <input type="submit" name="enviar1" value="Solicitar">
         </form>';
         exit();
      }
      else if($harina_estado=="si" or $harina_estado=="Si" or $harina_estado=="SI")
      {
         echo"- Se realiza el pago de la materia recibida.";
         echo"<br>";
         echo"- Se realiza el almacenamiento de la materia prima.";
         echo"<br>";
         echo"- Se lleva la materia prima al departamento de producción.";
         echo"<br></br>";

         echo'<form action="diagrama_pan.php" method="post">';
         echo'<input type="submit" name="enviar2" value="LLevar">';
         echo'</form>';
         exit();
      } 
   }
   
   if(isset($_POST['enviar2']))
   {
      echo"<h3>Departamento De Producción :</h3>";
      echo"- Se lleva la materia prima al área de producción.";
      echo"<br>";
      echo"- Se acomoda la materia prima.";
      echo"<br>";

      salto1:
      
      echo"- Se realiza la producción del pan en diferentes presentaciones.";
      echo"<br></br>";

      echo'<form action="diagrama_pan.php" method="post">';
      echo'. Indique si la producción del pan cumple con la calidad deseada : ';
      echo'<input type="text" name="calidad" placeholder=" SI / NO">';
      echo'<br></br>';
      echo'<input type="submit" name="verif2" value="Inidcar">';
      exit();
   }
   
    
   if(isset($_POST['verif2']))
   {
      $calidad_produccion=$_POST['calidad'];

      if($calidad_produccion=="no" or $calidad_produccion=="No" or $calidad_produccion=="NO")
      {
         echo"- Se descarta la producción.";
         echo"<br>";
         goto salto1;
      }
      else if($calidad_produccion=="si" or $calidad_produccion=="Si" or $calidad_produccion=="SI")
      {
         echo"- Se realiza el empaquetamiento.";
         echo"<br>";
         echo"- Se lleva el empaquetado al departamento de ventas.";
         echo"<br>";
         
         echo'<form action="diagrama_pan.php" method="post">';
         echo'<br>';
         echo'<input type="submit" name="enviar3" value="LLevar">';
         echo'</form>';
         exit();
      } 
   }
   
   if(isset($_POST['enviar3']))
   {
      echo"<h3>Departamentos De Ventas :</h3>";
      echo"- Se realiza la atención al cliente.";
      echo"<br>";
      echo"- El cliente se interesa en comprar un producto.";
      echo"<br></br>";

      echo'<form action="diagrama_pan.php" method="post">';
      echo'. Indique si el cliente va a comprar el producto : ';
      echo'<input type="text" name="compra" placeholder=" SI / NO">';
      echo"<br></br>";
      echo'<input type="submit" name="verif3" value="Indicar">';
      echo'</form>';
      exit();
   }

   if(isset($_POST['verif3']))
   {
      $compra=$_POST['compra'];

      if($compra=="no" or $compra=="No" or $compra=="NO")
      {
         echo"- Se ofrecen otras opciones al cliente.";
         echo"<br></br>";

         echo'<form action="diagrama_pan.php" method="post">';
         echo'. Indique si el cliente se intereso en comprar otro producto : ';
         echo'<input type="text" name="compra2" placeholder=" SI / NO">';
         echo'<br></br>';
         echo'<input type="submit" name="verif4" value="Indicar">';
         echo'</form>';
         exit();
      }
      else if($compra=="si" or $compra=="Si" or $compra=="SI")
      {
         salto2:

         echo"- Se realiza la anotación del pedido.";
         echo"<br>";
         echo"- Se cobra el pedido.";
         echo"<br>";
         echo"- Se realiza la entrega del pedido.";
         echo"<br></br>";

         salto3:

         echo"- Finalización del programa.";
         exit();
      }
   }

   if(isset($_POST['verif4']))
   {
      $compra2=$_POST['compra2'];

      if($compra2=="no" or $compra2=="No" or $compra2=="NO")
      {
         goto salto3;
      }
      else if($compra2=="si" or $compra2=="Si" or $compra2=="SI")
      {
         goto salto2;
      }
   }
?>

<!DOCTYPE html>
   <html lang="en">
   
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Producción De Pan</title>
   </head>

   <body>

      <form action="diagrama_pan.php" method="post">

         ¿Cuantos sacos de harina desea solicitar? : 
         <input type="float" name="harina">
         <br></br>
         <input type="submit" name="enviar1" value="Solicitar">

      </form>

   </body>
</html>