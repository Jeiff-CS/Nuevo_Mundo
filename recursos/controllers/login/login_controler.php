<?php 
session_start();  // Debe estar al inicio del archivo
include ('../../bd.php');

$email = $_POST['email'];
$password_user = $_POST['password_user'];

if (empty($email) || empty($password_user)) {
    $_SESSION['msj_llenar'] = "LLene los campos vacios!";
    header('Location: ' . $URL . '/vistas/login/index.php');
    exit();
}

$sql = "SELECT u.id, u.nombre, u.email, u.password, u.rol_id, u.tienda_id, r.nombre AS rol 
        FROM usuarios u 
        JOIN roles r ON u.rol_id = r.id 
        WHERE u.email = :email";

$query = $pdo->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();
$usuario = $query->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    if (password_verify($password_user, $usuario['password'])) { // Compara contraseñas de forma segura
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['usuario_rol'] = $usuario['rol'];
        $_SESSION['tienda_id'] = $usuario['tienda_id'];

        echo "Datos correctos";

        // Redirigir según el rol
        header("Location: " . $URL . "/vistas/index.php");
        exit();
    } else {
        echo "Contraseña incorrecta.";
        session_start();
        $_SESSION['mensaje'] = "❌ Error! Datos incorrectos";
        header('Location: '. $URL . '/vistas/login/index.php') ;
    }
}  else {
    echo "Usuario no existe";
    session_start();
    $_SESSION['msj_noexiste'] = "❌ Error! Usuario no encontrado";
    header('Location: '. $URL . '/vistas/login/index.php') ;
}
?>
