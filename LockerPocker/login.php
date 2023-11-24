<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lockers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta SQL para verificar la autenticación en la tabla 'admin'
$sql_admin = "SELECT * FROM admin WHERE nom_usuario = '$username' AND contrasena = '$password'";
$result_admin = $conn->query($sql_admin);

// Consulta SQL para verificar la autenticación en la tabla 'usuario'
$sql_usuario = "SELECT * FROM usuario WHERE nom_usuario = '$username' AND contrasena = '$password'";
$result_usuario = $conn->query($sql_usuario);

if ($result_admin->num_rows > 0) {
    // Autenticación exitosa en la tabla 'admin', redirigir al usuario a la página de inicio de admin
    $_SESSION['username'] = $username; // Almacenar el nombre de usuario en la sesión
    header("Location: index_admin.html");
} elseif ($result_usuario->num_rows > 0) {
    // Autenticación exitosa en la tabla 'usuario', redirigir al usuario a la página de perfil
    $_SESSION['username'] = $username; // Almacenar el nombre de usuario en la sesión
    header("Location: profile.php");
} else {
    // Autenticación fallida, redirigir al usuario de nuevo al formulario de login
    header("Location: index.html");
}

$conn->close();
?>
