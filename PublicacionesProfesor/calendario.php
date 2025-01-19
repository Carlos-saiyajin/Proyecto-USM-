<?php
session_start();
function crear_calendario_estudiante ($mes, $año) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "calendario_db";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $diasDeSemana = array('Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom');
    date_default_timezone_set('America/Caracas');
    if (isset($_GET["mes1"])) {
        if (!empty($_GET["mes1"])) {
            list($año, $mes) = explode('-', $_GET["mes1"]);
            if ($mes[0] == "0") {
                $mes = $mes[1];
            }
        }
    }
    
    $primerDia = mktime(0, 0, 0, $mes, 1, $año);
    $numeroDias = date('t', $primerDia);
    $infoFecha = getdate($primerDia);
    $nombreMes = date('F', $primerDia);
    $nombreMeses = [
        "1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4" => "Abril",
        "5" => "Mayo", "6" => "Junio", "7" => "Julio", "8" => "Agosto",
        "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre"
    ];
    $nombreMes = $nombreMeses[$mes];

    $diaSemana = ($infoFecha['wday'] + 6) % 7; 
    $diaHoy = date('d');
    $mesHoy = date('m');
    $añoHoy = date('Y');
    $coloresMes = [
        1 => 'lightblue',
        2 => 'lavender',
        3 => 'plum',
        4 => 'lightyellow',
        5 => 'salmon',
        6 => 'lightskyblue',
        7 => 'lightpink',
        8 => 'lightcyan',
        9 => 'lightsteelblue',
        10 => 'khaki',
        11 => 'lightsalmon',
        12 => 'lightgray'
    ];
    
    $calendario = "<div class='outer' style='text-align: center;'><form method='GET'><table border='1' style='margin: 0 auto;'>";
    $calendario .= "<br><br><input type='month' name='mes1' value='$año-" . str_pad($mes, 2, "0", STR_PAD_LEFT) . "' class='select' style='font-size: 20px; width: 270px; padding: 5px; border: 1px solid #ccc; border-radius: 5px;' onchange='this.form.submit()'>";
    $calendario .= "<br></form>";
    $calendario .= "<form method='GET' style='display:inline;'><input type='hidden' name='mes1' value='" . ($año . '-' . str_pad(($mes == 1 ? 12 : $mes - 1), 2, "0", STR_PAD_LEFT)) . "'><button type='submit'>Anterior mes</button></form>";
    $calendario .= "<form action='/Proyecto_USM/parte_alumnos/menu.php' method='GET' style='display:inline;'><button type='submit'>Regresar al menú</button></form>";
    $calendario .= "<form method='GET' style='display:inline;'><input type='hidden' name='mes' value='" . ($mes == 12 ? 1 : $mes + 1) . "'><input type='hidden' name='año' value='" . ($mes == 12 ? $año + 1 : $año) . "'><button type='submit'>Siguiente mes</button></form></center><br>";
    $calendario .= "<tr style='background-color: deepskyblue; color: black;'>";
    
    //Estilos
    $calendario .= "<style>
        body {
            background-image: url('/Proyecto_USM/assets/Calendario/$mes.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
        .encabezado {
            background: $coloresMes[$mes];
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
            color: black;
            font-size:30px;
            font-weight: bold;
        }
        .header-content img {
            height: 70px;
        }
        .date {
            font-size: 0.88em;
            text-align: center;
            font-weight: bold;  
        }
        .select {
            position: absolute;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
            top: 135px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255, 255, 255, 0.2);
            padding: 5px;
            border-radius: 5px;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 10px;

        }
        div.outer {
            margin: 0 auto;
            width: 850px;
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            table-layout: fixed;
            border-collapse: collapse;
            width: 100%;
        }
        td {
            width: 100px;
            height: 100px;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
            border: 1px solid #ddd;
        }
        tr {
            background-color: rgba(255, 255, 255, 0.1);
            font-weight: bold;
        }
        div.asignacion {
            border-radius: 15px;
            margin: 0 auto;
            width: 300px;
            height: 250px;
            background-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cerrar {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 16px;
            cursor: pointer;
        }
        .guardar:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            background-color: darkgreen;
            transform: scale(1.05);
        }
        button.asignar {
            width: 100px;
            background-color: $coloresMes[$mes];
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        button {
            border-radius: 4px;
            background-color:$coloresMes[$mes];
            cursor:pointer;
            padding: 5px 10px;
            transition: background-color 0.3s;
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }
        button:hover {
            background-color: rgba(0, 0, 0, 0.2);
            color: white;
            transform: scale(1.01);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        th.header {
            background-color: $coloresMes[$mes];
            color: black;
            padding: 10px;
        }
        .current-day {
            background-color: rgba(255, 223, 186, 0.7);
            border: 2px solid #FFA500;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: #333;
        }
    </style>";

    foreach ($diasDeSemana as $dia) {
        $calendario .= "<th class='header'>$dia</th>";
    }
    $calendario .= "<br></tr><tr>"; 
    if ($diaSemana > 0) { 
        for ($i = 0; $i < $diaSemana; $i++) {
            $calendario .= "<td></td>";
        }
    }

    $diaActual = 1;
    $mes = str_pad($mes, 2, "0", STR_PAD_LEFT);

    while ($diaActual <= $numeroDias) {
        if ($diaSemana == 7) { 
            $diaSemana = 0; 
            $calendario .= "</tr><tr>";
        }

        $diaActualRel = str_pad($diaActual, 2, "0", STR_PAD_LEFT);
        $fecha = "$año-$mes-$diaActual";
        $class = ($diaActual == $diaHoy && $mes == $mesHoy && $año == $añoHoy) ? 'current-day' : '';
        $calendario .= "<td class='$class'><h4>$diaActual</h4>";

        $sql = "SELECT actividad FROM actividades WHERE fecha='$fecha'";
        $result = $conn->query($sql);
        if ($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $calendario .= $row['actividad'];
            }
        }
        $diaActual++;
        $diaSemana++;
    }

    if($diaSemana != 7) {
        $diasRestantes = 7 - $diaSemana;
        for ($i = 0; $diasRestantes > $i; $i++) {
            $calendario .= "<td></td>";
        }
    }

    $calendario .= "</tr>";
    $calendario .= "</table><br><br><br></form></div>";
    echo $calendario;
}
function crear_calendario_profesor ($mes, $año) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "calendario_db";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $diasDeSemana = array('Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom');
    date_default_timezone_set('America/Caracas');
    if (isset($_GET["mes1"])) {
        if (!empty($_GET["mes1"])) {
            list($año, $mes) = explode('-', $_GET["mes1"]);
            if ($mes[0] == "0") {
                $mes = $mes[1];
            }
        }
    }
    
    $primerDia = mktime(0, 0, 0, $mes, 1, $año);
    $numeroDias = date('t', $primerDia);
    $infoFecha = getdate($primerDia);
    $nombreMes = date('F', $primerDia);
    $nombreMeses = [
        "1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4" => "Abril",
        "5" => "Mayo", "6" => "Junio", "7" => "Julio", "8" => "Agosto",
        "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre"
    ];
    $nombreMes = $nombreMeses[$mes];

    $diaSemana = ($infoFecha['wday'] + 6) % 7; 
    $diaHoy = date('d');
    $mesHoy = date('m');
    $añoHoy = date('Y');
    $coloresMes = [
        1 => 'lightblue',
        2 => 'lavender',
        3 => 'plum',
        4 => 'lightyellow',
        5 => 'salmon',
        6 => 'lightskyblue',
        7 => 'lightpink',
        8 => 'lightcyan',
        9 => 'lightsteelblue',
        10 => 'khaki',
        11 => 'lightsalmon',
        12 => 'lightgray'
    ];
    
    $calendario = "<div class='outer' style='text-align: center;'><form method='GET'><table border='1' style='margin: 0 auto;'>";
    $calendario .= "<br><br><input type='month' name='mes1' value='$año-" . str_pad($mes, 2, "0", STR_PAD_LEFT) . "' class='select' style='font-size: 20px; width: 270px; padding: 5px; border: 1px solid #ccc; border-radius: 5px;' onchange='this.form.submit()'>";
    $calendario .= "<br></form>";
    $calendario .= "<form method='GET' style='display:inline;'><input type='hidden' name='mes1' value='" . ($año . '-' . str_pad(($mes == 1 ? 12 : $mes - 1), 2, "0", STR_PAD_LEFT)) . "'><button type='submit'>Anterior mes</button></form>";
    $calendario .= "<form action='/Proyecto_USM/PublicacionesProfesor/menu.php' method='GET' style='display:inline;'><button type='submit'>Regresar al menú</button></form>";
    $calendario .= "<form method='GET' style='display:inline;'><input type='hidden' name='mes' value='" . ($mes == 12 ? 1 : $mes + 1) . "'><input type='hidden' name='año' value='" . ($mes == 12 ? $año + 1 : $año) . "'><button type='submit'>Siguiente mes</button></form></center><br>";
    $calendario .= "<tr style='background-color: deepskyblue; color: black;'>";
    
    //Estilos
    $calendario .= "<style>
        body {
            background-image: url('/Proyecto_USM/assets/Calendario/$mes.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
        }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
        .encabezado {
            background: $coloresMes[$mes];
            padding: 5px 10px; /* Ajuste del padding para hacer la franja más delgada */
            border-radius: 8px;
            width: 100%;
            top: 0;
            right: 0px;
            box-sizing: border-box;
            animation: fadeIn 2s;
            margin-bottom: 20px;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: black;
            font-size:30px;
            font-weight: bold;
        }
        .header-content img {
            height: 70px;
        }
        .date {
            font-size: 0.88em;
            text-align: center;
            font-weight: bold;  
        }
        .select {
            position: absolute;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
            top: 135px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255, 255, 255, 0.2);
            padding: 5px;
            border-radius: 5px;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 10px;

        }
        div.outer {
            margin: 0 auto;
            width: 850px;
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            table-layout: fixed;
            border-collapse: collapse;
            width: 100%;
        }
        td {
            width: 100px;
            height: 100px;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
            border: 1px solid #ddd;
        }
        tr {
            background-color: rgba(255, 255, 255, 0.1);
            font-weight: bold;
        }
        div.asignacion {
            border-radius: 15px;
            margin: 0 auto;
            width: 300px;
            height: 250px;
            background-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 2s ease-in-out;
        }
        .cerrar {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 16px;
            cursor: pointer;
        }
        .guardar:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            background-color: darkgreen;
            transform: scale(1.05);
        }
        button.asignar {
            width: 100px;
            background-color: $coloresMes[$mes];
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        button {
            border-radius: 4px;
            background-color:$coloresMes[$mes];
            cursor:pointer;
            padding: 5px 10px;
            transition: background-color 0.3s;
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }
        button:hover {
            background-color: rgba(0, 0, 0, 0.2);
            color: white;
            transform: scale(1.01);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        th.header {
            background-color: $coloresMes[$mes];
            color: black;
            padding: 10px;
        }
        .current-day {
            background-color: rgba(255, 223, 186, 0.7);
            border: 2px solid #FFA500;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: #333;
        }
        .current-day:hover {
            background-color: rgba(255, 220, 186, 0.7);
        }
    </style>";

    foreach ($diasDeSemana as $dia) {
        $calendario .= "<th class='header'>$dia</th>";
    }
    $calendario .= "<br></tr><tr>"; 
    if ($diaSemana > 0) { 
        for ($i = 0; $i < $diaSemana; $i++) {
            $calendario .= "<td></td>";
        }
    }

    $diaActual = 1;
    $mes = str_pad($mes, 2, "0", STR_PAD_LEFT);

    while ($diaActual <= $numeroDias) {
        if ($diaSemana == 7) { 
            $diaSemana = 0; 
            $calendario .= "</tr><tr>";
        }

        $diaActualRel = str_pad($diaActual, 2, "0", STR_PAD_LEFT);
        $fecha = "$año-$mes-$diaActual";
        $class = ($diaActual == $diaHoy && $mes == $mesHoy && $año == $añoHoy) ? 'current-day' : '';
        $calendario .= "<td class='$class'><h4>$diaActual</h4>";

        $sql = "SELECT actividad FROM actividades WHERE fecha='$fecha'";
        $result = $conn->query($sql);
        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $calendario .= $row['actividad'];
            }
        }

        if (($año == $añoHoy and $mes >= $mesHoy and ($diaActual >= $diaHoy or $mes > $mesHoy)) or ($año > $añoHoy)) {
            $calendario .= "<form method='POST'><input type='hidden' name='fecha' value='$fecha'>
            <button type='submit' name='asignar' value='$fecha' class='asignar'>";
            $check_sql = "SELECT * FROM actividades WHERE fecha='$fecha'";
            $result = $conn->query($check_sql);

            if (($result->num_rows > 0)) {
                $calendario .= "Editar";

            } else {
                $calendario .= "Asignar";
            }
            $calendario .="</button></form></td>";
        }
        else {
            $calendario .= "<br>";
        }
        $diaActual++;
        $diaSemana++;
    }

    if($diaSemana != 7) {
        $diasRestantes = 7 - $diaSemana;
        for ($i = 0; $diasRestantes > $i; $i++) {
            $calendario .= "<td></td>";
        }
    }

    $calendario .= "</tr>";
    $calendario .= "</table><br><br><br></form></div>";

    if (isset($_POST['asignar'])) {
        $fecha = $_POST['fecha'];
        $check_sql = "SELECT * FROM actividades WHERE fecha='$fecha'";
        $result = $conn->query($check_sql);
        $result->num_rows > 0;

        echo "<div class='asignacion' style='position: fixed; top: 50%; right: 0; transform: translateY(-50%); text-align: center;'>
        <h3>Asignación</h3> $fecha
        <form method='post'>
            <input type='hidden' name='fecha1' value='$fecha'>
            <textarea placeholder='Actividad' name='actividad' onchange='this.form.submit()' style='width: 85%; height: 80px; text-align: center;'>"
            .($result->num_rows > 0 ? $result->fetch_assoc()['actividad'] : '')."</textarea>
            <br><br><input type='submit' value='Guardar' class='guardar' style='background-color: limegreen; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;'>
        </form>
        
        <br><button class='cerrar' onclick='this.parentElement.style.display=\"none\";' style='background-color: red; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;'>X</button>
        </div>";

        if (!isset($_SESSION["fecha"]) or !in_array($fecha, $_SESSION["fecha"])) {
            $_SESSION["fecha"][] = $fecha;
            $i = array_search($fecha, $_SESSION["fecha"]);
            $_SESSION["asignado"] = true;

            if ($i % 2 != 0) {
                unset($_SESSION["fecha"][$i-1]);
                unset($_SESSION["fecha"][$i]);
                $_SESSION["fecha"] = array_values($_SESSION["fecha"]);
            }
        }
    }  

    if (isset($_POST["actividad"])) {
        $fecha = $_POST['fecha1'];
        $index = array_search($fecha, $_SESSION["fecha"]);
        if ($index !== false) {
            $_SESSION["fecha"][$index + 1] = $_POST["actividad"];
            $fechaA = $_POST['fecha1'];
            $actividad = $_POST['actividad'];
            
            $check_sql = "SELECT * FROM actividades WHERE fecha='$fechaA'";
            $result = $conn->query($check_sql);
            
            if ($actividad == "") {
                $sql = "DELETE FROM actividades WHERE fecha='$fechaA'";
            } else {
                if ($result->num_rows > 0) {
                    $sql = "UPDATE actividades SET actividad='$actividad' WHERE fecha='$fechaA'";
                } else {
                    $sql = "INSERT INTO actividades (fecha, actividad) VALUES ('$fechaA', '$actividad')";
                }
            }
            $conn->query($sql);
        }
        $conn->close();
    } 
    echo $calendario;
}
?>

<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
</head>
<body>
    <div class="encabezado">
        <div class="header-content">
            <img src="./imagenes/Logo_USM_Horizontal.png" alt="Logo">
            <div class="welcome-message">Calendario</div>
            <div class="date" id="date"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class = "col-md-12">
                <?php
                    $_SESSION['user_id'] ??= '';
                    $mes = isset($_GET['mes']) ? $_GET['mes'] : date('n');
                    $año = isset($_GET['año']) ? $_GET['año'] : date('Y');

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "datos_login";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT id, accesos FROM profe_y_alumno";
                    $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if ($row['id'] == $_SESSION['user_id']) {
                            if ($row['accesos'] == 1) {
                                crear_calendario_profesor($mes, $año);
                            } else {
                                crear_calendario_estudiante($mes, $año);
                            }
                            break;
                        }
                    }
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    document.getElementById('date').textContent = new Date().toLocaleDateString();
    document.addEventListener('DOMContentLoaded', function() {
        const cells = document.querySelectorAll('td');
        cells.forEach(cell => {
            cell.addEventListener('mouseover', function() {
                this.style.backgroundColor = 'rgba(255, 255, 255, 0.4)';
            });
            cell.addEventListener('mouseout', function() {
                this.style.backgroundColor = '';
            });
        });
    });
</script>