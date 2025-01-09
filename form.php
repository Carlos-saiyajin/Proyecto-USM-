<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bandeja de Comentarios</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('./imagenes/usm_fondo.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            color: white;
        }
        .container {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background: rgba(0, 0, 0, 0.5); /* Fondo semitransparente para mejor legibilidad */
            border-radius: 8px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: rgba(0, 123, 255, 0.7);
            color: white;
            border-radius: 8px;
        }
        .header h2 {
            margin: 0;
        }
        .header-buttons {
            display: flex;
            gap: 10px;
        }
        .header-buttons a,
        .header-buttons form button {
            background-color: rgba(0, 86, 179, 0.7);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .header-buttons a:hover,
        .header-buttons form button:hover {
            background-color: rgba(0, 68, 148, 0.7);
        }
        .comment-container {
            margin: 20px 0;
        }
        #comment-form-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px 20px;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px 8px 0 0;
        }
        #comment-form {
            display: flex;
            flex-direction: column;
        }
        #comment-form textarea,
        #comment-form input[type="submit"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }
        #comment-form input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        #comment-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        #comments {
            margin-top: 20px;
            margin-bottom: 140px; /* Agregado margen inferior */
        }
        #comments div {
            background: rgba(249, 249, 249, 0.9);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }
        #comments .comment-name {
            font-weight: bold;
            color: #007BFF;
        }
        #comments .comment-date {
            color: #888;
            font-size: 12px;
        }
        #comments .comment-text {
            color: #333;
            margin-top: 10px;
        }
        .alert {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f44336; /* Red */
            color: white;
            padding: 20px;
            border-radius: 5px;
            z-index: 1000;
            text-align: center;
        }
        .alert h2 {
            margin-top: 0;
        }
        .alert p {
            margin: 0;
        }
        .alert a {
            display: inline-block;
            margin-top: 10px;
            background-color: white;
            color: #f44336;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .alert a:hover {
            background-color: #ffebee;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Comentarios</h2>
        <div class="header-buttons">
            <a href="menu.php">Menú</a>
            <form action="seleccion.php" method="post" style="display:inline-block;">
                <button type="submit" name="restrict" value="1">Restringir Usuario</button>
            </form>
        </div>
    </div>

    <div class="container">

        <?php 

        // Asegurarse de que user_id está configurado
        $_SESSION['user_id'] ??= '';
        echo "ID de usuario asignado: " . $_SESSION['user_id'];

        //conexion base de datos login
        $conexion_login = mysqli_connect("localhost", "root", "", "datos_login") or die("Error al conectarse a la base de datos."); 

        $id = $_SESSION['user_id'];
        $result = mysqli_query($conexion_login, "SELECT * FROM alumnos WHERE id='$id'");
        $datos = mysqli_fetch_array($result); // Usar mysqli_fetch_array para obtener los datos como un array asociativo

        // Mostrar comentarios de otras personas
        echo "<div id='comments' class='comment-container'>";
        $conn = mysqli_connect("localhost", "root", "", "bandeja_comentarios") or die("Error al conectarse a la base de datos.");
        $resultado = mysqli_query($conn, 'SELECT * FROM comentarios ORDER BY fecha DESC');

        while ($reg = mysqli_fetch_array($resultado)) {   
            echo "<div>";
            echo "<p class='comment-name'>" . htmlspecialchars($reg['nombre']) . "</p>";
            echo "<p class='comment-date'><em>" . htmlspecialchars($reg['fecha']) . "</em></p>";
            echo "<p class='comment-text'>" . htmlspecialchars($reg['comentario']) . "</p>";
            echo "</div>";
        }

        mysqli_close($conn);
        echo "</div>";

        // Mensaje de restricción
        if ($datos['restringido'] == 1) {
            echo '<div class="alert">';
            echo '<h2>Acceso Restringido</h2>';
            echo '<p>Usted ha sido restringido para que no pueda hacer comentarios.</p>';
            echo '<a href="menu.php">Menú</a>';
            echo '</div>';
        } else {
            echo "<div id='comment-form-container'>";
            echo "<form id='comment-form' action='comentar_sql.php' method='post'>";
            echo "<textarea name='coment' placeholder='Escribe tu comentario aquí...' required></textarea>";
            echo "<input type='submit' value='Publicar'>";
            echo "</form>";
            echo "</div>";
        }

        ?>

    </div>
    
</body>
</html>
