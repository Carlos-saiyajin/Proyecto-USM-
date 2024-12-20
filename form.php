<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bandeja de Comentarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        #comments {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #comments div {
            margin-bottom: 10px;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        #comment-form {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #comment-form input[type="text"], 
        #comment-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #comment-form input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        #comment-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

            <?php 
        
            // Asegurarse de que user_id está configurado
            $_SESSION['user_id'] ??= '';
            echo "ID de usuario asignado: " . $_SESSION['user_id'];

        //conexion base de datos login


        $conexion_login = mysqli_connect("localhost", "root", "", "datos_login") or die("Error al conectarse a la base de datos."); 

        $id = $_SESSION['user_id']; // Define the $id variable
        $result = mysqli_query($conexion_login, "SELECT * FROM registro WHERE id='$id'");
        $datos = mysqli_fetch_array($result); 
        echo $datos['restringido'];

        if($datos['restringido']== 0){

            echo "
    <div class=\"container\">
    <a href=\"menu.php\"><button>Menú</button></a>
        <h2>Deja tu comentario</h2>
        <div id=\"comment-form\">
            <form action=\"comentar_sql.php\" method=\"post\">
                <input type=\"text\" name=\"coment\" placeholder=\"Comentario\" required>
                <input type=\"submit\" value=\"Publicar\">
            </form>

            <h2>Restringir Usuarios</h2> <form action=\"seleccion.php\" method=\"post\">
             <button type=\"submit\" name=\"restrict\" value=\"1\">Restringir Usuario 1</button> 
            </form>
        </div>
        <div id=\"comments\">";



        }else{
echo '<div class="container">';
echo '<h2>Acceso Restringido</h2>';
echo '<div id="restricted-message">';
echo '<p>Usted ha sido restringido para que no pueda hacer comentarios.</p>';
echo '<a href="menu.php"><button>Menú</button></a>';
echo '</div>';
echo '</div>';


        }

        //conexion base de datos bandeja de comentarios
            $conn = mysqli_connect("localhost", "root", "", "bandeja_comentarios") or die("Error al conectarse a la base de datos.");
            $resultado = mysqli_query($conn, 'SELECT * FROM comentarios ORDER BY fecha DESC');

            while ($reg = mysqli_fetch_array($resultado)) {   
                echo "<div>";
                echo "<strong>" . htmlspecialchars($reg['nombre']) . ":</strong> <em>" . htmlspecialchars($reg['fecha']) . "</em><br>";
                echo htmlspecialchars($reg['comentario']) . "<br>";
                echo "</div>";
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
