<?php

session_start();
//boton cerrar sesion: echo'<span><a href="close.php"> registrarse</a></span>';

$_SESSION['user_id'] ??= '';

Echo"ID:".$_SESSION['user_id'] ??= '';

if(isset($_SESSION['user_id'])){
session_destroy();

echo 'SESION FINALIZADA';


}else{
    echo 'no existe sesion';
}


?>