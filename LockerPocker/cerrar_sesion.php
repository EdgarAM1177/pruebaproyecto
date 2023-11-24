<?php
        // Iniciar sesión
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['nom_usuario'])) {
            header("Location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
            exit();
        }

        // Obtener el nombre de usuario de la sesión
        $nom_usuario = $_SESSION['nom_usuario'];

        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lockers";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consultar la base de datos para obtener los datos del usuario
        $sql = "SELECT * FROM usuario WHERE nom_usuario = '$nom_usuario'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los datos del usuario
            while ($row = $result->fetch_assoc()) {
                echo "Matrícula: " . $row["matricula"] . "<br>";
                echo "Nombre: " . $row["nombre_alumno"] . "<br>";
                echo "Apellido: " . $row["apellido_alumno"] . "<br>";
                echo "Docencia: " . $row["docencia"] . "<br>";
                echo "Carrera: " . $row["carrera"] . "<br>";
            }
        } else {
            echo "No se encontraron datos para el usuario.";
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
        ?>