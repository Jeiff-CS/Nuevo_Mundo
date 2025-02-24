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

?>