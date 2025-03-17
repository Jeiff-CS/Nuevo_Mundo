<?php
include('../../bd.php'); // Conexión con PDO

header("Content-Type: application/json");

try {
    // Preparar la consulta
    $sql = "SELECT id, nombre FROM categorias";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Obtener los resultados en un array asociativo
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    echo json_encode($categorias);
} catch (PDOException $e) {
    echo json_encode(["error" => "Error al obtener las categorías: " . $e->getMessage()]);
}
?>