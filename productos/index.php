<?php
require_once '../config/database.php';
require_once 'funciones.php';

$productoController = new ProductoController();
$productos = [];

try {
    $productos = $productoController->listarProductos();
} catch (Exception $e) {
    $errorMessage = "Error al listar productos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Productos</title>
</head>
<body>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item active">Productos</li>
            </ol>
        </nav>

        <div class="row mb-3">
            <div class="col">
                <h1>Gestión Productos</h1>
            </div>
            <div class="col text-end">
                <a href="nuevo.php" class="btn btn-primary">Nuevo producto</a>
            </div>
        </div>

        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo $producto->_id; ?></td>
                    <td><?php echo htmlspecialchars($producto->nombre); ?></td>
                    <td><?php echo htmlspecialchars($producto->precio); ?></td>
                    <td><?php echo htmlspecialchars($producto->descripcion); ?></td>
                    <td><?php echo htmlspecialchars($producto->categoria); ?></td>
                    <td><?php echo $producto->disponible ? 'Sí' : 'No'; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $producto->_id; ?>" class="btn btn-warning">Editar</a>
                        <a href="funciones.php?action=eliminar&id=<?php echo $producto->_id; ?>" 
                            class="btn btn-danger"
                            onclick="return confirm('¿Está seguro de eliminar este producto?')">
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
