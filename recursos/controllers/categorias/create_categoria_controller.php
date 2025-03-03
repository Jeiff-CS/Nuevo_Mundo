<?php
include('../../bd.php'); // Conexión a la BD

// Habilitar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener valores del formulario
    $categoria_name = trim($_POST['categoria_name']);
    $categoria_desc = trim($_POST['categoria_desc']);

    // Validar que no estén vacíos
    if (empty($categoria_name) || empty($categoria_desc)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    try {
        // Preparar la consulta SQL con PDO
        $sql = "INSERT INTO categorias (nombre, descripcion) VALUES (:nombre, :descripcion)";
        $stmt = $pdo->prepare($sql);
        
        // Ejecutar la consulta con valores
        $stmt->execute([
            ':nombre' => $categoria_name,
            ':descripcion' => $categoria_desc
        ]);

        echo json_encode(["status" => "success", "message" => "Categoría registrada correctamente."]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Error al registrar: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido."]);
}
?>