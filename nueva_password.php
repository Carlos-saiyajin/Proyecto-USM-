<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "datos_login") or die("Error al conectarse a la base de datos.");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $contrasenia = md5($_POST['contrasenia']);
   $contrasenia_2 = md5($_POST['contrasenia_2']);

   $mail = mysqli_real_escape_string($conn, $_SESSION['mail']);

   $sql = "UPDATE registro SET contrasenia='$contrasenia' WHERE Mail='$mail'";

   if ($contrasenia == $contrasenia_2) {
       if (mysqli_query($conn, $sql)) {
           $_SESSION['mensaje'] = "Registro exitoso!";
           $_SESSION['mensaje_tipo'] = "success";
           header("location: login.php");
           exit();
       } else {
           $_SESSION['mensaje'] = "Error: " . mysqli_error($conn);
           $_SESSION['mensaje_tipo'] = "error";
       }
   } else {
       $_SESSION['mensaje'] = 'Las contraseñas no son iguales';
       $_SESSION['mensaje_tipo'] = "error";
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
    <title>Nueva Contraseña</title>
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
        .message {
            padding: 10px;
            margin: 15px 0;
            border-radius: 5px;
            font-size: 16px;
            color: white;
        }
        .message.success {
            background-color: #28a745; /* Verde para mensajes de éxito */
        }
        .message.error {
            background-color: #dc3545; /* Rojo para mensajes de error */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="assets/icono_usm.png" alt="login-icon">
            <h2>Introduzca nueva contraseña</h2>
        </div>
        <form action="nueva_password.php" method="post">
            <div class="form-group">
                <input type="password" name="contrasenia" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <input type="password" name="contrasenia_2" placeholder="Confirmar contraseña" required>
            </div>
            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
        <?php
        if (isset($_SESSION['mensaje'])) {
            $mensaje_tipo = $_SESSION['mensaje_tipo'] ?? 'error';
            echo "<div class='message $mensaje_tipo'>" . $_SESSION['mensaje'] . "</div>";
            unset($_SESSION['mensaje']);
            unset($_SESSION['mensaje_tipo']);
        }
        ?>
    </div>
</body>
</html>
