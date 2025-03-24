<?php
if (!file_exists(__DIR__ . '/../../bd.php')) {
    die("Error: No se encontró bd.php");
}
include(__DIR__ . '/../../bd.php');

try {
    $query = $pdo->prepare("SELECT 
                p.id, 
                p.codigo_producto, 
                p.codigo_saco, 
                p.nombre, 
                COALESCE(t2.stock, 0) AS stock_tienda_2
            FROM productos p
            LEFT JOIN tienda_stock t2 ON p.id = t2.id_producto AND t2.id_tienda = 2");
    
    $query->execute();
    $productos = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($productos);
} catch (PDOException $e) {
    die(json_encode(["error" => "Error en la consulta: " . $e->getMessage()]));
}
?>
