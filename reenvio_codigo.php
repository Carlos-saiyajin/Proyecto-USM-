<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "datos_login") or die("Error al conectarse a la base de datos.");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tiempo_creacion = time(); 
    $tiempo_expiracion = 1 * 60;
  
    $_SESSION['tiempo_creacion'] = $tiempo_creacion;
    $_SESSION['tiempo_expiracion'] = $tiempo_expiracion;

    $tiempoEspera = 90; // 90 segundos (1.5 minutos)
    if (isset($_SESSION['ultimo_envio'])) {
        $tiempoDesdeUltimoEnvio = time() - $_SESSION['ultimo_envio'];
    
        if ($tiempoDesdeUltimoEnvio < $tiempoEspera) {
            $tiempoRestante = $tiempoEspera - $tiempoDesdeUltimoEnvio;
            echo "Por favor, espera " . ceil($tiempoRestante / 60) . " minutos antes de reenviar el correo.";
            exit();
        }
    }

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
    $codigo_confirmacion = rand(100000, 999999);
   

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = 'proyectophp2024@gmail.com';
        $subject = "Codigo de confirmacion ";
        $body = "Tu codigo de confirmacion es: " . $codigo_confirmacion;

        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'proyectophp2024@gmail.com';
            $mail->Password = 'njyf drau xsvd aslb';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('proyectophp2024@gmail.com', $nombre);
            $mail->addAddress($email);

            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();

            $_SESSION['codigo_confirmacion'] = $codigo_confirmacion;
            $_SESSION['nombres'] = $nombres;
            $_SESSION['apellidos'] = $apellidos;
            $_SESSION['fecha_nac'] = $fecha_nac;
            $_SESSION['mail'] = $email;
            $_SESSION['cedula'] = $cedula;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['usuario'] = $usuario;
            $_SESSION['contrasenia'] = $contrasenia;

         
            $_SESSION['ultimo_envio'] = time();
        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
            $_SESSION['mensaje_correo'] = "El correo no se ha podido enviar correctamente, por favor rellene sus datos de nuevo.";

            header("Location: registrarse.php");
        }
    } else {
        echo "Por favor, introduce una dirección de correo electrónico válida.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="assets/icono_usm.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de código</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('./imagenes/usm_fondo.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }
        .container {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            padding: 30px;
            width: 90%;
            max-width: 400px;
            color: black;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 7rem;
        }
        .header h2 {
            margin: 10px 0;
            color: #007BFF;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            color: #000;
        }
        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="assets/icono_usm.png" alt="login-icon">
            <h2>Introduzca mensaje de confirmación</h2>
        </div>
        <form action="check_code" method="post">
            <div class="form-group">
                <input type="number" name="codigo" placeholder="Código" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary text-white w-100 fw-semibold shadow-sm">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>
