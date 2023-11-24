<?php
header('Content-Type: application/json');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lockers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array('success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error)));
}


$numLocker = $_POST['numlock'];
$ubicacion = $_POST['ubicacion'];
$tipo = $_POST['tipo'];
$precio = $_POST['precio'];


$verificar_sql = "SELECT * FROM locker WHERE num_locker = '$numLocker'";
$verificar_result = $conn->query($verificar_sql);

if ($verificar_result->num_rows > 0) {
    echo json_encode(array('success' => false, 'message' => 'Error: El número de locker ya está registrado.'));
} else {
    // Insertar datos en la tabla "locker"
    $sql = "INSERT INTO locker (num_locker, ubicacion, tipo, precio) VALUES ('$numLocker', '$ubicacion', '$tipo', '$precio')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('success' => true, 'message' => 'Registro exitoso'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error al registrar el locker: ' . $conn->error));
    }
}

$conn->close();
?>

