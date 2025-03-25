<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(__DIR__ . '/../../bd.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idProducto = $_POST['id'];
        $origen = $_POST['origen'];
        $destino = $_POST['destino'];
        $cantidad = (int) $_POST['cantidad'];
    
        if (!$idProducto || !$origen || !$destino || $cantidad <= 0) {
            echo json_encode(["status" => "error", "message" => "Datos inválidos"]);
            exit;
        }
    
        try {
            $pdo->beginTransaction(); // Iniciar transacción
    
            // Obtener ID de la tienda de origen y destino
            $mapaTiendas = [
                "tienda_1" => 1,
                "tienda_2" => 2,
                "almacen"  => 3
            ];
    
            if (!isset($mapaTiendas[$origen]) || !isset($mapaTiendas[$destino])) {
                echo json_encode(["status" => "error", "message" => "Origen o destino inválido"]);
                exit;
            }
    
            $idTiendaOrigen = $mapaTiendas[$origen];
            $idTiendaDestino = $mapaTiendas[$destino];
    
            // Consultar stock en la tienda de origen
            $stmt = $pdo->prepare("SELECT stock FROM tienda_stock WHERE id_producto = ? AND id_tienda = ?");
            $stmt->execute([$idProducto, $idTiendaOrigen]);
            $stockOrigen = $stmt->fetchColumn();
    
            if ($stockOrigen === false || $stockOrigen < $cantidad) {
                echo json_encode(["status" => "error", "message" => "Stock insuficiente en el origen"]);
                exit;
            }
    
            // Restar cantidad en el origen
            $stmt = $pdo->prepare("UPDATE tienda_stock SET stock = stock - ? WHERE id_producto = ? AND id_tienda = ?");
            $stmt->execute([$cantidad, $idProducto, $idTiendaOrigen]);
    
            // Verificar si el producto ya existe en la tienda de destino
            $stmt = $pdo->prepare("SELECT stock FROM tienda_stock WHERE id_producto = ? AND id_tienda = ?");
            $stmt->execute([$idProducto, $idTiendaDestino]);
            $stockDestino = $stmt->fetchColumn();
    
            if ($stockDestino === false) {
                // Si no existe, insertar un nuevo registro
                $stmt = $pdo->prepare("INSERT INTO tienda_stock (id_producto, id_tienda, stock) VALUES (?, ?, ?)");
                $stmt->execute([$idProducto, $idTiendaDestino, $cantidad]);
            } else {
                // Si existe, actualizar el stock sumando la cantidad
                $stmt = $pdo->prepare("UPDATE tienda_stock SET stock = stock + ? WHERE id_producto = ? AND id_tienda = ?");
                $stmt->execute([$cantidad, $idProducto, $idTiendaDestino]);
            }
    
            $pdo->commit(); // Confirmar la transacción
            echo json_encode(["status" => "success", "message" => "Producto movido correctamente"]);
            exit;
        } catch (Exception $e) {
            $pdo->rollBack(); // Revertir cambios en caso de error
            $_SESSION['mensaje'] = [
                "tipo" => "error",
                "titulo" => "Error",
                "texto" => "Error al mover el producto."
            ];
        }
    }
}
?>
