<?php
session_start();
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/nuevo_mundo/recursos/bd.php';
require_once ($rootPath);
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login/index.php");
    exit();
}else{
  //echo $_SESSION['usuario_id'];
}

$usuario_nombre = $_SESSION['usuario_nombre'];
$usuario_rol = $_SESSION['usuario_rol'];
$email_usuario = $_SESSION['usuario_email'] ?? 'No definido';
$id_usuario = $_SESSION['usuario_id'] ?? '';

// Obtener categorías
$stmt = $pdo->prepare("SELECT id, nombre FROM categorias");
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener usuarios
$stmt = $pdo->prepare("SELECT u.id, u.nombre AS usuarios 
	FROM usuarios AS u 
	INNER JOIN roles AS r ON u.rol_id = r.id 
	WHERE r.nombre IN ('almacen', 'administrador', 'superadmin');");
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>