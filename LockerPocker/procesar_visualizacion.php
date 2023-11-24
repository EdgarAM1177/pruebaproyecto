<?php
// Conexión a la base de datos (ajusta según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lockers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST["table"];
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        // Encabezados
        echo "<tr>";
        while ($fieldinfo = $result->fetch_field()) {
            echo "<th>" . $fieldinfo->name . "</th>";
        }
        echo "</tr>";

        // Datos
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                if ($key !== 'contrasena') {
                    echo "<td>" . $value . "</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

$conn->close();
?>
