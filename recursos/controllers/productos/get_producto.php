<?php

// Verificar si el ID está definido en GET
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    echo json_encode(["error" => "ID del producto no proporcionado."]);
    exit();
}

try {
    // Preparar la consulta
    $sql = "SELECT 
            p.id AS id,
            p.codigo_producto,
            p.codigo_saco,
            p.nombre,
            p.descripcion,
            p.imagen,
            p.stock,
            p.stock_min,
            p.stock_max,
            p.precio_compra,
            p.precio_venta,
            p.fecha_ingreso,
            p.id_categoria,
            p.id_usuario,
            c.nombre AS categoria_nombre,
            u.email AS usuario_email
        FROM productos p
        JOIN categorias c ON p.id_categoria = c.id
        JOIN usuarios u ON p.id_usuario = u.id
        WHERE p.id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

    // Obtener los resultados en un array asociativo
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        die("Error: No se encontró el producto con ID: " . $id);
    }

    // Asignar los valores recuperados a variables individuales
    $codigo_producto = $producto['codigo_producto'];
    $codigo_saco = $producto['codigo_saco'];
    $nombre = $producto['nombre'];
    $descripcion = $producto['descripcion'];
    $stock = $producto['stock'];
    $stock_min = $producto['stock_min'];
    $stock_max = $producto['stock_max'];
    $precio_compra = $producto['precio_compra'];
    $precio_venta = $producto['precio_venta'];
    $fecha_ingreso = $producto['fecha_ingreso'];
    $imagen = $producto['imagen'];
    $id_categoria = $producto['id_categoria'];
    $id_usuario = $producto['id_usuario'];
    $categoria_nombre = $producto['categoria_nombre'];
} catch (PDOException $e) {
    echo json_encode(["error" => "Error al obtener el Producto: " . $e->getMessage()]);
}
?>