<?php
session_start();
$conn = mysqli_connect("localhost", "root", "Carlos1010*", "datos_login") or die("Error al conectarse a la base de datos.");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 

    $tiempoEspera = 90; // 90 segundos (1.5 minutos)
    if (isset($_SESSION['ultimo_envio'])) {
        $tiempoDesdeUltimoEnvio = time() - $_SESSION['ultimo_envio'];
    
        if ($tiempoDesdeUltimoEnvio < $tiempoEspera) {
            // Si no ha pasado el tiempo suficiente, muestra un mensaje
            $tiempoRestante = $tiempoEspera - $tiempoDesdeUltimoEnvio;
            echo "Por favor, espera " . ceil($tiempoRestante / 60) . " minutos antes de reenviar el correo.";
            exit();
        }
    }


     // Datos del formulario
     $nombres = mysqli_real_escape_string($conn, $_SESSION['nombres']);
     $apellidos = mysqli_real_escape_string($conn, $_SESSION['apellidos']);
     $fecha_nac = mysqli_real_escape_string($conn, $_SESSION['fecha_nac']);
     $mail = mysqli_real_escape_string($conn, $_SESSION['mail']);
     $cedula = mysqli_real_escape_string($conn, $_SESSION['cedula']);
     $telefono = mysqli_real_escape_string($conn, $_SESSION['telefono']);
     $usuario = mysqli_real_escape_string($conn, $_SESSION['usuario']);
     $contrasenia = mysqli_escape_string($conn, $_SESSION['contrasenia']);
 
     $nombre = 'Codigo de confirmacion';
     $email = htmlspecialchars(trim($mail));
     $codigo_confirmacion = rand(100000, 999999); // Genera un código de 6 dígitos
     
   
   //validaciones datos repetidos

$consulta_mail= "SELECT * FROM `registro` WHERE mail='$mail' ";
$verificacion_mail=mysqli_query($conn, $consulta_mail);

if(mysqli_num_rows($verificacion_mail)> 0){

    echo'Este correo ya está registrado intente con otro correo';
    echo'<span><a href="registrarse.php"> registrarse</a></span>';
   
exit();
}
$consulta_cedula= "SELECT * FROM `registro` WHERE cedula='$cedula' ";
$verificacion_cedula=mysqli_query($conn, $consulta_cedula);

if(mysqli_num_rows($verificacion_cedula)> 0){
    echo'Esta cedula ya está registrada intente con otra cedula';
    echo'<span><a href="registrarse.php"> registrarse</a></span>';
   
    exit();
}
$consulta_telefono= "SELECT * FROM `registro` WHERE telefono='$telefono'";
$verificacion_telefono=mysqli_query($conn, $consulta_telefono);

if(mysqli_num_rows($verificacion_telefono)> 0){
    echo'Este telefono ya está registrado intente con otro';
    echo'<span>or <a href="registrarse.php"> registrarse</a></span>';
   
    exit();
}
$consulta_usuario= "SELECT * FROM `registro` WHERE usuario='$usuario'";
$verificacion_usuario=mysqli_query($conn, $consulta_usuario);
if(mysqli_num_rows($verificacion_usuario)> 0){
    echo'Este usuario ya está registrado intente con otro';
    echo'<span>or <a href="registrarse.php"> registrarse</a></span>';
   

    exit();
}

   

    // Verificacion correo electrónico y mensaje
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = 'proyectophp2024@gmail.com'; 
        $subject = "Codigo de confirmacion ";
        $body = "Tu codigo de confirmacion es: " . $codigo_confirmacion;

        $mail = new PHPMailer(true);
        
        try {
            //Servidor SMTP
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            //$mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'proyectophp2024@gmail.com'; 
            $mail->Password = 'njyf drau xsvd aslb'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587; 

            // Destinatarios
            $mail->setFrom('proyectophp2024@gmail.com', $nombre); // Cambiado
            $mail->addAddress($email); // Agregar destinatario

            // Contenido del correo
            $mail->isHTML(false); // enviar en HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Envio el correo
            $mail->send();

            
            $_SESSION['codigo_confirmacion'] = $codigo_confirmacion;
            $_SESSION['nombres']= $nombres;
            $_SESSION['apellidos']= $apellidos;
            $_SESSION['fecha_nac']= $fecha_nac;
            $_SESSION['mail']= $email;
            $_SESSION['cedula']= $cedula;
            $_SESSION['telefono']= $telefono;
            $_SESSION['usuario']= $usuario;
            $_SESSION['contrasenia']= $contrasenia;



            echo "Mensaje enviado con éxito.";
            $_SESSION['ultimo_envio'] = time();
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
        }
    } else {
        echo "Por favor, introduce una dirección de correo electrónico válida.";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/x-icon" href="assets/icono_usm.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrap Login Page</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
  </head>
    <body class="bg-primary d-flex justify-content-center align-items-center vh-100">
    <div
      class="bg-white p-5 rounded-5 text-secondary shadow"
      style="width: 25rem"
    >
      <div class="d-flex justify-content-center">
        <img
          src="assets/icono_usm.png"
          alt="login-icon"
          style="height: 7rem"
        />
      </div>
      <div class="text-center fs-1 fw-bold"><h2>Mensaje enviado con éxito</h2></div>
      <form action="check_code.php" method="post">
      <div class="input-group mt-4">
        
        <input
          class="form-control bg-light"
          type="number"
          name="codigo"
          placeholder="codigo"
        />

      </div>
      <div class="d-flex justify-content-around mt-1">
      </div>
      <div class="mt-4">
                <button type="submit" class="btn btn-primary text-white w-100 fw-semibold shadow-sm">
                    enviar
                </button>
            </div>
      </form>

  
      </div>
  </body>
</html>
