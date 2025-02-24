<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Libro</title>
    
    <!-- Enlace a Bootstrap para estilos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa; /* Fondo claro y amigable */
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
        }
    </style>
</head>
<body>

<!-- Contenedor principal -->
<div class="container mt-5">
    <h2>📖 Agregar Nuevo Libro</h2>
    
    <form id="formLibro">
        <!-- Campo para el título del libro -->
        <div class="mb-3">
            <label for="titulo" class="form-label"><strong>Título</strong></label>
            <input type="text" class="form-control" id="titulo" placeholder="Ingrese el título del libro" required>
        </div>

        <!-- Campo para el nombre del autor -->
        <div class="mb-3">
            <label for="autor" class="form-label"><strong>Autor</strong></label>
            <input type="text" class="form-control" id="autor" placeholder="Ingrese el nombre del autor" required>
        </div>

        <!-- Botón para guardar -->
        <button type="submit" class="btn btn-success">✅ Guardar</button>
    </form>
</div>

<!-- Enlace a Axios para manejar las solicitudes HTTP -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Capturar el envío del formulario
    document.getElementById("formLibro").addEventListener("submit", function(event) {
        event.preventDefault(); // Evita que la página se recargue

        const titulo = document.getElementById("titulo").value.trim();
        const autor = document.getElementById("autor").value.trim();

        if (!titulo || !autor) {
            alert("Por favor, complete todos los campos.");
            return;
        }

        // Enviar datos a la API usando Axios
        axios.post("http://localhost/Proyecto_final_Paguay_Torres_Yampuezan/public/api/libros", {
            titulo: titulo,
            autor: autor
        })
        .then(response => {
            alert("📚 Libro agregado con éxito");
            location.href = "/Proyecto_final_Paguay_Torres_Yampuezan/public/libros"; // Redirigir a la lista de libros
        })
        .catch(error => {
            console.error("❌ Error al agregar libro:", error);
            alert("Hubo un problema al guardar el libro.");
        });
    });
</script>

</body>
</html>
