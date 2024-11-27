<?php
require_once '../config/database.php';
require_once 'funciones.php';

$producto = new stdClass(); // Inicializa la variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productoController = new ProductoController();
    try {
        $productoController->crearProductos($_POST);
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        throw new Exception("Error al obtener el producto: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Nuevo Producto</title>
</head>
<body>
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="index.php">Producto</a></li>
            <li class="breadcrumb-item">Nuevo Producto</li>
        </ol>
    </nav>
    <h1>Nuevo Producto</h1>
    <form method="POST" class="needs-validation">
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
            <div class="invalid-feedback">
                Por favor ingrese el nombre del Producto
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio:</label>
            <input type="number" id="precio" name="precio" class="form-control" required>
            <div class="invalid-feedback">
                Por favor ingrese precio válido
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" required>
            <div class="invalid-feedback">
                Por favor ingrese una descripción coherente
            </div>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría:</label>
            <select id="categoria" name="categoria" class="form-select" required>
                <option value="Pizza">Pizza</option>
                <option value="Gaseosa">Gaseosa</option>
                <option value="Pasta">Pasta</option>
                <option value="Hamburguesa">Hamburguesa</option>
            </select>
            <div class="invalid-feedback">
                Por favor seleccione una categoría.
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Disponibilidad:</label>
            <input type="checkbox" id="disponible" name="disponible" class="form-check-input">
            <div class="invalid-feedback">
                Marque si el producto está disponible.
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>
