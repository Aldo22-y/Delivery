<?php
require_once __DIR__ . '/../config/database.php';

class ProductoController {
    private $db;
    private $collection;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getDatabase();
        $this->collection = $this->db->productos;
    }

    public function listarProductos() {
        try {
            return $this->collection->find([], [
                'sort' => ['nombre' => 1]
            ]);
        } catch (Exception $e) {
            throw new Exception("Error al listar los productos: " . $e->getMessage());
        }
    }

    public function crearProductos($datos) {
        // Validación de datos
        if (empty($datos['nombre']) || empty($datos['precio']) || empty($datos['descripcion']) || empty($datos['categoria'])) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        try {
            $resultado = $this->collection->insertOne([
                'nombre' => $datos['nombre'],
                'precio' => (float)$datos['precio'],
                'descripcion' => $datos['descripcion'],
                'categoria' => $datos['categoria'],
                'disponible' => isset($datos['disponible']) ? true : false, // Manejo de disponibilidad
            ]);
        } catch (Exception $e) {
            throw new Exception("Error al crear el producto: " . $e->getMessage());
        }
    }

    public function obtenerProductos($id) {
        try {
            return $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        } catch (Exception $e) {
            throw new Exception("Error al obtener el producto: " . $e->getMessage());
        }
    }

    public function actualizarProducto($id, $datos) {
        // Validación de datos
        if (empty($datos['nombre']) || empty($datos['precio']) || empty($datos['descripcion']) || empty($datos['categoria'])) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        try {
            $resultado = $this->collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($id)],
                ['$set' => [
                    'nombre' => $datos['nombre'],
                    'precio' => (float)$datos['precio'],
                    'descripcion' => $datos['descripcion'],
                    'categoria' => $datos['categoria'],
                    'disponible' => isset($datos['disponible']) ? true : false, // Manejo de disponibilidad
                ]]
            );
        } catch (Exception $e) {
            throw new Exception("Error al actualizar el producto: " . $e->getMessage());
        }
    }

    public function eliminarProducto($id) {
        try {
            $producto = $this->obtenerProductos($id);
            if (!$producto) {
                throw new Exception("Producto no encontrado");
            }

            $resultado = $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
            if ($resultado->getDeletedCount() === 0) {
                throw new Exception("No se pudo eliminar el producto");
            }
        } catch (Exception $e) {
            throw new Exception("Error al eliminar el producto: " . $e->getMessage());
        }
    }
}

// Procesar acciones si se reciben por GET
if (isset($_GET['action']) && isset($_GET['id'])) {
    $controller = new ProductoController();

    try {
        switch ($_GET['action']) {
            case 'eliminar':
                $controller->eliminarProducto($_GET['id']);
                header('Location: index.php');
                exit;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
