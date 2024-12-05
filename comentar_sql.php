<?php
session_start();

// Asegurarse de que user_id está configurado
$_SESSION['user_id'] = $_SESSION['user_id'] ?? '';

// Obtener el id del usuario de la sesión
echo "ID de usuario asignado: " . $_SESSION['user_id'];

echo $id."wfbewfb";

// Comprobar si el comentario está definido en POST
if (isset($_POST['coment'])) {
    $comentario = $_POST['coment'];

    // Conectar a la base de datos de datos_login
    $conexion = mysqli_connect("localhost", "root", "Carlos1010*", "datos_login") or die("Error al conectarse a la base de datos.");

    // Obtener nombres y apellidos del usuario
    $reg = mysqli_query($conexion, "SELECT nombres, apellidos FROM registro WHERE id='$id'");
    $datos = mysqli_fetch_assoc($reg);  // Usar mysqli_fetch_assoc para obtener los datos como un array asociativo

    // Verificar que $datos no sea nulo antes de intentar acceder a sus elementos
    if ($datos) {
        $nombres = $datos['nombres'];
        $apellidos = $datos['apellidos'];
    } else {
        $nombres = '';
        $apellidos = '';
    }

    mysqli_close($conexion);  // Cerrar la primera conexión de base de datos

    // Conectar a la base de datos de bandeja_comentarios
    $conn = mysqli_connect("localhost", "root", "", "bandeja_comentarios") or die("Error al conectarse a la base de datos.");

    // Escapar caracteres especiales para evitar inyecciones SQL
    $nombre = mysqli_real_escape_string($conn, $nombres . ' ' . $apellidos);  // Concatenar nombres y apellidos
    $comentario = mysqli_real_escape_string($conn, $comentario);

    // Insertar el comentario en la base de datos
    $resultado = mysqli_query($conn, "INSERT INTO comentarios (nombre, comentario) VALUES ('$nombre', '$comentario')");

    mysqli_close($conn);  // Cerrar la segunda conexión de base de datos
}

// Redirigir de vuelta al formulario después de procesar el comentario
// Incluir el formulario u otro archivo necesario

include('form.php');
exit;
?>
