<?php
session_start();
include('../../bd.php'); // Conexión con PDO
header('Content-Type: application/json');

if (!isset($_POST['id']) || empty($_POST['id'])) {
    die(json_encode(["error" => "ID del producto no proporcionado."]));
}

$id_producto = $_POST['id'];
echo "ID recibido correctamente: " . $id_producto;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id'];
    $codigo_producto = $_POST['codigo_producto'];
    $codigo_saco = $_POST['codigo_saco'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];   
    $stock_min = $_POST['stock_min'];
    $stock_max = $_POST['stock_max'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $imagen_text = $_POST['imagen_text'];
    $id_categoria = $_POST['id_categoria'];
    $id_usuario = $_SESSION['usuario_id']; 

    if($_FILES['imagen']['name'] != null){
        //echo "hay imagen nueva";
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            $nombre_archivo = date("Y-m-d-h-i-s"); // Para evitar nombres duplicados
            $imagen_text = $nombre_archivo . "__" . basename($_FILES['imagen']['name']);
            $location = "../../../public/images/img_productos/" . $imagen_text; // ✅ Corrección de la ruta
    
            // Mover archivo al directorio
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $location)) {
                $imagen_text = $imagen_text; // Guardar solo el nombre del archivo en la BD
            } else {
                $imagen_text = null; // Si falla, se almacena como NULL
            }
        } else {
            $imagen_text = null; // Si no se subió imagen
        }
    }else{
        //echo "no hay imagen";
    }

    if (empty($codigo_saco) || empty($nombre) || empty($descripcion) || 
        empty($stock) || empty($stock_min) || empty($stock_max) || empty($precio_compra) || 
        empty($precio_venta) || empty($id_categoria)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
        exit();
    }

    try {
        

        // Actualizar los datos del producto
        $sql = "UPDATE productos SET 
                    codigo_saco = :codigo_saco,
                    nombre = :nombre, 
                    descripcion = :descripcion, 
                    imagen = :imagen,
                    stock = :stock, 
                    stock_min = :stock_min, 
                    stock_max = :stock_max, 
                    precio_compra = :precio_compra, 
                    precio_venta = :precio_venta, 
                    fecha_ingreso = :fecha_ingreso,
                    id_categoria = :id_categoria,
                    id_usuario = :id_usuario,
                    fecha_actualizacion = :fecha_actualizacion
                WHERE id = :id_producto";
                
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo_saco' => $codigo_saco,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':imagen' => $imagen_text,
            ':stock' => $stock,
            ':stock_min' => $stock_min,
            ':stock_max' => $stock_max,
            ':precio_compra' => $precio_compra,
            ':precio_venta' => $precio_venta,
            ':fecha_ingreso' => $fecha_ingreso,
            ':id_categoria' => $id_categoria,
            ':id_usuario' => $id_usuario,
            ':fecha_actualizacion' => $fechaHora,
            ':id_producto' => $id_producto,
        ]);

        $_SESSION['mensaje'] = [
            'tipo' => 'success',
            'titulo' => 'Producto Actualizado',
            'texto' => 'El producto se ha actualizado correctamente.'
        ];
        header("Location: " . $URL . "/vistas/productos/prodindex.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = [
            "tipo" => "error",
            "titulo" => "Error al registrar producto",
            "texto" => $e->getMessage()
        ];
        header("Location: " . $URL . "/vistas/productos/updateprod.php?=".$id);
        exit();
    }
} else {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'Acceso no autorizado.'
    ];
    header("Location: " . $URL . "/vistas/productos/prodindex.php");
    exit();
}
?>
