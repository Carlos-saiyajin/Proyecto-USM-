<?php
 session_start();
$conn = mysqli_connect("localhost", "root", "Carlos1010*", "datos_login") or die("Error al conectarse a la base de datos.");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_ingresado = $_POST['codigo'];

    if (isset($_SESSION['codigo_confirmacion']) && $codigo_ingresado == $_SESSION['codigo_confirmacion']) {
        echo "Código correcto. Acceso concedido.";

 $mail = mysqli_real_escape_string($conn, $_SESSION['mail']);

 header('Location: /proyecto_USM/nueva_password.php');

    } else {

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
          <div class="text-center fs-1 fw-bold"><h2>Código incorrecto. Intenta de nuevo.</h2></div>
          
          <form action="confirmacion_recuperacion.php" method="post">
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

          <div>
            <form action="reenvio_codigo_rcp_contr.php" method="post">
              <div class="mt-4">
                <button type="submit" class="btn btn-primary text-white w-100 fw-semibold shadow-sm">
                  Reenviar código
                </button>
              </div>
            </form>
          </div>

  
          </div>
          </body>
        </html>';
    }
} else {

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
    <div class="text-center fs-1 fw-bold"><h2>Método no permitido.</h2></div>
    
    <form action="confirmacion_recuperacion.php" method="post">
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

    <div>
      <form action="reenvio_codigo_rcp_contr.php" method="post">
        <div class="mt-4">
          <button type="submit" class="btn btn-primary text-white w-100 fw-semibold shadow-sm">
            Reenviar código
          </button>
        </div>
      </form>
    </div>


    </div>
    </body>
   </html>';
    
}

$_SESSION['mail'] = $_SESSION['mail'] ?? '';

?>


<!-- 
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
      <form action="confirmacion_recuperacion.php" method="post">
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

      <div>
      <form action="reenvio_codigo_rcp_contr.php" method="post">
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

-->