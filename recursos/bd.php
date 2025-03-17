<?php

if (!defined('SERVIDOR')) {
    define('SERVIDOR', 'localhost');
    define('USUARIO', 'root');
    define('PASSWORD', '');
    define('BD', 'nuevo_mundo');
}


$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try{
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    //echo "conexion bd";
}catch (PDOException $e){
    echo "Error 404: error en db";
}

$URL= "http://localhost/nuevo_mundo";

date_default_timezone_set("America/Lima");
$fechaHora = date('Y-m-d H:i:s');
?>