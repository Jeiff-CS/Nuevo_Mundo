<?php
include('../../recursos/bd.php'); // Conexión a la BD

try {
    $sql_usuarios = "SELECT u.id, u.nombre, u.email, u.estado, r.nombre AS rol, t.nombre AS tienda 
                     FROM usuarios u
                     LEFT JOIN roles r ON u.rol_id = r.id
                     LEFT JOIN tiendas t ON u.tienda_id = t.id";
    $query_usuarios = $pdo->prepare($sql_usuarios);
    $query_usuarios->execute();
    $usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al obtener usuarios: " . $e->getMessage();
}
?>
