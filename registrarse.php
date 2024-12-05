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
      <div class="text-center fs-1 fw-bold">Registrarse</div>
      <form action="codigo_correo.php" method="post">
      <div class="input-group mt-4">
        
        <input
          class="form-control bg-light"
          type="text"
          name="nombres"
          placeholder="Nombres"
        />
      </div>
      <div class="input-group mt-1">
        <input
          class="form-control bg-light"
          type="text"
          name="apellidos"
          placeholder="Apellidos"
          
        />
        </div>
        <div class="input-group mt-1">
          <input
            class="form-control bg-light"
            type="date"
            name="fecha_nac"
            placeholder="Fecha de nacimiento"
            
          />
          </div>
          <div class="input-group mt-1">
            <input
              class="form-control bg-light"
              type="email"
               name="mail"
              placeholder="Correo electrónico"
              
            />
            </div>
            <div class="input-group mt-1">
          <input
            class="form-control bg-light"
            type="number"
             name="cedula"
            placeholder="Cédula"
            
          />
          </div>
          <div class="input-group mt-1">
            <input
              class="form-control bg-light"
              type="number"
               name="telefono"
              placeholder="Teléfono"
              
            />
            </div>
            <div class="input-group mt-1">
              <input
                class="form-control bg-light"
                type="text"
                 name="usuario"
                placeholder="Usuario"
                
              />
              </div>
              <div class="input-group mt-1">
                <input
                  class="form-control bg-light"
                  type="password"
                   name="contrasenia"
                  placeholder="contraseña"
                  
                />

      </div>

      <div class="mt-4">
                <button type="submit" class="btn btn-primary text-white w-100 fw-semibold shadow-sm">
                    registrarse
                </button>
            </div>
      </form>
      </div>
      <div class="d-flex gap-1 justify-content-center mt-1">
        <div>Ya tienes una cuenta?</div>
        <a href="login.php" class="text-decoration-none text-info fw-semibold"
          >Iniciar sesión</a
        >
      </div>
    </div>
  </body>
</html>
