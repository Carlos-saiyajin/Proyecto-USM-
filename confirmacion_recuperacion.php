<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "datos_login") or die("Error al conectarse a la base de datos.");

$_SESSION['tiempo_creacion'] ??= time();
$tiempo_creacion = $_SESSION['tiempo_creacion'];
$tiempo_actual = time();
$tiempo_expiracion = 1 * 60;

if (($tiempo_actual - $tiempo_creacion) > $tiempo_expiracion) {
    $_SESSION['mesage'] = "El código de confirmación ha expirado.";
    unset($_SESSION['codigo_confirmacion']);
    unset($_SESSION['tiempo_creacion']);
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $codigo_ingresado = $_POST['codigo'];

        if (isset($_SESSION['codigo_confirmacion']) && $codigo_ingresado == $_SESSION['codigo_confirmacion']) {
            $_SESSION['mesage'] = "Código correcto. Acceso concedido.";

            $mail = mysqli_real_escape_string($conn, $_SESSION['mail']);

            header('Location: /proyecto_USM/nueva_password.php');
            exit();
        } else {
            $_SESSION['mesage'] = "Código incorrecto. Intenta de nuevo.";
        }
    } else {
        $_SESSION['mesage'] = "Método no permitido.";
    }
}
$_SESSION['mail'] = $_SESSION['mail'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="assets/icono_usm.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introduzca código de confirmación</title>
    
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
          background: rgba(0, 0, 0, 0.7); /* Fondo blanco traslúcido para mejor legibilidad */
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
        .message {
            padding: 10px;
            margin: 15px 0;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            text-align: center;
        }
        .message.success {
            background-color: #28a745; /* Verde para mensajes de éxito */
        }
        .error-message {
            color: #ffeb3b; /* Cambia el color según tu preferencia */
            background-color: rgba(255, 0, 0, 0.5); /* Fondo semitransparente */
            border: 2px solid #ff0000; /* Borde rojo */
            border-radius: 5px; /* Bordes redondeados */
            padding: 10px; /* Espaciado interior */
            margin-bottom: 15px; /* Espaciado inferior */
            text-align: center; /* Centrar el texto */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="assets/icono_usm.png" alt="login-icon">
            <h2>Introduzca código de confirmación</h2>

            <?php
            $mensaje_tipo = 'error-message'; // Define the variable with a default value
            if (isset($_SESSION['mensaje_correo_recuperacion'])) {
                echo "<div class='message $mensaje_tipo'>" . $_SESSION['mensaje_correo_recuperacion'] . "</div>";
                unset($_SESSION['mensaje_correo_recuperacion']);
            }
            if (isset($_SESSION['mesage'])) {
                echo "<div class='message $mensaje_tipo'>" . $_SESSION['mesage'] . "</div>";
                unset($_SESSION['mesage']);
            }
            ?>

        </div>
        <form action="confirmacion_recuperacion.php" method="post">
            <div class="form-group">
                <input type="number" name="codigo" placeholder="Código" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary text-white w-100 fw-semibold shadow-sm">Enviar</button>
            </div>
        </form>
        <form action="reenvio_codigo_rcp_contr.php" method="post">
            <div class="form-group">
                <button type="submit" class="btn btn-primary text-white w-100 fw-semibold shadow-sm">Reenviar código</button>
            </div>
        </form>
    </div>
</body>
</html>
