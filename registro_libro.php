<?php
// Configuración de la base de datos
$host = "localhost:3306";
$usuario = "root"; // Usuario predeterminado de XAMPP
$password = ""; // Contraseña vacía por defecto
$base_datos = "biblioteca";

// Lista de géneros permitidos
$generos_permitidos = ['Ficción', 'Novela', 'Ciencia', 'Fantasía', 'Poesía', 'Ensayo', 'Terror', 'Drama'];

// Conectar a la base de datos
$conn = new mysqli($host, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se han recibido todos los datos mediante POST
if (
    isset($_POST['titulo']) &&
    isset($_POST['genero']) &&
    isset($_POST['autor']) &&
    isset($_POST['editorial']) &&
    isset($_POST['fecha'])
) {
    // Capturar los datos
    $titulo = trim($_POST['titulo']);
    $genero = trim($_POST['genero']);
    $autor = trim($_POST['autor']);
    $editorial = trim($_POST['editorial']);
    $fecha = trim($_POST['fecha']);

    // Validar los datos
    $errores = [];

    // Validar Título
    if (empty($titulo) || strlen($titulo) > 150) {
        $errores[] = "El título debe ser una cadena no vacía de hasta 150 caracteres.";
    }

    // Validar Género
    if (empty($genero) || strlen($genero) > 8 || !in_array($genero, $generos_permitidos)) {
        $errores[] = "El género debe ser una cadena de hasta 8 caracteres y estar en la lista de géneros permitidos: " . implode(', ', $generos_permitidos) . ".";
    }

    // Validar Autor
    if (empty($autor) || strlen($autor) > 150) {
        $errores[] = "El autor debe ser una cadena no vacía de hasta 150 caracteres.";
    }

    // Validar Editorial
    if (empty($editorial) || strlen($editorial) > 150) {
        $errores[] = "La editorial debe ser una cadena no vacía de hasta 150 caracteres.";
    }

    // Validar Fecha de Publicación
    $fecha_valida = strtotime($fecha);
    if (!$fecha_valida) {
        $errores[] = "La fecha de publicación debe ser una fecha válida.";
    }

    // Insertar en la base de datos si no hay errores
    if (empty($errores)) {
        $fecha_formateada = date('Y-m-d', $fecha_valida);
        $stmt = $conn->prepare("INSERT INTO libros (titulo, genero, autor, editorial, fecha) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $titulo, $genero, $autor, $editorial, $fecha_formateada);

        if ($stmt->execute()) {
            echo "<p>El libro ha sido registrado exitosamente.</p>";
        } else {
            echo "<p>Error al registrar el libro: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        // Mostrar errores
        echo "<h1>Errores en los datos</h1>";
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    }
} else {
    echo "<p>Error: Por favor, proporciona todos los datos del libro mediante el método POST.</p>";
}

// Cerrar conexión
$conn->close();
?>
