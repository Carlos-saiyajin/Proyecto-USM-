<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restringir Usuarios</title>
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
        .user-list {
            margin-top: 20px;
        }
        .user-card {
            background: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            color: #333;
        }
        .user-card p {
            margin: 0 0 10px;
        }
        .user-card span {
            font-weight: bold;
        }
        .user-card span.status {
            display: inline-block;
            margin-left: 10px;
            padding: 2px 5px;
            border-radius: 3px;
        }
        .user-card span.status.restringido {
            background-color: red;
            color: white;
        }
        .user-card span.status.activo {
            background-color: green;
            color: white;
        }
        .user-card form {
            display: flex;
            gap: 10px;
        }
        .user-card form button {
            flex: 1;
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .user-card form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Restringir Usuarios</h2>
            <div class="header-buttons">
                <a href="menu.php">Menú</a>
                <a href="comentar_sql.php">Bandeja de Comentarios</a>
            </div>
        </div>

        <div class="user-list">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "datos_login") or die("Error al conectarse a la base de datos.");

            $result = mysqli_query($conn, "SELECT * FROM alumnos");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='user-card'>";
                    echo "<p><span>Usuario:</span> " . htmlspecialchars($row["nombres"]) . " (" . htmlspecialchars($row["id"]) . ") - ";
                    switch ($row["restringido"]) {
                        case 1:
                            echo "<span class='status restringido'>Restringido</span>";
                            break;
                        default:
                            echo "<span class='status activo'>Activo</span>";
                            break;
                    }
                    echo "</p>";
                    echo "<form action='restringir.php' method='post'>";
                    echo "<input type='hidden' name='userId' value='" . htmlspecialchars($row["id"]) . "'>";
                    echo "<button type='submit' name='restrict' value='1'>Restringir</button>";
                    echo "<button type='submit' name='restrict' value='0'>Quitar Restricción</button>";
                    echo "</form>";
                    echo "</div>";
                }
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>

</body>
</html>
