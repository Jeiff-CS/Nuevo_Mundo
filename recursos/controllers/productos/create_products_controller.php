<?php
session_start();
include('../../bd.php'); // Conexión a la BD

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar los datos del formulario
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
    $imagen = $_POST['imagen'];
    $id_categoria = $_POST['id_categoria'];
    $id_usuario = $_SESSION['usuario_id']; 

    // Verificar si se subió un archivo
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $nombre_archivo = date("Y-m-d-h-i-s"); // Para evitar nombres duplicados
        $filename = $nombre_archivo . "__" . basename($_FILES['imagen']['name']);
        $location = "../../../public/images/img_productos/" . $filename; // ✅ Corrección de la ruta

        // Mover archivo al directorio
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $location)) {
            $filename = $filename; // Guardar solo el nombre del archivo en la BD
        } else {
            $filename = null; // Si falla, se almacena como NULL
        }
    } else {
        $filename = null; // Si no se subió imagen
    }

    try {
        // Consulta SQL para insertar productos
        
        $sql = "INSERT INTO productos (codigo_producto, codigo_saco, nombre, descripcion, stock, stock_min, stock_max, 
            precio_compra, precio_venta, fecha_ingreso, imagen, id_categoria, id_usuario) 
            VALUES (:codigo_producto, :codigo_saco, :nombre, :descripcion, :stock, :stock_min, :stock_max, 
            :precio_compra, :precio_venta, :fecha_ingreso, :imagen, :id_categoria, :id_usuario)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':codigo_producto' => $codigo_producto,
            ':codigo_saco' => $codigo_saco,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':stock' => $stock,
            ':stock_min' => $stock_min,
            ':stock_max' => $stock_max,
            ':precio_compra' => $precio_compra,
            ':precio_venta' => $precio_venta,
            ':fecha_ingreso' => $fecha_ingreso,
            ':imagen' => $filename  ,
            ':id_categoria' => $id_categoria,
            ':id_usuario' => $id_usuario
        ]);

        $id_producto = $pdo->lastInsertId(); // Obtener el ID del producto insertado

        // 2️⃣ Insertar el stock en `tienda_stock` para el almacén (id_tienda = 3)
        $sql_stock = "INSERT INTO tienda_stock (id_tienda, id_producto, stock) VALUES (:id_tienda, :id_producto, :stock)";
        $stmt_stock = $pdo->prepare($sql_stock);
        $stmt_stock->execute([
            ':id_tienda' => 3, // Almacén
            ':id_producto' => $id_producto,
            ':stock' => $stock
        ]);

        $_SESSION['mensaje'] = [
            'tipo' => 'success',
            'titulo' => 'Producto creado',
            'texto' => 'El producto se ha registrado correctamente.'
        ];

    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {  // Error de duplicado
            $_SESSION['mensaje'] = [
                "tipo" => "error",
                "titulo" => "Error",
                "texto" => "El nombre del producto ya existe. Intenta con otro."
            ];
        } else {
            $_SESSION['mensaje'] = [
                "tipo" => "error",
                "titulo" => "Error al registrar producto",
                "texto" => $e->getMessage()
            ];
        }
    }
    header("Location: " . $URL . "/vistas/productos/createprod.php");
    exit();
} else {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'Acceso no autorizado.'
    ];
    header("Location: " . $URL . "/vistas/productos/createprod.php");
    exit();
}
?>