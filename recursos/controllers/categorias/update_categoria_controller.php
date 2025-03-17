<?php
include('../../bd.php'); // Conexión con PDO

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    if (empty($id) || empty($nombre) || empty($descripcion)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
        exit();
    }

    try {
        $sql = "UPDATE categorias SET nombre = :nombre, descripcion = :descripcion WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion
        ]);

        echo json_encode(["status" => "success", "message" => "Categoría actualizada correctamente."]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Error! El nombre de Categoria ya existe "]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido."]);
}
?>
