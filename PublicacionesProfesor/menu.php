<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .menu {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .menu a {
            text-decoration: none;
            margin: 10px 0;
        }
        .menu button {
            padding: 15px 25px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .menu button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="menu">
        <a href="menu_index.php"><button>Publicaciones</button></a>
        <a href="calendario.php"><button>Calendario</button></a>
        <a href="close.php"><button>Cerrar Sesión</button></a>
        <a href="comentar_sql.php"><button>Bandeja De Comentarios</button></a>
    </div>
</body>
</html>
