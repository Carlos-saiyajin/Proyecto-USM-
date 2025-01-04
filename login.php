<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="assets/icono_usm.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
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
            overflow: hidden;
        }
        .container {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            padding: 30px;
            width: 90%;
            max-width: 400px;
            color: white;
            transform: translateY(-100%);
            animation: slideIn 1s forwards, fadeIn 1.5s ease-in-out;
        }
        @keyframes slideIn {
            to {
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
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
    </style>
</head>
<body>

<?php
$conn = mysqli_connect("localhost", "root", "", "datos_login") or die("Error al conectarse a la base de datos.");

session_start();

if (!empty($_POST['mail']) && !empty($_POST['contrasenia'])) {
    $mail = mysqli_real_escape_string($conn,$_POST['mail']);
    $contrasenia = md5(mysqli_real_escape_string($conn,$_POST['contrasenia']));

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT id, mail, contrasenia FROM registro WHERE mail=? and contrasenia=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $mail, $contrasenia);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
 
    if ($reg = mysqli_fetch_assoc($resultado)) {

        $profesor = "SELECT * FROM `profesores` WHERE correo_profe=?";
        $stmt_profesor = mysqli_prepare($conn, $profesor);
        mysqli_stmt_bind_param($stmt_profesor, 's', $mail);
        mysqli_stmt_execute($stmt_profesor);
        $verificacion_profesor = mysqli_stmt_get_result($stmt_profesor);

        $alumno = "SELECT * FROM `alumnos` WHERE correo_alumno=?";
        $stmt_alumno = mysqli_prepare($conn, $alumno);
        mysqli_stmt_bind_param($stmt_alumno, 's', $mail);
        mysqli_stmt_execute($stmt_alumno);
        $verificacion_alumno = mysqli_stmt_get_result($stmt_alumno);

        if (mysqli_num_rows($verificacion_profesor) > 0) {
            $_SESSION['user_id'] = $reg['id'];
            header("Location: PublicacionesProfesor");
            exit();
        }

        if (mysqli_num_rows($verificacion_alumno) > 0) {
            $_SESSION['user_id'] = $reg['id'];
            header("Location: PublicacionesProfesor");
            exit();
        }

        if (mysqli_num_rows($verificacion_profesor) <= 0 && mysqli_num_rows($verificacion_alumno) <= 0) {
            echo 'Usted no está en la base de datos de profesores ni de estudiantes';

            $db_delete = "DELETE * FROM `registro` WHERE mail='$mail' ";
            $query_db = mysqli_query($conn, $db_delete);

            exit();
        }
    } else {
        echo "Credenciales incorrectas";
    }
} else {
    //echo "Error en la consulta: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

    <div class="container">
        <div class="header">
            <img src="assets/icono_usm.png" alt="login-icon">
            <h2>Iniciar sesión</h2>
        </div>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="text" name="mail" placeholder="Correo" required>
            </div>
            <div class="form-group">
                <input type="password" name="contrasenia" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <button type="submit">Iniciar sesión</button>
            </div>
        </form>
        <div class="footer">
            <div>¿Olvidaste tu contraseña?</div>
            <a href="recuperacion_contraseña">Recuperar contraseña</a>
        </div>
        <div class="footer">
            <div>¿No tienes una cuenta?</div>
            <a href="registrarse.php">Registrarse</a>
        </div>
    </div>
</body>
</html>
