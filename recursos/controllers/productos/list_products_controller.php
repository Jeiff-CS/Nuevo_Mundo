<?php
include('../../recursos/bd.php'); // Conexión a la BD

try {
    $query = "SELECT p.*, u.email AS usuario_email, c.nombre AS categoria_nombre
        FROM productos p
        INNER JOIN usuarios u ON p.id_usuario = u.id
        INNER JOIN categorias c ON p.id_categoria = c.id";
    $stmt = $pdo->prepare($query); // Preparamos la consulta correctamente
    $stmt->execute(); // Ejecutamos la consulta
    $productos_datos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtenemos los resultados
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>