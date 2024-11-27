<?php
require_once '../Config/database.php';
require_once 'funciones.php';

$productoController = new ProductoController();

if (isset($_GET['id'])) {
    $producto = $productoController->obtenerProductos($_GET['id']);
}

// Si se envían los datos por el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $productoController->actualizarProducto($_GET['id'], $_POST);
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        throw new Exception('Producto no actualizado: ' . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Producto</title>
</head>
<body>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php">Productos</a></li>
                <li class="breadcrumb-item active">Editar Productos</li>
            </ol>
        </nav>

        <h1>Editar Producto</h1>

        <form method="POST" class="needs-validation">
            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo htmlspecialchars($producto->nombre); ?>" required>
                <div class="invalid-feedback">
                    Por favor ingrese el nombre del producto
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Precio:</label>
                <input type="number" id="precio" name="precio" class="form-control" value="<?php echo htmlspecialchars($producto->precio); ?>" required>
                <div class="invalid-feedback">
                    Por favor ingrese el precio válido
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo htmlspecialchars($producto->descripcion); ?>" required>
                <div class="invalid-feedback">
                    Por favor ingrese la descripción correcta
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Categoría:</label>
                <select id="categoria" name="categoria" class="form-select" required>
                    <option value="Pizza" <?php echo $producto->categoria === 'Pizza' ? 'selected' : ''; ?>>Pizza</option>
                    <option value="Gaseosa" <?php echo $producto->categoria === 'Gaseosa' ? 'selected' : ''; ?>>Gaseosa</option>
                    <option value="Pasta" <?php echo $producto->categoria === 'Pasta' ? 'selected' : ''; ?>>Pasta</option>
                    <option value="Hamburguesa" <?php echo $producto->categoria === 'Hamburguesa' ? 'selected' : ''; ?>>Hamburguesa</option>
                </select>
                <div class="invalid-feedback">
                    Por favor seleccione una categoría
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Disponibilidad:</label>
                <input type="checkbox" id="disponible" name="disponible" class="form-check-input" <?php echo $producto->disponible ? 'checked' : ''; ?>>
                <div class="invalid-feedback">
                    Marque si el producto está disponible.
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
