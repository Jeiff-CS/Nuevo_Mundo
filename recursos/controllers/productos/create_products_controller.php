<?php
session_start();
include('../../bd.php'); // Conexión a la BD

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar los datos del formulario
    $codigo_saco = $_POST['codigo_saco'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $stock_min = $_POST['stock_min'];
    $stock_max = $_POST['stock_max'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $id_categoria = $_POST['id_categoria'];
    $id_usuario = $_SESSION['usuario_id']; 

    try {
        // Consulta SQL para insertar usuario
        
        $sql = "INSERT INTO productos (codigo_saco, nombre, descripcion, stock, stock_min, stock_max, 
            precio_compra, precio_venta, id_categoria, id_usuario) 
            VALUES (:codigo_saco, :nombre, :descripcion, :stock, :stock_min, :stock_max, 
            :precio_compra, :precio_venta, :id_categoria, :id_usuario)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo_saco' => $codigo_saco,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':stock' => $stock,
            ':stock_min' => $stock_min,
            ':stock_max' => $stock_max,
            ':precio_compra' => $precio_compra,
            ':precio_venta' => $precio_venta,
            ':id_categoria' => $id_categoria,
            ':id_usuario' => $id_usuario
        ]);

        $_SESSION['mensaje'] = "Producto registrado exitosamente.";
        $_SESSION['mensaje_tipo'] = "success"; // Para definir el tipo de alerta
        header("Location: " . $URL . "/vistas/productos/prodindex.php");
        exit();


    } catch (PDOException $e) {
        echo "Error al registrar producto: " . $e->getMessage();
    }
} else {
    echo "<script>alert('Acceso no autorizado.'); window.history.back();</script>";
}
?>