<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
</head>
<body>
    <h1>Perfil de Usuario</h1>

    <?php
    // Verificar si el usuario ha iniciado sesión
    session_start();

    if(isset($_SESSION['username'])) {
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lockers";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Obtener el nombre de usuario de la sesión
        $username = $_SESSION['username'];

        // Consulta SQL para obtener los datos del usuario
        $sql_usuario = "SELECT * FROM usuario WHERE nom_usuario = '$username'";
        $result_usuario = $conn->query($sql_usuario);

        if ($result_usuario->num_rows > 0) {
            // Mostrar los datos del usuario
            $row_usuario = $result_usuario->fetch_assoc();
            echo "Matrícula: " . $row_usuario['matricula'] . "<br>";
            echo "Nombre: " . $row_usuario['nombre_alumno'] . " " . $row_usuario['apellido_alumno'] . "<br>";
            echo "Docencia: " . $row_usuario['docencia'] . "<br>";
            echo "Carrera: " . $row_usuario['carrera'] . "<br>";

            // Puedes agregar más campos según sea necesario
        } else {
            echo "No se encontraron datos de usuario.";
        }

        $conn->close();
    } else {
        // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
        header("Location: index.html");
    }
    ?>

    <!-- Puedes agregar más HTML según sea necesario -->

    <br>
    <a href="cerrar_sesion.php">Cerrar sesión</a> <!-- Asegúrate de tener un script de logout.php para destruir la sesión -->
</body>
</html>
