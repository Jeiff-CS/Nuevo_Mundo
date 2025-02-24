<?php
session_start();
include('../../bd.php');
session_destroy(); // Cierra la sesión
header("Location: " . $URL . "/vistas/login/index.php"); // Redirige al login
exit();