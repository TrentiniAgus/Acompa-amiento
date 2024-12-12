<?php
// Configuración de la base de datos
$host = "localhost";
$usuario = "root"; // Usuario predeterminado de XAMPP
$password = ""; // Contraseña vacía por defecto
$base_datos = "biblioteca";

// Conectar a la base de datos
$conn = new mysqli($host, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conn->connect_error]));
}

// Capturar parámetros de búsqueda
$titulo = isset($_GET['titulo']) ? trim($_GET['titulo']) : '';
$genero = isset($_GET['genero']) ? trim($_GET['genero']) : '';
$autor = isset($_GET['autor']) ? trim($_GET['autor']) : '';

// Construir la consulta SQL con filtros opcionales
$sql = "SELECT id, titulo, genero, autor, editorial, fecha FROM libros WHERE 1=1";

if (!empty($titulo)) {
    $sql .= " AND titulo LIKE ?";
}
if (!empty($genero)) {
    $sql .= " AND genero LIKE ?";
}
if (!empty($autor)) {
    $sql .= " AND autor LIKE ?";
}

// Preparar la consulta
$stmt = $conn->prepare($sql);
$tipos = '';
$parametros = [];

if (!empty($titulo)) {
    $tipos .= 's';
    $parametros[] = "%" . $titulo . "%";
}
if (!empty($genero)) {
    $tipos .= 's';
    $parametros[] = $genero;
}
if (!empty($autor)) {
    $tipos .= 's';
    $parametros[] = "%" . $autor . "%";
}

// Asociar parámetros si hay filtros
if ($tipos) {
    $stmt->bind_param($tipos, ...$parametros);
}

// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();

// Crear un array con los resultados
$libros = [];
while ($fila = $result->fetch_assoc()) {
    $libros[] = $fila;
}

// Devolver los resultados en formato JSON
header('Content-Type: application/json');
echo json_encode($libros);

// Cerrar conexiones
$stmt->close();
$conn->close();
?>
