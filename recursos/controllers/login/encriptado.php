<?php
include ('../../bd.php'); // Ajusta la ruta si es necesario

try {
    // Seleccionar todas las contraseñas sin cifrar
    $sql = "SELECT id, password FROM usuarios";
    $query = $pdo->query($sql);
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios as $usuario) {
        // Verificar si la contraseña ya está encriptada
        if (!password_needs_rehash($usuario['password'], PASSWORD_DEFAULT)) {
            echo "El usuario con ID {$usuario['id']} ya tiene una contraseña encriptada.<br>";
            continue; // Saltar si ya está encriptada
        }

        // Cifrar la contraseña
        $password_hash = password_hash($usuario['password'], PASSWORD_DEFAULT);

        // Actualizar en la base de datos
        $update_sql = "UPDATE usuarios SET password = :password WHERE id = :id";
        $update_query = $pdo->prepare($update_sql);
        $update_query->bindParam(':password', $password_hash);
        $update_query->bindParam(':id', $usuario['id']);
        $update_query->execute();

        echo "Contraseña del usuario con ID {$usuario['id']} encriptada correctamente.<br>";
    }
    
    echo "Proceso completado.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
