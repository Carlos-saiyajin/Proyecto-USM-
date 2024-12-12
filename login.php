<?php
$conn = mysqli_connect("localhost", "root", "Carlos1010*", "datos_login") or die("Error al conectarse a la base de datos.");

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
            header("Location: PublicacionesProfesor/menu.php");
            exit();
        }

        if (mysqli_num_rows($verificacion_alumno) > 0) {
            $_SESSION['user_id'] = $reg['id'];
            header("Location: PublicacionesProfesor/menu.php");
            exit();
        }

            if(mysqli_num_rows($verificacion_profesor)<= 0 && mysqli_num_rows($verificacion_alumno)<=0){
                
                echo'Usted no está en la base de datos de profesores ni de estudiantes';

            $db_delete= "DELETE * FROM `registro` WHERE mail='$mail' ";
            $query_db=mysqli_query($conn, $db_delete);

                    exit();
                }
        } else {
            //echo "Credenciales incorrectas";

            echo'<!DOCTYPE html>
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
    <div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 25rem">
        <div class="d-flex justify-content-center">
            <img src="assets/icono_usm.png" alt="login-icon" style="height: 7rem" />
        </div>
        <div class="text-center fs-1 fw-bold">Inicio De Sesión</div>
        <form action="login.php" method="post">
            <div class="input-group mt-4">
                <input
                    class="form-control bg-light"
                    type="text"
                    name="mail"
                    placeholder="correo"
                    aria-label="Usuario"
                />
            </div>
            <div class="input-group mt-1">
                <input
                    class="form-control bg-light"
                    type="password"
                    name="contrasenia"
                    placeholder="Contraseña"
                    aria-label="Contraseña"
                />
            </div>
            <br>
            <div class="text-center fs-1 fw-blood"><h6>! Credenciales Incorrectas !</h6></div>
            <div class="d-flex justify-content-around mt-1">
                <div class="pt-1">
                    <a
                        href="recuperacion_contraseña"
                        class="text-decoration-none text-info fw-semibold fst-italic"
                        style="font-size: 0.9rem"
                    >Olvidaste tu contraseña?</a>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary text-white w-100 fw-semibold shadow-sm">
                    Iniciar sesión
                </button>
            </div>
        </form>
        <div class="d-flex gap-1 justify-content-center mt-1">
            <div>No tienes una cuenta?</div>
            <a href="registrarse.php" class="text-decoration-none text-info fw-semibold">Registrarse</a>
        </div>
    </div>
</body>
</html>';

goto salto;
            
        }
    } else {
        //echo "Error en la consulta: " . mysqli_error($conn);
    }

mysqli_close($conn);
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
    <div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 25rem">
        <div class="d-flex justify-content-center">
            <img src="assets/icono_usm.png" alt="login-icon" style="height: 7rem" />
        </div>
        <div class="text-center fs-1 fw-bold">Inicio De Sesión</div>
        <form action="login.php" method="post">
            <div class="input-group mt-4">
                <input
                    class="form-control bg-light"
                    type="text"
                    name="mail"
                    placeholder="correo"
                    aria-label="Usuario"
                />
            </div>
            <div class="input-group mt-1">
                <input
                    class="form-control bg-light"
                    type="password"
                    name="contrasenia"
                    placeholder="Contraseña"
                    aria-label="Contraseña"
                />
            </div>
            <div class="d-flex justify-content-around mt-1">
                <div class="pt-1">
                    <a
                        href="recuperacion_contraseña"
                        class="text-decoration-none text-info fw-semibold fst-italic"
                        style="font-size: 0.9rem"
                    >Olvidaste tu contraseña?</a>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary text-white w-100 fw-semibold shadow-sm">
                    Iniciar sesión
                </button>
            </div>
        </form>
        <div class="d-flex gap-1 justify-content-center mt-1">
            <div>No tienes una cuenta?</div>
            <a href="registrarse.php" class="text-decoration-none text-info fw-semibold">Registrarse</a>
        </div>
    </div>
</body>
</html>

<?php
salto:
?>
