<!DOCTYPE html>
  <html lang="en">
    
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones</title>
  </head>
    
  <body>
    
    <h1>Publicaciones Profesor :</h1>
    <hr></hr>
    
    <br>
    <a href="publicaciones"><button>Publicaciones subidas</button></a>
    <br></br>

    <form action="verificacion.php" method="post">
        
      <label for="op">opciones:</label>
      <select name="opcion" id="op">
        
        <option value="upload">Subir Archivo</option>
        <option value="edit">Editar Archivo</option>
        <option value="delete">Eliminar Archivo</option>
        
        
      </select>
      <input type="submit" value="aceptar">
      
    </form>
    
    <br>
    <a href="menu.php"><button>Regresar al menú</button></a> <!-- Botón que redirecciona al menú principal. -->
  
  </body>
</html>