<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="assets/icono_usm.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirme correo de recuperación</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="assets/icono_usm.png" alt="login-icon">
            <h2>Confirme correo de recuperación</h2>
            <?php
            session_start();
            if (isset($_SESSION['mensaje'])) {
                echo "<p>" . $_SESSION['mensaje'] . "</p>";
                unset($_SESSION['mensaje']);
            }
            ?>
        </div>
        <form action="correo_recuperacion.php" method="post">
            <div class="form-group">
                <input type="email" name="mail" placeholder="Correo" required>
            </div>
            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>
