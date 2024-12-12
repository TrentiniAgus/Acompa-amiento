<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Libro</title>
</head>
<body>
    <h1>Registro de Libro</h1>
    <form action="registro_libro.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="genero">Género:</label>
        <input type="text" name="genero" id="genero" required><br><br>

        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" required><br><br>

        <label for="editorial">Editorial:</label>
        <input type="text" name="editorial" id="editorial" required><br><br>

        <label for="fecha">Fecha de Publicación:</label>
        <input type="date" name="fecha" id="fecha" required><br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>