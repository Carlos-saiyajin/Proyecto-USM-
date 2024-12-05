<?php

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