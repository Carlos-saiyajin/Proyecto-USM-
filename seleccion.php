<!DOCTYPE html> 
<html lang="es"> 
<head> 
    <meta charset="UTF-8">
    <title>Restringir Usuarios</title> 
</head> 
<body> 
    <h2>Restringir Usuarios</h2> 
    <a href="menu.php"><button>Menú</button></a>
<?php

$conn = mysqli_connect("localhost", "root", "", "datos_login") or die("Error al conectarse a la base de datos."); 

$result = mysqli_query($conn, "SELECT * FROM registro");
 
// Rellenar el menú desplegable con los usuarios 

if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) 
     { 
        echo "<div>";
        echo "<p>Usuario: " . $row["nombres"]  . " " . $row["id"] .  " - "; 
        switch ($row["restringido"]) {
            case 1:
                echo "<span style='color: red;'>Restringido</span>";
                break;
            default:
                echo "<span style='color: green;'>Activo</span>";
                break;
        }
        echo "<form action='restringir.php' method='post'>";
        echo "<input type='hidden' name='userId' value='" . $row["id"] . "'>"; 
        echo "<button type='submit' name='restrict' value='1'>Restringir</button>"; 
        echo "<button type='submit' name='restrict' value='0'>Quitar Restricción</button>";
        echo "</form>";
        echo "</div><br>";
    } 
}
?>

</body> 
</html>
