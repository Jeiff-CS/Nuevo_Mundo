<?php
$sql_categorias = "SELECT * FROM categorias";
$query_categorias = $pdo->prepare($sql_categorias);
$query_categorias -> execute();
$categorias_datos = $query_categorias->fetchAll(PDO::FETCH_ASSOC);
?>