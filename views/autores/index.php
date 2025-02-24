<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Autores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<?php include __DIR__ . "/../layouts/menu.php"; ?>

<div class="container mt-4">
    <h1>Autores</h1>
    <button class="btn btn-primary" id="btnNuevoAutor">Nuevo Autor</button>

    <table class="table mt-3">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($autores as $autor): ?>
                <tr>
                    <td><?= htmlspecialchars($autor['nombre']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm btn-editar" data-id="<?= $autor['id'] ?>">Editar</button>
                        <button class="btn btn-danger btn-sm btn-eliminar" data-id="<?= $autor['id'] ?>">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- MODAL PARA REGISTRAR/EDITAR AUTORES -->
<div class="modal fade" id="formularioModal" tabindex="-1" aria-labelledby="formularioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAutorLabel">Agregar Nuevo Autor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAutor">
                    <input type="hidden" id="autorId"> <!-- ID oculto para edición -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" required>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const modalAutor = new bootstrap.Modal(document.getElementById("formularioModal"));
    const modalTitle = document.getElementById("modalAutorLabel");

    // Abrir el modal para nuevo autor
    document.getElementById("btnNuevoAutor").addEventListener("click", function() {
        document.getElementById("autorId").value = "";
        document.getElementById("nombre").value = "";
        modalTitle.textContent = "Agregar Nuevo Autor"; // Cambia el título
        modalAutor.show();
    });

    // Abrir el modal para editar autor
    document.querySelectorAll(".btn-editar").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");

            axios.get(`/Proyecto_final_Paguay_Torres_Yampuezan/public/api/autores/${id}`)
                .then(response => {
                    if (response.data.success) {
                        document.getElementById("autorId").value = id;
                        document.getElementById("nombre").value = response.data.autor.nombre;
                        modalTitle.textContent = "Modificar"; // Cambia el título
                        modalAutor.show();
                    } else {
                        alert("Error al cargar los datos: " + response.data.message);
                    }
                })
                .catch(error => {
                    console.error("Error en la solicitud a la API:", error);
                    alert("Hubo un error al cargar los datos del autor. Revisa la consola.");
                });
        });
    });

    // Manejo de eliminación de autores
    document.querySelectorAll(".btn-eliminar").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            if (confirm("¿Seguro que deseas eliminar este autor?")) {
                axios.delete(`/Proyecto_final_Paguay_Torres_Yampuezan/public/api/autores/delete/${id}`)
                    .then(response => {
                        alert(response.data.message);
                        location.reload();
                    })
                    .catch(error => {
                        console.error("Error al eliminar:", error);
                        alert("Hubo un error al eliminar el autor.");
                    });
            }
        });
    });

    // Enviar datos al backend cuando se envía el formulario
    document.getElementById("formAutor").addEventListener("submit", function(event) {
        event.preventDefault();

        const id = document.getElementById("autorId").value;
        const nombre = document.getElementById("nombre").value.trim();

        if (!nombre) {
            alert("Debe ingresar un nombre");
            return;
        }

        if (id) {
            // Editar autor
            axios.put(`/Proyecto_final_Paguay_Torres_Yampuezan/public/api/autores/${id}`, { nombre })
                .then(response => {
                    alert(response.data.message);
                    location.reload();
                })
                .catch(error => {
                    console.error("Error al actualizar autor:", error);
                    alert("Hubo un error al actualizar el autor.");
                });
        } else {
            // Agregar nuevo autor
            axios.post("/Proyecto_final_Paguay_Torres_Yampuezan/public/api/autores", { nombre })
                .then(response => {
                    alert(response.data.message);
                    location.reload();
                })
                .catch(error => {
                    console.error("Error al agregar autor:", error);
                    alert("Hubo un error al agregar el autor.");
                });
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
