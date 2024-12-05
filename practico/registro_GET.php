<?php
// Verificar si se han recibido todos los datos necesarios
if (
    isset($_GET['titulo']) &&
    isset($_GET['genero']) &&
    isset($_GET['autor']) &&
    isset($_GET['editorial']) &&
    isset($_GET['fecha_publicacion'])
) {
    // Capturar los datos enviados mediante GET
    $titulo = htmlspecialchars($_GET['titulo']);
    $genero = htmlspecialchars($_GET['genero']);
    $autor = htmlspecialchars($_GET['autor']);
    $editorial = htmlspecialchars($_GET['editorial']);
    $fecha_publicacion = htmlspecialchars($_GET['fecha_publicacion']);

    // Mostrar los datos en pantalla
    echo "<h1>Detalles del Libro</h1>";
    echo "<p><strong>Título:</strong> $titulo</p>";
    echo "<p><strong>Género:</strong> $genero</p>";
    echo "<p><strong>Autor:</strong> $autor</p>";
    echo "<p><strong>Editorial:</strong> $editorial</p>";
    echo "<p><strong>Fecha de Publicación:</strong> $fecha_publicacion</p>";
} else {
    // Mensaje de error si faltan datos
    echo "<p>Error: Por favor, proporciona todos los datos del libro mediante la URL.</p>";
    echo "<p>Ejemplo: ?titulo=El%20Quijote&genero=Novela&autor=Miguel%20de%20Cervantes&editorial=Espasa&fecha_publicacion=1605-01-16</p>";
}
?>
