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
         background-color: rgba(255, 255, 255, 0.9);
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

    .button{
        
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

    .button:hover{
        background-color: rgba(0, 68, 148, 0.7);
    }

    .titulo{
       
      color:white;
    }
      
</style>';

  $opcion=$_POST['opcion'];
  $nombreArchivo=$_POST['file'];

  if($opcion=="Cambiar Nombre")
  {
    include("edit_nombre.php");
  }
  else if($opcion=="Agregar Texto")
  {
    include("edit_texto.php");
  }

?>