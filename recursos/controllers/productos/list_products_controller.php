<?php
include('../../recursos/bd.php'); // Conexión a la BD

try {
    // Consulta para obtener todos los productos
    $stmt = $pdo->prepare("SELECT id, nombre, descripcion, stock, stock_max, precio_compra, precio_venta, imagen FROM productos");
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener productos: " . $e->getMessage());
}
?>