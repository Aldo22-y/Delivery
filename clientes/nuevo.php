<?php

use MongoDB\Operation\Explain;

    require_once '../config/database.php';
    require_once 'funciones.php';

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $clienteController= New ClienteController();
        try{
            $clienteController->crearCliente($_POST);
            header('Location: index.php');
            exit;
        } catch(Exception $e) {
            throw new Exception("Error al obtener el cliente: " . $e->getMessage());
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Nuevo Cliente</title>
</head>
<body>
<div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php">Clientes</a></li>
                <li class="breadcrumb-item">Nuevo Cliente</li>
            </ol>
        </nav>
        <h1>Nuevo Cliente</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label " for="nombre">
                    Nombre
                    <input class="form-control" type="text" id="nombre" name="nombre" require>
                    <div class="invalid-feedback">
                        por favor ingresar el nombre del cliente
                    </div>
                </label>
            </div>

            <div class="mb-3">
                <label class="form-label " for="correo">
                    Correo
                    <input class="form-control" type="email" id="correo" name="correo" require>
                    <div class="invalid-feedback">
                        por favor ingresar el correo del cliente
                    </div>
                </label>
            </div>

            <div class="mb-3">
                <label class="form-label " for="telefono">
                    Telefono
                    <input class="form-control" type="number" id="telefono" name="telefono" require>
                    <div class="invalid-feedback">
                        por favor ingresar el numero del cliente
                    </div>
                </label>
            </div>

            <div class="mb-3">
                <label class="form-label " for="direccion">
                    Direccion
                    <textarea class="form-control" type="text" id="direccion" name="direccion" require> </textarea>
                    <div class="invalid-feedback">
                        por favor ingresar la direccion del cliente
                    </div>
                </label>
            </div>

            <div class="mb-3">
                <button tyoe="submit" class="btn btn-primary">Guardar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>


        </form>
    </div>
</body>
</html>