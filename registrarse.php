<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="assets/icono_usm.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('./imagenes/usm_fondo.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Alinea el formulario desde la parte superior */
            height: 100vh;
            color: white;
        }
        .container {
            margin-top: 50px; /* Añadir margen superior al formulario */
            background: rgba(0, 0, 0, 0.7); /* Fondo semitransparente para mejor legibilidad */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            padding: 30px;
            width: 90%;
            max-width: 500px;
            color: white;
            transform: translateY(-100%);
            animation: slideIn 1s forwards;
        }
        @keyframes slideIn {
            to {
                transform: translateY(0);
            }
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
            color: #ffeb3b;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
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
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer a {
            color: #ffeb3b;
            text-decoration: none;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        .footer a:hover {
            text-decoration: underline;
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
            <h2>Registrarse</h2>
            <?php
            session_start();
            if (isset($_SESSION['mensaje_correo'])) {
                echo "<div class='error-message'>" . $_SESSION['mensaje_correo'] . "</div>";
                unset($_SESSION['mensaje_correo']);
            }
            ?>
        </div>
        <form action="codigo_correo.php" method="post">
            <div class="form-group">
                <input type="text" name="nombres" placeholder="Nombres" required>
            </div>
            <div class="form-group">
                <input type="text" name="apellidos" placeholder="Apellidos" required>
            </div>
            <div class="form-group">
                <input type="date" name="fecha_nac" placeholder="Fecha de nacimiento" required>
            </div>
            <div class="form-group">
                <input type="email" name="mail" placeholder="Correo electrónico" required>
            </div>
            <div class="form-group">
                <input type="number" name="cedula" placeholder="Cédula" required>
            </div>
            <div class="form-group">
                <input type="number" name="telefono" placeholder="Teléfono" required>
            </div>
            <div class="form-group">
                <input type="text" name="usuario" placeholder="Usuario" required>
            </div>
            <div class="form-group">
                <input type="password" name="contrasenia" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <button type="submit">Registrarse</button>
            </div>
        </form>
        <div class="footer">
            <div>¿Ya tienes una cuenta?</div>
            <a href="login.php">Iniciar sesión</a>
        </div>
    </div>
</body>
</html>
