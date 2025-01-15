<?php

session_start();

$_SESSION['user_id'] ??= '';
    
echo "ID: " . $_SESSION['user_id'];

function restrictUser($userId, $restrict) {

    $conn = mysqli_connect("localhost", "root", "", "datos_login") or die("Error al conectarse a la base de datos."); 

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: {$conn->connect_error}");
    }

    //boton cerrar sesion: echo'<span><a href="close.php"> registrarse</a></span>';
    
    if(isset($_SESSION['user_id'])){    

    // Actualizar estado de restricción
    $sql = "UPDATE profe_y_alumno SET restringido = $restrict WHERE id = $userId";
    
    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado correctamente.";
    } else {
        echo "Error actualizando el registro: {$conn->error}";
    }

    $conn->close();
}
}

// Ejemplo de uso
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $userId = intval($_POST["userId"]); 
     $restrict = intval($_POST["restrict"]);
      restrictUser($userId, $restrict); 
    
    header("Location: seleccion");
    exit();
}
