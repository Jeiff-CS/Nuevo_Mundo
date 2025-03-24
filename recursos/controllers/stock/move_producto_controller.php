<?php
if (!file_exists(__DIR__ . '/../../bd.php')) {
    die("Error: No se encontró bd.php");
}
include(__DIR__ . '/../../bd.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProducto = $_POST['id']; // ID del producto
    $cantidad = intval($_POST['cantidad']); // Cantidad a mover
    $origen = $_POST['origen']; // Puede ser 'almacen', 'tienda_1' o 'tienda_2'
    $destino = $_POST['destino']; // Puede ser 'almacen', 'tienda_1' o 'tienda_2'

    if ($cantidad <= 0) {
        echo json_encode(["status" => "error", "message" => "La cantidad debe ser mayor a 0."]);
        exit;
    }

    // Obtener stock actual del origen
    $queryStock = $conn->prepare("SELECT stock_almacen, stock_tienda_1, stock_tienda_2 FROM productos WHERE id = ?");
    $queryStock->bind_param("i", $idProducto);
    $queryStock->execute();
    $result = $queryStock->get_result();
    
    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
        $stockOrigen = ($origen == 'almacen') ? $producto['stock_almacen'] : (($origen == 'tienda_1') ? $producto['stock_tienda_1'] : $producto['stock_tienda_2']);

        if ($cantidad > $stockOrigen) {
            echo json_encode(["status" => "error", "message" => "Stock insuficiente en el origen."]);
            exit;
        }

        // Actualizar stock en la base de datos
        $campoOrigen = ($origen == 'almacen') ? 'stock_almacen' : (($origen == 'tienda_1') ? 'stock_tienda_1' : 'stock_tienda_2');
        $campoDestino = ($destino == 'almacen') ? 'stock_almacen' : (($destino == 'tienda_1') ? 'stock_tienda_1' : 'stock_tienda_2');

        $queryUpdate = $conn->prepare("UPDATE productos SET $campoOrigen = $campoOrigen - ?, $campoDestino = $campoDestino + ? WHERE id = ?");
        $queryUpdate->bind_param("iii", $cantidad, $cantidad, $idProducto);
        $queryUpdate->execute();

        if ($queryUpdate->affected_rows > 0) {
            echo json_encode(["status" => "success", "message" => "Movimiento realizado correctamente."]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se pudo actualizar el stock."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Producto no encontrado."]);
    }
}
?>
