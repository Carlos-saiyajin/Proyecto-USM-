<?php session_start(); $conn = mysqli_connect("localhost", "root", "Carlos1010*", "datos_login") or die("Error al conectarse a la base de datos."); 
 $_SESSION['tiempo_creacion'] ??= time(); 


  $tiempo_creacion = $_SESSION['tiempo_creacion']; 
  
  $tiempo_actual = time();
  
  $tiempo_expiracion = 1 * 60; 
   if (($tiempo_actual - $tiempo_creacion) > $tiempo_expiracion) { 
    
    echo "El código de confirmación ha expirado.";
     unset($_SESSION['codigo_confirmacion']);
      unset($_SESSION['tiempo_creacion']); 
    } else 
    { 
  
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") { $codigo_ingresado = $_POST['codigo'];
    
    if (isset($_SESSION['codigo_confirmacion']) && $codigo_ingresado == $_SESSION['codigo_confirmacion']) { echo "Código correcto. Acceso concedido.";
       // Función para escapar cadenas
    function escape_string($conn, $value) { return is_string($value) ? mysqli_real_escape_string($conn, $value) : '';
     } 
     $nombres = mysqli_real_escape_string($conn, $_SESSION['nombres']); 
     $apellidos = mysqli_real_escape_string($conn, $_SESSION['apellidos']); 
     $fecha_nac = mysqli_real_escape_string($conn, $_SESSION['fecha_nac']); 
     $mail = mysqli_real_escape_string($conn, $_SESSION['mail']); 
     $cedula = mysqli_real_escape_string($conn, $_SESSION['cedula']);
    $telefono = mysqli_real_escape_string($conn, $_SESSION['telefono']);
    $usuario = mysqli_real_escape_string($conn, $_SESSION['usuario']);
    $contrasenia = escape_string($conn, $_SESSION['contrasenia']); // Preparar la consulta SQL 
    $sql = "INSERT INTO `registro` (`nombres`, `apellidos`, `fecha_nac`, `mail`, `cedula`, `telefono`, `usuario`, `contrasenia`) VALUES ('$nombres', '$apellidos', '$fecha_nac', '$mail', '$cedula', '$telefono', '$usuario', '$contrasenia')"; // Ejecutar la consulta 
    if (mysqli_query($conn, $sql)) { echo "Registro exitoso!"; header('Location: login.php'); exit; } else { echo "Error: " . mysqli_error($conn); } // Restablecer las variables de sesión después de la validación exitosa 
    unset($_SESSION['codigo_confirmacion']); unset($_SESSION['tiempo_creacion']); } else { echo "Código incorrecto. Intenta de nuevo."; } } else { // echo "Método no permitido."; 
    } $_SESSION['nombres'] = $_SESSION['nombres'] ?? '';
     $_SESSION['apellidos'] = $_SESSION['apellidos'] ?? '';
      $_SESSION['fecha_nac'] = $_SESSION['fecha_nac'] ?? '';
       $_SESSION['mail'] = $_SESSION['mail'] ?? '';
        $_SESSION['cedula'] = $_SESSION['cedula'] ?? '';
         $_SESSION['telefono'] = $_SESSION['telefono'] ?? '';
          $_SESSION['usuario'] = $_SESSION['usuario'] ?? '';
           $_SESSION['contrasenia'] = $_SESSION['contrasenia'] ?? '';
           
           } mysqli_close($conn); ?>

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
      <div class="text-center fs-1 fw-bold"><h2>introduzca el codigo</h2></div>
      <form action="check_code.php" method="post">
      <div class="input-group mt-4">
        
        <input
          class="form-control bg-light"
          type="password"
          placeholder="código"
        />

      </div>
      <div class="input-group mt-1">

      </div>
      <div class="d-flex justify-content-around mt-4">
      </div>
      <div class="btn btn-primary text-white w-100 mt-4 fw-semibold shadow-sm">
        Confirmar código
      </form>
    </div>
      
      <div>
      <form action="reenvio_codigo.php" method="post">
      <div class="mt-4">
                <button type="submit" class="btn btn-primary text-white w-100 fw-semibold shadow-sm">
                    Reenviar código
                </button>
            </div>
      </form>
      </div>


      </div>
  </body>
</html>
