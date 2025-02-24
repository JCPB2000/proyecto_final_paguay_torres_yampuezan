document.addEventListener("DOMContentLoaded", function() {
    const modalLibro = new bootstrap.Modal(document.getElementById("modalLibro"));
    const formLibro = document.getElementById("formLibro");

    // Abrir el modal al hacer clic en "Nuevo Libro"
    document.getElementById("btnNuevoLibro").addEventListener("click", function() {
        document.getElementById("libroId").value = "";
        document.getElementById("titulo").value = "";
        document.getElementById("autor").value = "";
        modalLibro.show();
    });

    // Enviar datos al backend cuando se envía el formulario
    formLibro.addEventListener("submit", function(event) {
        event.preventDefault();

        // Obtener los valores correctamente
        const id = document.getElementById("libroId").value;
        const titulo = document.getElementById("titulo").value.trim();
        const autor = document.getElementById("autor").value.trim();

        // Mostrar los valores en la consola para verificar
        console.log("Título:", titulo);
        console.log("Autor:", autor);

        // Validar si los campos están vacíos
        if (!titulo || !autor) {
            alert("Debe completar todos los campos");
            return;
        }

        if (id) {
            // Editar libro
            axios.put(`/Proyecto_final_Paguay_Torres_Yampuezan/public/api/libros/${id}`, { titulo, autor })
                .then(response => {
                    alert(response.data.message);
                    location.reload();
                })
                .catch(error => {
                    console.error("Error al actualizar libro:", error);
                    alert("Hubo un error al actualizar el libro.");
                });
        } else {
            // Agregar nuevo libro
            axios.post("/Proyecto_final_Paguay_Torres_Yampuezan/public/api/libros", { titulo, autor })
                .then(response => {
                    alert(response.data.message);
                    location.reload();
                })
                .catch(error => {
                    console.error("Error al agregar libro:", error);
                    alert("Hubo un error al agregar el libro.");
                });
        }
    });

    // Manejo de eliminación de libros
    document.querySelectorAll(".btn-eliminar").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            if (confirm("¿Seguro que deseas eliminar este libro?")) {
                axios.delete(`/Proyecto_final_Paguay_Torres_Yampuezan/public/api/libros/delete/${id}`)
                    .then(response => {
                        alert(response.data.message);
                        location.reload();
                    })
                    .catch(error => {
                        console.error("Error al eliminar:", error);
                        alert("Hubo un error al eliminar el libro.");
                    });
            }
        });
    });

    // Manejo de edición de libros
    document.querySelectorAll(".btn-editar").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");

            axios.get(`/Proyecto_final_Paguay_Torres_Yampuezan/public/api/libros/${id}`)
                .then(response => {
                    console.log("Respuesta de la API:", response.data);
                    
                    if (response.data.success) {
                        document.getElementById("libroId").value = id;
                        document.getElementById("titulo").value = response.data.libro.titulo;
                        document.getElementById("autor").value = response.data.libro.autor;
                        modalLibro.show();
                    } else {
                        alert("Error al cargar los datos: " + response.data.message);
                    }
                })
                .catch(error => {
                    console.error("Error en la solicitud a la API:", error);
                    alert("Hubo un error al cargar los datos del libro. Revisa la consola.");
                });
        });
    });
});
