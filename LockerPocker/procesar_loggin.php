<?php
session_start();

// Conectar a la base de datos 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "productos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta BD
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row["tipo"] == "vendedor") {
            header("Location: vendedor/index_vendedores.html");
            exit;
        } elseif ($row["tipo"] == "administrador") {
            header("Location: administrador/index_administradores.html");
            exit;
        } else {
            echo "Tipo de usuario no reconocido";
        }
    } else {
        echo "Credenciales inválidas. Inténtelo de nuevo.";
    }
}

$conn->close();
?>
