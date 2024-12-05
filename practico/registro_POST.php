<?php
// Lista de géneros permitidos
$generos_permitidos = ['Ficción', 'Novela', 'Ciencia', 'Fantasía', 'Poesía', 'Ensayo', 'Terror', 'Drama'];

// Verificar si se han recibido todos los datos necesarios mediante POST
if (
    isset($_POST['titulo']) &&
    isset($_POST['genero']) &&
    isset($_POST['autor']) &&
    isset($_POST['editorial']) &&
    isset($_POST['fecha_publicacion'])
) {
    // Capturar los datos
    $titulo = trim($_POST['titulo']);
    $genero = trim($_POST['genero']);
    $autor = trim($_POST['autor']);
    $editorial = trim($_POST['editorial']);
    $fecha_publicacion = trim($_POST['fecha_publicacion']);

    // Validar los datos
    $errores = [];

    // Validar Título
    if (empty($titulo) || strlen($titulo) > 150) {
        $errores[] = "El título debe ser una cadena no vacía de hasta 150 caracteres.";
    }

    // Validar Género
    if (empty($genero) || strlen($genero) > 8 || !in_array($genero, $generos_permitidos)) {
        $errores[] = "El género debe ser una cadena de hasta 8 caracteres y debe estar en la lista de géneros permitidos: " . implode(', ', $generos_permitidos) . ".";
    }

    // Validar Autor
    if (empty($autor) || strlen($autor) > 150) {
        $errores[] = "El autor debe ser una cadena no vacía de hasta 150 caracteres.";
    }

    // Validar Fecha de Publicación
    $fecha_valida = strtotime($fecha_publicacion);
    if (!$fecha_valida) {
        $errores[] = "La fecha de publicación debe ser una fecha válida.";
    }

    // Validar Editorial
    if (empty($editorial) || strlen($editorial) > 150) {
        $errores[] = "La editorial debe ser una cadena no vacía de hasta 150 caracteres.";
    }

    // Mostrar resultados
    if (empty($errores)) {
        echo "<h1>Detalles del Libro</h1>";
        echo "<p><strong>Título:</strong> " . htmlspecialchars($titulo) . "</p>";
        echo "<p><strong>Género:</strong> " . htmlspecialchars($genero) . "</p>";
        echo "<p><strong>Autor:</strong> " . htmlspecialchars($autor) . "</p>";
        echo "<p><strong>Editorial:</strong> " . htmlspecialchars($editorial) . "</p>";
        echo "<p><strong>Fecha de Publicación:</strong> " . htmlspecialchars(date('Y-m-d', $fecha_valida)) . "</p>";
    } else {
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
?>
