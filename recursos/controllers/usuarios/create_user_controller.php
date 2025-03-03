<?php
include('../../recursos/bd.php'); // Conexión a la BD

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar los datos del formulario
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);
    $repass = trim($_POST['repass']);
    $estado = trim($_POST['estado']);

    // Validar que las contraseñas coincidan
    if ($pass !== $repass) {
        echo "<script>alert('Las contraseñas no coinciden. Inténtalo de nuevo.'); window.history.back();</script>";
        exit();
    }

    // Encriptar la contraseña antes de guardarla
    $password_hash = password_hash($pass, PASSWORD_BCRYPT);

    try {
        // Consulta SQL para insertar usuario
        $sql = "INSERT INTO usuarios (nombre, email, password, estado) VALUES (:nombre, :email, :password, :estado)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $password_hash);
        $query->bindParam(':estado', $estado);

        if ($query->execute()) {
            echo "<script>alert('Usuario registrado exitosamente.'); window.location.href='../../vistas/usuarios/userindex.php';</script>";
        } else {
            echo "<script>alert('Error al registrar usuario.'); window.history.back();</script>";
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
} else {
    echo "<script>alert('Acceso no autorizado.'); window.history.back();</script>";
}
?>