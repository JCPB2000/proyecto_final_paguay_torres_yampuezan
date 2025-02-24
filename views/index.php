<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros y Autores</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="/proyecto_final_paguay_torres_yampuezan/public/css/styles.css"> 
</head>
<body>

<!-- Menú de Navegación -->
<?php include __DIR__ . "/layouts/menu.php"; ?>

<div class="container mt-5">
    <h1 class="text-primary text-center">📚 <strong>Gestión de Libros y Autores</strong> 📖</h1>

    <!-- Sección de Integrantes -->
    <div class="mt-4 p-4 bg-light border rounded shadow-sm">
        <h2 class="text-secondary">👥 <strong>Integrantes del Grupo</strong></h2>
        <ul class="list-group">
            <li class="list-group-item">Julio Cesar Paguay Bonilla</li>
            <li class="list-group-item">Tiffani Nathalia Torres Díaz</li>
            <li class="list-group-item">Yampuezan Burbano Verónica Janeth</li>
        </ul>
    </div>

    <!-- Descripción de la Aplicación -->
    <div class="mt-4 p-4 bg-light border rounded shadow-sm">
        <h2><strong>Sobre la Aplicación</strong></h2>
        <p>
            La aplicación también proporciona una <strong>interfaz interactiva</strong> mediante el uso de <strong>modales y formularios dinámicos</strong>, 
            permitiendo una <strong>experiencia de usuario fluida</strong>. Con soporte para <strong>múltiples usuarios</strong> y una <strong>base de datos escalable</strong>, 
            este sistema es ideal para <strong>bibliotecas, librerías y coleccionistas de libros</strong> que desean mantener un <strong>registro digital 
            completo y actualizado</strong>.
        </p>
    </div>

    <!-- Botones de Gestión -->
    <div class="mt-4 text-center">
        <a href="/proyecto_final_paguay_torres_yampuezan/public/libros" class="btn btn-primary btn-lg">📚 <strong>Gestionar Libros</strong></a>
        <a href="/proyecto_final_paguay_torres_yampuezan/public/autores" class="btn btn-secondary btn-lg">✍️ <strong>Gestionar Autores</strong></a>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
