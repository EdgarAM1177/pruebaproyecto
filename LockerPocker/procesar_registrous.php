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

$matricula = $_POST['matricula'];
$nombre_alumno = $_POST['nombre_alumno'];
$apellido_alumno = $_POST['apellido_alumno'];
$docencia = $_POST['docencia'];
$carrera = $_POST['carrera'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$verificar_sql = "SELECT * FROM usuario WHERE matricula = '$matricula'";
$verificar_result = $conn->query($verificar_sql);

if ($verificar_result->num_rows > 0) {
    echo json_encode(array('success' => false, 'message' => 'Error: La matrícula ya está registrada.'));
} else {
    $sql = "INSERT INTO usuario (matricula, nombre_alumno, apellido_alumno, docencia, carrera, usuario, contrasena) VALUES ('$matricula', '$nombre_alumno', '$apellido_alumno', '$docencia', '$carrera', '$usuario', '$contrasena')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('success' => true, 'message' => 'Registro exitoso'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error al registrar el usuario: ' . $conn->error));
    }
}

$conn->close();
?>
