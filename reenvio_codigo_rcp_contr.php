<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "datos_login") or die("Error al conectarse a la base de datos.");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $tiempo_creacion = time();
    // Hora actual en segundos desde el Epoch
    // Tiempo de expiración en segundos (por ejemplo, 5 minutos)
    $tiempo_expiracion = 1 * 60;
    
    $_SESSION['tiempo_creacion'] = $tiempo_creacion;
    $_SESSION['tiempo_expiracion'] = $tiempo_expiracion;

    // Datos del formulario
    $nombre = 'Codigo de confirmacion';
    $email = htmlspecialchars(trim($_SESSION['mail']));
    $codigo_confirmacion = rand(100000, 999999); // Genera un código de 6 dígitos
    $tiempo_creacion_reenvio = time();
    
    $_SESSION['codigo_confirmacion'] = $codigo_confirmacion;
    $_SESSION['tiempo_creacion'] = $tiempo_creacion_reenvio;
    $_SESSION['tiempo_expiracion'] = $tiempo_expiracion;

    // Verificación correo electrónico y mensaje
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = 'proyectophp2024@gmail.com';
        $subject = "Codigo de confirmacion ";
        $body = "Tu codigo de confirmacion es: " . $codigo_confirmacion;

        $mail = new PHPMailer(true);
        
        try {
            // Servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'proyectophp2024@gmail.com';
            $mail->Password = 'njyf drau xsvd aslb';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Destinatarios
            $mail->setFrom('proyectophp2024@gmail.com', $nombre);
            $mail->addAddress($email); // Agregar destinatario

            // Contenido del correo
            $mail->isHTML(false); // enviar en HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Envío el correo
            $mail->send();
            
            $_SESSION['codigo_confirmacion'] = $codigo_confirmacion;

        } catch (Exception $e) {
            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
            $_SESSION['mensaje_correo_recuperacion'] = "El correo no se ha podido enviar correctamente.";
            header("Location: recuperacion_contraseña.php");
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
            background: rgba(255, 255, 255, 0.8); /* Fondo blanco traslúcido para mejor legibilidad */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            padding: 30px;
            width: 90%;
            max-width: 400px;
            color: black; /* Ajuste del color del texto */
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
        <form action="confirmacion_recuperacion.php" method="post">
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
