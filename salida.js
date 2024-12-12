fetch('http://localhost/buscar_libros.php?titulo=Quijote')
    .then(response => response.json())
    .then(data => {
        console.log('Libros encontrados:', data);
        // Procesar y mostrar los datos
        data.forEach(libro => {
            console.log(`Título: ${libro.titulo}, Autor: ${libro.autor}`);
        });
    })
    .catch(error => console.error('Error:', error));
