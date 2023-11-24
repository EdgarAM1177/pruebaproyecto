<?php
// Conexión a la base de datos (reemplaza con tus propios detalles de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lockers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener opciones de lockers o usuarios desde la base de datos
if (isset($_GET['opciones'])) {
    $opciones = $_GET['opciones'];

    if ($opciones === 'lockers') {
        $sqlLockers = "SELECT num_locker FROM locker WHERE num_locker NOT IN (SELECT num_locker FROM asignaciones)";
        $resultLockers = $conn->query($sqlLockers);

        $lockers = [];
        while ($row = $resultLockers->fetch_assoc()) {
            $lockers[] = $row['num_locker'];
        }

        // Devolver datos como JSON
        echo json_encode(['lockers' => $lockers]);
    } elseif ($opciones === 'usuarios') {
        $sqlUsuarios = "SELECT matricula FROM usuario WHERE matricula NOT IN (SELECT matricula FROM asignaciones)";
        $resultUsuarios = $conn->query($sqlUsuarios);

        $usuarios = [];
        while ($row = $resultUsuarios->fetch_assoc()) {
            $usuarios[] = $row['matricula'];
        }

        // Devolver datos como JSON
        echo json_encode(['usuarios' => $usuarios]);
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    exit();
}

// Procesar el formulario y realizar la asignación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $numLocker = $_POST['num_locker'];
    $matricula = $_POST['matricula'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];

    // Realizar la inserción en la tabla "asignaciones"
    $sqlInsertar = "INSERT INTO asignaciones (num_locker, matricula, fecha_inicio, fecha_fin) VALUES ('$numLocker', '$matricula', '$fechaInicio', '$fechaFin')";

    if ($conn->query($sqlInsertar) === TRUE) {
        echo "Asignación realizada con éxito.";
    } else {
        echo "Error al realizar la asignación: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
