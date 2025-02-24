<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Libros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<?php include __DIR__ . "/../layouts/menu.php"; ?>

<div class="container mt-4">
    <h1>Libros</h1>
    <button class="btn btn-primary" id="btnNuevoLibro">Nuevo Libro</button>

    <table class="table mt-3">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?= htmlspecialchars($libro['titulo']) ?></td>
                    <td><?= htmlspecialchars($libro['autor']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm btn-editar" data-id="<?= $libro['id'] ?>">Editar</button>
                        <button class="btn btn-danger btn-sm btn-eliminar" data-id="<?= $libro['id'] ?>">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- MODAL PARA AGREGAR/EDITAR LIBROS -->
<div class="modal fade" id="modalLibro" tabindex="-1" aria-labelledby="modalLibroLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLibroLabel">Agregar Nuevo Libro</h5> <!-- Título dinámico -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formLibro">
                    <input type="hidden" id="libroId">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control" id="autor" required placeholder="Escriba el nombre del autor">
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const modalLibro = new bootstrap.Modal(document.getElementById("modalLibro"));
    const modalTitle = document.getElementById("modalLibroLabel");

    // Abrir el modal para nuevo libro
    document.getElementById("btnNuevoLibro").addEventListener("click", function() {
        document.getElementById("libroId").value = "";
        document.getElementById("titulo").value = "";
        document.getElementById("autor").value = "";
        modalTitle.textContent = "Agregar Nuevo Libro"; 
        modalLibro.show();
    });

    // Abrir el modal para editar libro
    document.querySelectorAll(".btn-editar").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");

            axios.get(`/Proyecto_final_Paguay_Torres_Yampuezan/public/api/libros/${id}`)
                .then(response => {
                    if (response.data.success) {
                        document.getElementById("libroId").value = id;
                        document.getElementById("titulo").value = response.data.libro.titulo;
                        document.getElementById("autor").value = response.data.libro.autor;
                        modalTitle.textContent = "Modificar Libro";
                        modalLibro.show();
                    } else {
                        alert("❌ Error al cargar los datos: " + response.data.message);
                    }
                })
                .catch(error => {
                    console.error("❌ Error en la solicitud a la API:", error);
                    alert("Hubo un error al cargar los datos del libro. Revisa la consola.");
                });
        });
    });
});
</script>

<script src="/Proyecto_final_Paguay_Torres_Yampuezan/assets/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
