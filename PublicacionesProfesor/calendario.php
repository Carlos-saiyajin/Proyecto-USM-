<?php
session_start();
function crear_calendario ($mes, $año) {

    $diasDeSemana = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
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
    
    $calendario = "<div class='outer' style='text-align: center;'><form method='GET'><table border='1' style='margin: 0 auto;'>";
    $calendario .= "<br><div class='inner'>";
    $calendario .= "<center><h1>$nombreMes $año</h1>";
    $calendario .= "</div>";
    $calendario .= "<form method='GET' style='display:inline;'><input type='hidden' name='mes' value='" . ($mes == 1 ? 12 : $mes - 1) . "'><input type='hidden' name='año' value='" . ($mes == 1 ? $año - 1 : $año) . "'><button type='submit'>-Anterior mes</button></form>";
    $calendario .= "<a href='https://localhost/funcionando_login%20-%20copia/PublicacionesProfesor/'><button>Menu</button></a>";
    $calendario .= "<form method='GET' style='display:inline;'><input type='hidden' name='mes' value='" . ($mes == 12 ? 1 : $mes + 1) . "'><input type='hidden' name='año' value='" . ($mes == 12 ? $año + 1 : $año) . "'><button type='submit'>-Siguiente mes</button></form></center><br>";
    $calendario .= "<tr style='background-color: deepskyblue; color: black;'>";

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
        $calendario .= "<td><h4>$diaActual<br>$fecha</h4>";

        if (isset($_SESSION["asignacion"]) and $_SESSION["asignacion"] == true) { 
            if (isset($_SESSION["asignadof"]) && $_SESSION["asignadof"] == $fecha) {
                $calendario .= "<h3>".$_SESSION["asignado"]."</h3>";
                $_SESSION["asignacion"] = false;
            }
        }
        if (($año == $añoHoy and $mes >= $mesHoy and ($diaActual >= $diaHoy or $mes > $mesHoy)) or ($año > $añoHoy)) {
            $calendario .= "<form method='POST'><input type='hidden' name='fecha' value='$fecha'>
            <button type='submit' name='asignar' class='asignar'>Asignar</button></form></td>";
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
        echo "<div class='asignacion' style='text-align: center;'><h3>Asignación</h3>: $fecha
        <form method='post'>
            <input type='text' placeholder='Actividad' name='actividad'>
            <input type='submit' name='si'>
        </form>
        </div>";
    }  
    if (isset($_POST["actividad"])) {
        $_SESSION["asignado"] = $_POST["actividad"];
        $_SESSION["asignadof"] = $fecha;
        $_SESSION["asignacion"] = true;
    } 
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <style>
        div.asignacion {
            margin: 0 auto;
            width: 300px;
            height: 100px;
            border-radius: 15px;
            background-color: white;
        }
        button.asignar {
            width: 100px;
            background-color: lightcyan;
            cursor: pointer;
        }
        body {
            background-color:lightcyan;
        }
        div.inner {
            margin: 0 auto;
            width: 275px;
            border-radius: 15px;
            background-color:lightcoral;
        }
        div.outer {
            margin: 0 auto;
            width: 850px;
            border-radius: 15px;
            background-color:lightcyan;
        }
        button {

            border-radius: 4px;
            background-color:deepskyblue;
            cursor:pointer;
        }
        button:hover {
            background-color:skyblue;
        }
        table {
            table-layout: fixed;
            border-collapse: collapse;
        }
        td {
            width: 100px;
        }
        tr{
            background-color: white;
        }
        tr:hover {
            background-color: ghostwhite;
        }

    </style>
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