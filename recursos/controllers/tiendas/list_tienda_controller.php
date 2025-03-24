<?php
if (!file_exists(__DIR__ . '/../../bd.php')) {
    die("Error: No se encontró bd.php");
}
include(__DIR__ . '/../../bd.php');

// Consultar tiendas disponibles (excluyendo el almacén si es necesario)
$sql = "SELECT id, nombre FROM tiendas";
$stmt = $pdo->query($sql);
$tiendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
