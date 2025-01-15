<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: url('imagenes/pito.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            color: white;
            justify-content: center;
            align-items: center;
        }
        .header {
            background: rgba(0, 123, 255, 0.9);
            padding: 5px 10px; /* Ajuste del padding para hacer la franja más delgada */
            border-radius: 8px;
            width: 100%;
            box-sizing: border-box;
            animation: fadeIn 2s;
            margin-bottom: 20px; /* Margen inferior agregado */
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px; /* Ajuste del margen inferior */
        }
        .header-content img {
            height: 70px;
        }
        .date {
            font-size: 1.5em;
            text-align: center;
            font-weight: bold;
        }
        .welcome-message {
            font-size: 1.8em;
            font-weight: bold;
        }
        .buttons {
            margin-bottom: 20px;
            animation: fadeIn 2s;
        }
        .buttons a {
            background-color: rgba(0, 86, 179, 0.7);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            animation: slideIn 2s;
        }
        .buttons a:hover {
            background-color: rgba(0, 68, 148, 0.7);
        }
        .carousel {
            width: 80%;
            max-width: 800px;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            animation: fadeIn 2s;
        }
        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease;
        }
        .carousel-item {
            min-width: 100%;
            box-sizing: border-box;
            padding: 10px;
            animation: fadeIn 2s;
        }
        .carousel-item img {
            width: 100%;
            height: auto;
            display: block;
            border: 5px solid white; /* Marco alrededor de la imagen */
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.7);
        }
        .carousel-buttons {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .carousel-buttons button {
            background-color: rgba(0, 123, 255, 0.7);
            color: white;
            border: none;
            padding: 10px;
            margin: 0 5px;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
            animation: slideIn 2s;
        }
        .carousel-buttons button:hover {
            background-color: rgba(0, 86, 179, 0.7);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="header-content">
            <img src="./imagenes/Logo_USM_Horizontal.png" alt="Logo">
            <div class="welcome-message">¡Bienvenido a Nuestro Sitio!</div>
            <div class="date" id="date"></div>
        </div>
    </div>

    <div class="buttons">
        <a href="menu_index.php">Publicaciones</a>
        <a href="calendario.php">Calendario</a>
        <a href="comentar_sql.php">Bandeja De Comentarios</a>
        <a href="bandeja_asistencia.php">Bandeja de Asistencia</a>
        <a href="close.php">Cerrar Sesión</a>
    </div>

    <div class="carousel">
        <div class="carousel-inner" id="carousel">
            <div class="carousel-item" >
                <img src="./imagenes/Logo_USM_Horizontal.png" alt="Imagen 1">
            </div>
            <div class="carousel-item">
                <img src="./imagenes/2_Seccion-de-publicaciones-del-profesor.png" alt="Imagen 2">
            </div>
            <div class="carousel-item">
                <img src="./imagenes/3_Calendario-con-fechas-de-evaluaciones.png" alt="Imagen 3">
            </div>
            <div class="carousel-item">
                <img src="./imagenes/4_Bandeja-de-comentarios-de-estudiantes.png" alt="Imagen 4">
            </div>
            <div class="carousel-item">
                <img src="./imagenes/5_Lista-de-asistencia-a-clases.png" alt="Imagen 5">
            </div>
            <div class="carousel-item">
                <img src="./imagenes/6_Organizacion-y-funcionalidad-del-sitio-web.png" alt="Imagen 6">
            </div>
            <div class="carousel-item">
                <img src="./imagenes/7_Beneficios-para-estudiantes-y-profesores.png" alt="Imagen 7">
            </div>
        </div>
    </div>

    <div class="carousel-buttons">
        <button onclick="prevSlide()">‹</button>
        <button onclick="nextSlide()">›</button>
    </div>

    <script>
        let currentIndex = 0;
        const carousel = document.getElementById('carousel');

        function showSlide(index) {
            const totalItems = document.querySelectorAll('.carousel-item').length;
            currentIndex = (index + totalItems) % totalItems;
            const offset = -currentIndex * 100;
            carousel.style.transform = `translateX(${offset}%)`;
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        setInterval(nextSlide, 20000); // Cambia de imagen cada 20 segundos

        // Set the date in the header
        document.getElementById('date').textContent = new Date().toLocaleDateString();
    </script>
</body>
</html>
