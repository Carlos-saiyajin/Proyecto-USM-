<?php
session_start();
function crear_calendario ($mes, $año) {
    $diasDeSemana = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
    date_default_timezone_set('America/Caracas');
    $primerDia = mktime(0, 0, 0, $mes, 1, $año);
    $numeroDias = date('t', $primerDia);
    $infoFecha = getdate($primerDia);
    
    if ($mes == "1") {
        $nombreMes = "Enero";
    } elseif ($mes == "2") {
        $nombreMes = "Febrero";
    } elseif ($mes == "3") {
        $nombreMes = "Marzo";
    } elseif ($mes == "4") {
        $nombreMes = "Abril";
    } elseif ($mes == "5") {
        $nombreMes = "Mayo";
    } elseif ($mes == "6") {
        $nombreMes = "Junio";
    } elseif ($mes == "7") {
        $nombreMes = "Julio";
    } elseif ($mes == "8") {
        $nombreMes = "Agosto";
    } elseif ($mes == "9") {
        $nombreMes = "Septiembre";
    } elseif ($mes == "10") {
        $nombreMes = "Octubre";
    } elseif ($mes == "11") {
        $nombreMes = "Noviembre";
    } elseif ($mes == "12") {
        $nombreMes = "Diciembre";
    }

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
    $calendario .= "<br><div class='inner'>";
    $calendario .= "<center><h1>$nombreMes $año</h1>";
    $calendario .= "</div>";
    $calendario .= "<form method='GET' style='display:inline;'><input type='hidden' name='mes' value='" . ($mes == 1 ? 12 : $mes - 1) . "'><input type='hidden' name='año' value='" . ($mes == 1 ? $año - 1 : $año) . "'><button type='submit'>-Anterior mes</button></form>";
    $calendario .= "<form action='/Proyecto_USM/PublicacionesProfesor/menu.php' method='GET' style='display:inline;'><button type='submit'>Regresar al menú</button></form>";
    $calendario .= "<form method='GET' style='display:inline;'><input type='hidden' name='mes' value='" . ($mes == 12 ? 1 : $mes + 1) . "'><input type='hidden' name='año' value='" . ($mes == 12 ? $año + 1 : $año) . "'><button type='submit'>-Siguiente mes</button></form></center><br>";
    $calendario .= "<tr style='background-color: deepskyblue; color: black;'>";
    
    //Estilos
    $calendario .= "<style>
        body {
            background-image: url('/Proyecto_USM/assets/Calendario/$mes.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        td:hover {
            background-color: ghostwhite;
            background-color: rgba(255, 255, 255, 0.2);
        }
        div.outer {
            margin: 0 auto;
            width: 850px;
            border-radius: 15px;
            background-color:lightcyan;
            background-color: rgba(255, 255, 255, 0.5);
        }
        table {
            table-layout: fixed;
            border-collapse: collapse;
        }
        td {
            width: 100px;
            height: 100px;
            text-align: center;
            vertical-align: middle;
        }
        tr {
            background-color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        div.asignacion {
            border-radius: 15px;
            margin: 0 auto;
            width: 300px;
            height: 550px;
            background-color: white;
            opacity: 0.95;
        }
        div.asignacion .cerrar {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        button.asignar {
            width: 100px;
            background-color: $coloresMes[$mes];
            cursor: pointer;
        }
        div.inner {
            margin: 0 auto;
            width: 275px;
            border-radius: 15px;
            background-color:$coloresMes[$mes];
        }
        button {
            border-radius: 4px;
            background-color:$coloresMes[$mes];
            cursor:pointer;
        }
        button:hover {
            background-color:$coloresMes[$mes];
            background-color: rgba(255, 255, 255, 0.2);
        }
        th.header {
            background-color: $coloresMes[$mes];
            color: black;
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
        $calendario .= "<td><h4>$diaActual</h4>";

        if (isset($_SESSION["asignado"]) and $_SESSION["asignado"] == true) { 
            if (isset($_SESSION["fecha"]) and array_search($fecha, $_SESSION["fecha"]) !== false) {
                $index = array_search($fecha, $_SESSION["fecha"]);
                if (isset($_SESSION["fecha"][$index + 1])) {
                    $calendario .= $_SESSION["fecha"][$index + 1];
                }
            }    
        }

        if (($año == $añoHoy and $mes >= $mesHoy and ($diaActual >= $diaHoy or $mes > $mesHoy)) or ($año > $añoHoy)) {
            $calendario .= "<form method='POST'><input type='hidden' name='fecha' value='$fecha'>
            <button type='submit' name='asignar' value='$fecha' class='asignar'>";

            if (isset($_SESSION["fecha"]) and array_search($fecha, $_SESSION["fecha"]) !== false) {
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
        for ($i = 0; $i < $diasRestantes; $i++) {
            $calendario .= "<td></td>";
        }
    }

    $calendario .= "</tr>";
    $calendario .= "</table><br><br><br></form></div>";
    echo $calendario;

    if (isset($_POST['asignar'])) {
        $fecha = $_POST['fecha'];
        echo "<div class='asignacion' style='position: fixed; top: 50%; right: 0; transform: translateY(-50%); text-align: center;'>
        <h3>Asignación</h3> $fecha
        <form method='post'>
            <input type='hidden' name='fecha1' value='$fecha'>
            <textarea placeholder='Actividad' name='actividad' style='width: 85%; height: 80px; text-align: center; border-radius: 7px; background-color: ghostwhite;'></textarea>
            <br><br><input type='submit' name='si'>
        </form>
        <br><button class='cerrar' onclick='this.parentElement.style.display=\"none\";'>X</button>
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
        }
    } 
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
    <div class="container">
        <div class="row">
            <div class = "col-md-12">
                <?php
                    $mes = isset($_GET['mes']) ? $_GET['mes'] : date('n');
                    $año = isset($_GET['año']) ? $_GET['año'] : date('Y');
                    echo crear_calendario($mes, $año);
                ?>
            </div>
        </div>
    </div>
</body>
</html>